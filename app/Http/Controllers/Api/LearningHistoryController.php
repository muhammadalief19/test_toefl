<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LearningHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LearningHistoryController extends Controller
{
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'course_id' => 'required',
            'module_id' => 'required',
            'completion_date' => 'nullable',
            'progress' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $createdData = LearningHistory::create([
            'user_id' => $request->user_id,
            'course_id' => $request->course_id,
            'module_id' => $request->module_id,
            'completion_date' => date('Y-m-d H:i:s'),
            'progress' => (float)$request->progress,
        ]);

        if ($createdData) {
            return response()->json(
                [
                    'success' => true,
                    'data' => $createdData,
                ],
                201,
            );
        } else {
            return response()->json(
                [
                    'success' => false,
                    'data' => false,
                ],
                500,
            );
        }
    }
}
