<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Assesment;
use App\Models\DifficultyLevel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AssessmentController extends Controller
{
    public function index (){
        $level = DifficultyLevel::all();

        return response()->json(
            [
                'success' => true,
                'message' => 'Assessment Berhasil Ditambahkan',
                'data' => $level
            ],
            200,
        );
    }

    public function EducationLevelStore(Request $request) {
        $validator = $request->validate([
            'user_id' => 'nullable',
            'education_level' => 'nullable',
        ]);

        $createData = Assesment::create([
            'user_id' => Auth()->user()->id,
            'education_level' => $request->education_level,
        ]);

        if ($createData) {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Level Berhasil Ditambahkan',
                ],
                201,
            );
        } else {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Level Gagal Ditambahkan',
                ],
                500,
            );
        }
    }

    public function EducationGoalStore(Request $request) {
        $validator = $request->validate([
            'user_id' => 'nullable',
            'education_level' => 'nullable',
        ]);

        $createData = Assesment::create([
            'user_id' => Auth()->user()->id,
            'education_level' => $request->education_level,
        ]);

        if ($createData) {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Level Berhasil Ditambahkan',
                ],
                201,
            );
        } else {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Level Gagal Ditambahkan',
                ],
                500,
            );
        }
    }

    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $validator = Validator::make($request->all(), [
            'user_id' => 'nullable',
            'assessment_type' => 'nullable',
            'score' => 'nullable',
            'result' => 'nullable|json',
            'education_levels' => 'nullable',
            'education_goals' => 'nullable',
            'assesment_date' => 'nullable',
        ]);

        $date = new Carbon();

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $createData = Assesment::create([
            'user_id' => Auth()->user()->id,
            'assessment_type' => $request->assessment_type,
            'score' => $request->score,
            'result' => $request->result,
            'education_levels' => $request->education_levels,
            'education_goals' => $request->education_goals,
            'assesment_date' => $date->now()->isoFormat('Y-M-D H:mm:ss'),
        ]);

        if ($createData) {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Assessment Berhasil Ditambahkan',
                ],
                201,
            );
        } else {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Assessment Gagal Ditambahkan',
                ],
                500,
            );
        }
    }
}
