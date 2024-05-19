<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QuizClaim;
use Exception;
use Illuminate\Http\Request;

class QuizEnrollController extends Controller
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
                'quiz_id' => 'required'
            ]);
            $user_id = auth()->user()->_id;
            $claim_quiz = new QuizClaim();

            // $claim_quiz->user_id =;
            $claim_quiz->quiz_id = $request->quiz_id;
            $claim_quiz->user_id = $user_id;
            $claim_quiz->is_completed = false;

            $claim_quiz->save();
            
            
            return response()->json([
                'success' => true,
                'data'=> $claim_quiz
            ]);
           }catch(Exception $e){
            return response()->json(['success' => false, 'data' => null]);
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
