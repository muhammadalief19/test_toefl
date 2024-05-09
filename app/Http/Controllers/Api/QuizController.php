<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Exception;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public static function index(){
        
        try{
            
            $quizs = Quiz::with('type','questions.content.options','questions.content.answer_key.option')->get();
            
            return response()->json(['data' => $quizs]);
        }catch(Exception $e){
            return $e->getMessage();
        }
    }

    public static function show($id){
        
    }

    public static function store(Request $request){
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
}
