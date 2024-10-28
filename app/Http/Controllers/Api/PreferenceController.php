<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Preference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PreferenceController extends Controller
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'notification_preference' => 'nullable',
            'content_preference' => 'nullable'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $createData = Preference::create([
            'user_id' => $request->user_id,
            'notification_preference' => $request->notification_preference,
            'content_preference' => $request->content_preference
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
            ],500);
        }
    }
}
