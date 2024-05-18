<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Target;
use App\Models\User;
use App\Models\UserScorer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValueHomeController extends Controller
{
    public function getAllTargetValue()
    {
        $targets = Target::all();
        return response()->json($targets);
    }

    public function getLevelUser()
    {
        try {
            $userInit = User::where('_id', auth()->user()->_id)->first();
            if ($userInit['target_id'] == "") {
                return response()->json([
                    "success" => true,
                    "message" => "Data User Is Null, Not yet initialized. (belum melakukan test)",
                    "data" => [
                        'target_user' => 0,
                        'user_score' => 0,
                        'score_listening' => 0,
                        'score_structure' => 0,
                        'score_reading' => 0,
                    ]
                ], 201);
            }

            $userTarget = User::with('target')->where('target_id', $userInit->target_id)->first();
            $userScore = UserScorer::where('user_id', auth()->user()->_id)->latest()->first();
            return response()->json([
                'succes' => true,
                'message' => 'Data User has completed',
                'data' => [
                    'target_user' => $userTarget->target->score_target,
                    'user_score' => $userScore->score_toefl,
                    'score_listening' => $userScore->score_listening,
                    'score_structure' => $userScore->score_structure,
                    'score_reading' => $userScore->score_reading,
                ],
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function addTarget(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'target_id' => 'required|string',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validate->errors(),
            ], 400);
        }

        try {
            $userLog = auth()->user()->_id;
            User::where('_id', $userLog)->update([
                'target_id' => $request->target_id,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Target User Berhasil Diupdate',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
