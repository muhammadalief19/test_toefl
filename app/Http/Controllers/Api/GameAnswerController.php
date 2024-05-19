<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GameAnswer;
use App\Models\GameClaim;
use App\Models\QuizAnswerKey;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class GameAnswerController extends Controller
{
    public function store(Request $request)
    {
        try{
            $user = auth()->user();
            $request->validate([
                'quiz_option_id' => 'required',
                'quiz_content_id' => 'required',
                'quiz_claim_id' => 'required',
                'game_set_id' => 'required'
            ]);
            
            $score = 0;

            $key = QuizAnswerKey::where('quiz_content_id',$request->quiz_content_id)->first();

            $attempt = GameClaim::where('game_set_id',$request->game_set_id)->get();
            if($key->quiz_option_id == $request->quiz_content_id){
                $score = 10 * 1 / count($attempt);
            }

            $user_answer = new GameAnswer();

            $user_answer->quiz_option_id = $request->quiz_option_id;
            $user_answer->quiz_claim_id = $request->quiz_claim_id;
            $user_answer->quiz_content_id = $request->content_id;
            $user_answer->user_id = $user->_id;
            $user_answer->score = $score;
            $user_answer->created_at = Carbon::now();

            $user_answer->save();

            return response()->json([
                'success' => true,
                'data' => true
            ]);

        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'data' => false
            ]);
        }
    }

}
