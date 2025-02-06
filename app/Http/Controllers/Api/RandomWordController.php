<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Word;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class RandomWordController extends Controller
{
    public function index(){
        try{
            // $word = Word::take(1)->skip(rand(0,12000))->first();

            $maxSkip = Word::count() - 1;
            $word = Word::take(1)->skip(rand(0, max(0, $maxSkip)))->first();

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
