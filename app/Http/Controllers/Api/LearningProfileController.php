<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LearningProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LearningProfileController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'learning_style' => 'nullable|string',
            'career_goals' => 'nullable|string',
            'strength' => 'nullable|string',
            'areas_of_improvement' => 'nullable|string',
            'preferred_course_types' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $createdData = LearningProfile::create([
            'user_id' => $request->user_id,
            'learning_style' => $request->learning_style,
            'career_goals' => $request->career_goals,
            'strength' => $request->strength,
            'areas_of_improvement' => $request->areas_of_improvement,
            'preferred_course_types' => $request->preferred_course_types,
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
