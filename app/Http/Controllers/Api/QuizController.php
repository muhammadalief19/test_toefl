<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Exception;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index(){
        
        try{
            $quizs = Quiz::with('type','questions.content.options','questions.content.answer_key.option')->get();
            
            return response()->json(['data' => $quizs]);
        }catch(Exception $e){
            return $e->getMessage();
        }
    }

    

    public function store(Request $request){
        try{
            $validated = $request->validate([
                'name' => 'required',
                'type' => 'required',
                // 'questions' => 'required',
                'questions.*' => 'required',
                // 'questions.*.options' => 'required',
            ]);

    
        }catch(Exception $e){

            return $e->getMessage();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    
    /**
     * Display the specified resource.
     */
    public function show(string $type_id)
    {

        try{
            $user = auth()->user();
            $quizs = Quiz::with([
                'type',
                'quiz_claim' => function($query) use ($user) {
                    $query->where('user_id', $user->id)
                          ->orderBy('is_completed', 'asc');
                }
            ])->where('quiz_type_id',$type_id)->get();
    
            return response()->json([
                'success' => true,
                'data' => $quizs
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'data' => $e->getMessage()
            ]);
        }
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
