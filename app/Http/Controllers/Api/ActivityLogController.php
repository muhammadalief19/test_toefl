<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ActivityLogController extends Controller
{
    public function store(Request $request) {
        date_default_timezone_set('Asia/Jakarta');
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'activity_type' => 'required|string',
            'description' => 'nullable'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $createData = ActivityLog::create([
            'user_id' => $request->user_id,
            'activity_type' => $request->activity_type,
            'activity_date' => date('Y-m-d H:i:s'),
            'description' => $request->description
        ]);

        if($createData) {
            return response()->json([
                'success' => true,
                'data' => $createData
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'data' => false
            ], 500);
        }
    }
}
