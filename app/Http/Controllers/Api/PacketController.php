<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Nested;
use App\Models\Paket;
use App\Models\Question;
use App\Models\User;
use App\Models\UserScorer;
use App\Models\UserAnswer;
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
            $getPacket = Paket::where('tipe_test_packet', 'Full Test')->get();

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
                    'code' => 404
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
                'code' => 200,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'code' => 500
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

            $userAnswerCreate = UserAnswer::where('user_id', auth()->user()->id);

            return response()->json([
                'success' => true,
                'code'=> 200,
                'message' => 'Data all packet fetched successfully',
                'data' => $dataRelasi,
                'answer_user' => $userAnswerCreate,
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
        try {
            $data = Paket::with('questions', 'questions.nesteds.nestedQuestion', 'questions.multipleChoices')
            ->where('_id', $idPacket)
            ->first();
            if(!$data) {
                return response()->json([
                    'success' => false,
                    'code' => 500,
                    'message' => 'data question packet not found'
                ]);
            }

            $latestStatus = TestStatus::where('user_id', auth()->user()->id)
                ->where('packet_id', $idPacket)
                ->latest()
                ->first();

            // Jika status terakhir "onGoing" dan waktu sudah lewat dari created_at, update menjadi "complete"
            if ($latestStatus && $latestStatus->status === "onGoing") {
                $createdTime = Carbon::parse($latestStatus->created_at);
                if (now()->greaterThan($createdTime->addHours(2))) {
                    $latestStatus->update(['status' => 'complete']);

                    // Ambil ulang status terbaru setelah update
                    $latestStatus = TestStatus::where('user_id', auth()->user()->id)
                        ->where('packet_id', $idPacket)
                        ->latest()
                        ->first();
                }
            }

            // Jika tidak ada status atau status terakhir adalah "complete", buat status baru
            if (!$latestStatus || $latestStatus->status === "complete") {
                $latestStatus = TestStatus::create([
                    'user_id' => auth()->user()->id,
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
                ->format('H:i');

            $userAnswerCreate = UserAnswer::where('user_id', auth()->user()->id)
                ->where('packet_id', $idPacket)
                ->get();

            return response()->json([
                'success' => true,
                'code' => 200,
                'message' => 'Data Question Packet fetched successfully',
                'id_status' => $latestStatus->_id,
                'status' => $latestStatus->status,
                'created_at' => $createdTime,
                'data' => $mappedData,
                'answer_user' => $userAnswerCreate->isNotEmpty() ? $userAnswerCreate : null,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'code' => 500,
                'message' => $e->getMessage()
            ], 500);
        }

    }

    public function getStatusFullTest()
    {
        try{

            $data = TestStatus::where('user_id', auth()->id())
                ->where('status', 'onGoing')
                ->latest()
                ->first();

            if ($data && $data->status === "onGoing") {
                $createdTime = Carbon::parse($data->created_at);
                if (now()->greaterThan($createdTime->addHours(2))) {
                    $data->update(['status' => 'complete']);
                    return response()->json([
                        'success' => true,
                        'message' => 'Test time has expired, status set to complete.',
                        'data' => null,
                        'code' => 200
                    ], 200);
                }
            }
            $data = TestStatus::where('user_id', auth()->id())
                ->where('status', 'onGoing')
                ->latest()
                ->first();

            // Jika tidak ada data onGoing, cari data dengan status complete
            if (!$data) {
                $data = TestStatus::where('user_id', auth()->id())
                    ->where('status', 'complete')
                    ->latest()
                    ->first();
            }

            // Jika tetap tidak ada data, kembalikan null
            if (!$data) {
                return response()->json([
                    'success' => true,
                    'message' => 'No test status found',
                    'data' => null,
                    'code' => 200,
                ], 200);
            }
            $createdTime = Carbon::parse($data->created_at)
                ->setTimezone('Asia/Jakarta')
                ->format('H:i');

            return response()->json([
                'success' => true,
                'message' => 'Data Status fetched successfully',
                'data' => [
                    'status' => $data->status,
                    'id' => $data->packet_id,
                    'created_at' => $data->created_at,
                    'nama_packet' => $data->packet->name_packet
                ],

                'code' =>200
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'data' => null,
                'code' => 500
            ], 500);
        }
    }
}
