<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QuizAnswer;
use App\Models\QuizAnswerKey;
use App\Models\QuizOption;
use Exception;
use Illuminate\Http\Request;

class QuizAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{

            $request->validate([
                'quiz_option_id' => 'required',
                'quiz_content_id' => 'required',
                'quiz_claim_id' => 'required',
            ]);

            $key = QuizAnswerKey::where('quiz_content_id',$request->quiz_option_id);

            
            $user_answer = new QuizAnswer();

            $user_answer->quiz_option_id = $request->quiz_option_id;
            $user_answer->quiz_claim_id = $request->quiz_claim_id;

            $user_answer->save();

            $is_correct = $key->quiz_option_id == $request->quiz_option_id;

            return response()->json([
                'status' => 200,
                'data' => [
                    'is_correct' => $is_correct,
                    'answer_key' => $key
                ]
            ]);

        }catch(Exception $e){

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
