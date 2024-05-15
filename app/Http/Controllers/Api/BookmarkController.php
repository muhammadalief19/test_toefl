<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MultipleChoice;
use App\Models\Nested;
use App\Models\Question;
use App\Models\Target;
use App\Models\UserAnswer;
use Exception;

class BookmarkController extends Controller
{
    public function getAllBookmark()
    {
        try {
            $initIdUser = auth()->user()->_id;
            $init = UserAnswer::with('question')->where('user_id', $initIdUser)->where('bookmark', true)->get();

            $mappedData = $init->map(function ($bookmark) {
                return [
                    'id' => $bookmark->_id,
                    'question' => $bookmark->question->question,
                ];
            });

            return response()->json([
                'success' => true,
                'message' => 'Data Bookmark User',
                'data' => $mappedData,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function getSpesificBookmark($idBookmark)
    {
        try {
            $initIdUser = auth()->user()->_id;
            $init = UserAnswer::with('question')->where('user_id', $initIdUser)->where('bookmark', true)->where('_id', $idBookmark)->first();

            $initNested = Nested::where('question_id', $init->question_id)->first();

            $initMultipleChoices = MultipleChoice::where('question_id', $init->question_id)->get();

            return response()->json([
                'success' => true,
                'message' => 'Data Spesification question Bookmark User Successfully Fetched.',
                'data' => [
                    'id' => $init->_id,
                    'nested_question' => $initNested ? $initNested->nestedQuestion->question_nested : "",
                    'question' => $init->question->question,
                    'answer_user' => $init->answer_user,
                    'key_answer' => $init->question->key_question,
                    'correct' => $init->correct,
                    'multiple_choices' => $initMultipleChoices,
                ]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function addBookmark($idSoal)
    {
        try {
            $initIdUser = auth()->user()->_id;
            $init = UserAnswer::where('user_id', $initIdUser)->where('_id', $idSoal)->first();
            $init->bookmark = true;
            $init->save();

            return response()->json([
                'success' => true,
                'message' => 'Bookmark was saved successfully'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function updateBookmark($idSoal)
    {
        try {
            $initIdUser = auth()->user()->id;

            $datas = UserAnswer::where('user_id', $initIdUser)->where('question_id', $idSoal)->first();
            if ($datas->bookmark == true) {
                $datas->bookmark = false;
                $datas->save();
            } else {
                $datas->bookmark = true;
                $datas->save();
            }

            return response()->json([
                'success' => true,
                'message' => 'Bookmark was updated successfully',
                'data' => [
                    'bookmark' => $datas['bookmark']
                ],

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
