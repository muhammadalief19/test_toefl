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

    public function store(Request $request, $status)
    {
        date_default_timezone_set('Asia/Jakarta');
        $validator = Validator::make($request->all(), [
            'user_id' => 'nullable',
            'assessment_type' => 'nullable',
            'score' => 'nullable',
            'education_levels' => 'nullable',
            'assesment_date' => 'nullable',
        ]);

        $date = new Carbon();

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if($request->assessment_type == "initial") {
            if($status == "skip-initial") {
                $createData = Assesment::create([
                    'user_id' => $request->user_id,
                    'assessment_type' => $request->assessment_type,
                    'score' => $request->score,
                    'education_levels' => $request->education_levels,
                    'education_goals' => [
                        'university' => $request->university,
                        'major' => $request->major,
                        'scholarship' => $request->scholarship,
                    ],
                    'dream' => $request->dream,
                    'result' => [
                        'proficiency_level' => null,
                        'target_score' => null,
                        'strengths' => null,
                        'weaknesses' => null,
                        'gpa' => null,
                        'achievement' => null,
                        'experience' => null,
                        'skills' => null,
                        'scholarship_reason' => null,
                        'plans' => null,
                        'scholarship_documents' => null,
                        'difficulty_writing_level' => null,
                        'exam_date' => null,
                        'materials_not_mastered' => null,
                        'confidence_level' => null,
                        'topics' => null,
                        'class_type' => null,
                        'areas_to_improve' => null,
                        'assistance' => null,
                        'exam_schedule' => null,
                        'desire_level' => null,
                        'willingness_level' => null,
                        'obstacles' => null,
                    ],
                    'interest' => [
                        'language_certification_target' => null,
                        'cv' => null,
                        'research_proposal' => null,
                        'intership' => null,
                        'career' => null,
                        'loa' => null,
                        'motivation' => null,
                        'network' => null,
                        'skills' => null,
                    ],
                    'assessment_date' => $date->now()->isoFormat('Y-M-D H:mm:ss'),
                ]);
            } else {
                $createData = Assesment::create([
                    'user_id' => $request->user_id,
                    'assessment_type' => $request->assessment_type,
                    'score' => $request->score,
                    'education_levels' => $request->education_levels,
                    'education_goals' => [
                        'university' => $request->university,
                        'major' => $request->major,
                        'scholarship' => $request->scholarship,
                    ],
                    'dream' => $request->dream,
                    'result' => [
                        'proficiency_level' => $request->proficiency_level,
                        'target_score' => $request->target_score,
                        'strengths' => $request->strengths,
                        'weaknesses' => $request->weaknesses,
                        'gpa' => $request->gpa,
                        'achievement' => $request->achievement,
                        'experience' => $request->experience,
                        'skills' => $request->skills,
                        'scholarship_reason' => $request->scholarship_reason,
                        'plans' => $request->plans,
                        'scholarship_documents' => $request->scholarship_documents,
                        'difficulty_writing_level' => $request->difficulty_writing_level,
                        'exam_date' => $request->exam_date,
                        'materials_not_mastered' => $request->materials_not_mastered,
                        'confidence_level' => $request->confidence_level,
                        'topics' => $request->topics,
                        'class_type' => $request->class_type,
                        'areas_to_improve' => $request->areas_to_improve,
                        'assistance' => $request->assistance,
                        'exam_schedule' => $request->exam_schedule,
                        'desire_level' => $request->desire_level,
                        'willingness_level' => $request->willingness_level,
                        'obstacles' => $request->obstacles,
                    ],
                    'interest' => $request->interest,
                    'assessment_date' => $date->now()->isoFormat('Y-M-D H:mm:ss'),
                ]);
            }

        } else {
            $createData = Assesment::create([
                'user_id' => Auth()->user()->id,
                'assessment_type' => $request->assessment_type,
                'score' => $request->score,
                'result' => $request->result,
                'assessment_date' => $date->now()->isoFormat('Y-M-D H:mm:ss'),
            ]);
        }

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
                    'code' => 500
                ],
                500,
            );
        }
    }

    public function updateAssessmentInitial(Request $request, $id) {
        $assessment = Assesment::where('_id', $id)->first();

        if(!$assessment) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Assessment Tidak Ditemukan!',
                ],
                404,
            );
        }

        if($assessment->assessment_type != "initial") {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Assessment Type Salah!',
                ],
                500,
            );
        }

        $updatedData = $assessment->update([
            'result' => [
                'proficiency_level' => $request->proficiency_level,
                'target_score' => $request->target_score,
                'strengths' => $request->strengths,
                'weaknesses' => $request->weaknesses,
                'gpa' => $request->gpa,
                'achievement' => $request->achievement,
                'experience' => $request->experience,
                'skills' => $request->skills,
                'scholarship_reason' => $request->scholarship_reason,
                'plans' => $request->plans,
                'scholarship_documents' => $request->scholarship_documents,
                'difficulty_writing_level' => $request->difficulty_writing_level,
                'exam_date' => $request->exam_date,
                'materials_not_mastered' => $request->materials_not_mastered,
                'confidence_level' => $request->confidence_level,
                'topics' => $request->topics,
                'class_type' => $request->class_type,
                'areas_to_improve' => $request->areas_to_improve,
                'assistance' => $request->assistance,
                'exam_schedule' => $request->exam_schedule,
                'desire_level' => $request->desire_level,
                'willingness_level' => $request->willingness_level,
                'obstacles' => $request->obstacles,
            ],
            'interest' => [
                'language_certification_target' => $request->language_certification_target,
                'cv' => $request->cv,
                'research_proposal' => $request->research_proposal,
                'intership' => $request->intership,
                'career' => $request->career,
                'loa' => $request->loa,
                'motivation' => $request->motivation,
                'network' => $request->network,
                'skills' => $request->skills,
            ],
        ]);

        if ($updatedData) {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Assessment Berhasil Diupdate',
                ],
                201,
            );
        } else {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Assessment Gagal Diupdate',
                ],
                500,
            );
        }
    }
}
