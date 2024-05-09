<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Nested;
use App\Models\Paket;
use App\Models\Question;
use App\Models\User;
use App\Models\UserScorer;
use Exception;

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
                    ->where('user_id', auth()->user()->_id)
                    ->first();

                $userScore = $getUserScore ? $getUserScore['akurasi'] : 0;

                $packet['akurasi'] = $userScore;
                $packet['question_count'] = $getQuestionCount;

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
                $getUserScore = UserScorer::where('packet_id', $packetId)
                    ->where('user_id', auth()->user()->_id)
                    ->first();

                $userScore = $getUserScore ? $getUserScore['akurasi'] : 0;

                $packet['akurasi'] = $userScore;
                $packet['question_count'] = $getQuestionCount;

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
        try {
            $dataNested = Nested::with('question', 'nestedQuestion')->get();
            $dataQuestion = Question::with('multipleChoices')->where('packet_id', $idPacket)->get();

            $dataRelasi = [];

            foreach ($dataQuestion as $question) {
                $questionId = $question['_id'];

                $getNested = $dataNested->where('question_id', $questionId)->first();
                $nestedQuestion = $getNested ? $getNested['nested_question_id'] : "";
                $question['nested_question_id'] = $nestedQuestion;
                $question['nested_question'] = $getNested ? $getNested->nestedQuestion->question_nested : "";
                $question['id'] = $question['_id'];
                unset($question['_id']);
                unset($question['key_question']);
                unset($question['packet_id']);
                $dataRelasi[] = $question;
            }

            if (empty($dataQuestion)) {
                return response()->json([
                    'success' => false,
                    'status' => 'error',
                    'message' => 'Data Question not found',
                ], 404);
            }

            $groupedData = [];

            foreach ($dataRelasi as $question) {
                $type = $question['type_question'];
                $part = $question['part_question'];
                $nestedId = $question['nested_question_id'];

                if (!isset($groupedData[$type])) {
                    $groupedData[$type] = [];
                }

                if (!isset($groupedData[$type][$part])) {
                    $groupedData[$type][$part] = [
                        'description_part_question' => $question['description_part_question'],
                        'nested_questions' => []
                    ];
                }

                if (!isset($groupedData[$type][$part]['nested_questions'][$nestedId])) {
                    $groupedData[$type][$part]['nested_questions'][$nestedId] = [
                        'nested_question_id' => $nestedId,
                        'nested_question' => $question['nested_question'],
                        'questions' => []
                    ];
                }

                $groupedData[$type][$part]['nested_questions'][$nestedId]['questions'][] = $question;
            }

            $finalData = [];

            foreach ($groupedData as $type => $typeData) {
                $typeQuestions = [];

                foreach ($typeData as $part => $partData) {
                    $partQuestions = [];

                    foreach ($partData['nested_questions'] as $nestedQuestion) {
                        $partQuestions[] = $nestedQuestion;
                    }

                    $typeQuestions[] = [
                        'part_question' => $part,
                        'description_part_question' => $partData['description_part_question'],
                        'nested_questions' => $partQuestions
                    ];
                }

                $finalData[] = [
                    'type_question' => $type,
                    'parts' => $typeQuestions
                ];
            }

            return response()->json([
                'success' => true,
                'message' => 'Data Question Packet fetched successfully',
                'data' => $finalData,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
