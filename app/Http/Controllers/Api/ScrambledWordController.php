<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Word;
use Exception;
use Illuminate\Http\Request;

class ScrambledWordController extends Controller
{
    public function index(){
        
        try{
            $word = Word::take(10)->skip(rand(0,12000))->get();

            return response()->json([
                'success'=> true,
                'data' => $word
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'data'=> $e->getMessage()
            ]);   
        }
        
        
    }
}
