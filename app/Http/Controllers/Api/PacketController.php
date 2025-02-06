<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Nested;
use App\Models\Paket;
use App\Models\Question;
use App\Models\User;
use App\Models\UserScorer;
use App\Models\ScoreMiniTest;
use App\Models\ToeflScore;
use App\Models\TestStatus;
// use AWS\CRT\HTTP\Request;
use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PacketController extends Controller
{
    public function getAllPacketFullTest()
    {
        try {
            $getPacket = Paket::with('questions')->where('tipe_test_packet', 'Full Test')->get();

            $dataRelasi = [];
            foreach ($getPacket as $packet) {
                $packetId = $packet['_id'];

                $getQuestionCount = Question::where('packet_id', $packetId)->count();
                $getUserScore = UserScorer::where('packet_id', $packetId)
                    ->where('user_id', auth()->user()->id)
                    ->first();

                $userScore = $getUserScore ? $getUserScore['akurasi'] : 0;

                $packet['akurasi'] = $userScore;
                $packet['question_count'] = $getQuestionCount;
                $packet['status_test'] = $getUserScore ? true : false;

                $dataRelasi[] = $packet;
            }

            if (!$getPacket) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data Packet not found',
                ], 404);
            }

            $dataRelasi = array_map(function ($data) {
                $data['id'] = $data['_id'];
                unset($data['_id']);
                return $data;
            }, $dataRelasi);

            return response()->json([
                'success' => true,
                'message' => 'Data all packet fetched successfully',
                'data' => $dataRelasi,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function getAllPacketMiniTest()
    {
        try {
            $getPacket = Paket::where('tipe_test_packet', 'Mini Test')->get();

            $dataRelasi = [];
            foreach ($getPacket as $packet) {
                $packetId = $packet['_id'];

                $getQuestionCount = Question::where('packet_id', $packetId)->count();
                $getUserScore = ScoreMiniTest::where('packet_id', $packetId)
                    ->where('user_id', auth()->user()->id)
                    ->first();

                $userScore = $getUserScore ? $getUserScore['akurasi'] : 0;

                $packet['akurasi'] = $userScore;
                $packet['question_count'] = $getQuestionCount;
                $packet['status_test'] = $getUserScore ? true : false;

                $dataRelasi[] = $packet;
            }

            $dataRelasi = array_map(function ($data) {
                $data['id'] = $data['_id'];
                unset($data['_id']);
                return $data;
            }, $dataRelasi);

            if (!$getPacket) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data Packet not found',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data all packet fetched successfully',
                'data' => $dataRelasi,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function getQuestionPacket($idPacket)
    {
        $data = Paket::with('questions', 'questions.nesteds.nestedQuestion', 'questions.multipleChoices')
            ->where('_id', $idPacket)
            ->first();

        $latestStatus = TestStatus::where('user_id', auth()->id())
            ->where('packet_id', $idPacket)
            ->latest()
            ->first();

        // Jika status terakhir "onGoing" dan waktu sudah lewat dari created_at, update menjadi "complete"
        if ($latestStatus && $latestStatus->status === "onGoing") {
            $createdTime = Carbon::parse($latestStatus->created_at);
            if (now()->greaterThan($createdTime->addHours(2))) {
                $latestStatus->update(['status' => 'complete']);

                // Ambil ulang status terbaru setelah update
                $latestStatus = TestStatus::where('user_id', auth()->id())
                    ->where('packet_id', $idPacket)
                    ->latest()
                    ->first();
            }
        }

        // Jika tidak ada status atau status terakhir adalah "complete", buat status baru
        if (!$latestStatus || $latestStatus->status === "complete") {
            $latestStatus = TestStatus::create([
                'user_id' => auth()->id(),
                'packet_id' => $idPacket,
                'status' => "onGoing"
            ]);
        }

        $questions = collect($data['questions'])->map(function ($question) {
            $nested = collect($question['nesteds'])->map(function ($nested) {
                return [
                    'nested_question_id' => $nested->nestedQuestion->_id ?? null,
                    'nested_question' => $nested->nestedQuestion->question_nested ?? null,
                ];
            })->all();

            $multipleChoices = $question->multipleChoices->map(function ($choice) {
                return [
                    'id' => $choice->_id,
                    'choice' => $choice->choice,
                ];
            })->all();

            return [
                'id' => $question['_id'],
                'type_question' => $question['question_type'] ?? null,
                'part_question' => $question['part_question'] ?? null,
                'description_part_question' => $question['description_part_question'] ?? null,
                'question' => $question['question_text'] ?? null,
                'nested_question_id' => $nested[0]['nested_question_id'] ?? null,
                'nested_question' => $nested[0]['nested_question'] ?? null,
                'multiple_choices' => $multipleChoices,
            ];
        })->all();

        $mappedData = [
            'id' => $data['_id'],
            'no_packet' => $data['no_packet'],
            'name_packet' => $data['name_packet'],
            'tipe_test_packet' => $data['tipe_test_packet'],
            'questions' => $questions,
        ];
        $createdTime = Carbon::parse($latestStatus->created_at)
            ->setTimezone('Asia/Jakarta')
            ->format('H:i'); // Format Jam:Menit (24 jam)
        return response()->json([
            'success' => true,
            'message' => 'Data Question Packet fetched successfully',
            'status' => $latestStatus->status, // Menggunakan `latestStatus` yang sudah diperbarui
            'created_at' => $createdTime,
            'data' => $mappedData,
        ]);
    }


    public function updateStatusFullTest(Request $request, $idPacket)
    {
        $validatedData = $request->validate([
            'time' => 'required',
            'remaining_time' => 'required'
        ]);

        TestStatus::where('user_id', auth()->id())
            ->where('packet_id', $idPacket)
            ->update($validatedData);
            // ->where('_id', $idStatus)

        return response()->json([
            'success' => true,
            'message' => 'Data Status Updated successfully',
        ]);
    }

    public function getStatusFullTest($idPacket)
    {
        // $data = TestStatus::where('user_id', auth()->id())
        //     ->where('packet_id', $idPacket)->get();

        $data = TestStatus::where('user_id', auth()->id())
            ->where('packet_id', $idPacket)
            ->get();
            // ->where('_id', $idStatus)

        return response()->json([
            'success' => true,
            'message' => 'Data Status fetched successfully',
            'status'=> $data,
        ]);
    }
}
