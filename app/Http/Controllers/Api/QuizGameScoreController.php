<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GameAnswer;
use App\Models\Quiz;
use App\Models\QuizAnswer;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class QuizGameScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = User::all();
        
            $currentYear = Carbon::now()->year;
            $currentMonth = Carbon::now()->month;
        
            $all_scores = [];
        
            foreach ($users as $user) {
                try {
                    $game_score = GameAnswer::whereHas('claim' ,function($query){
                        $query->where('is_completed', true);
                    })->where('user_id', $user->_id)
                        ->whereYear('created_at', $currentYear)
                        ->whereMonth('created_at', $currentMonth)
                        ->sum('score');
        
                    $quiz_score = QuizAnswer::whereHas('claim' ,function($query){
                        $query->where('is_completed', true);
                    })->where('user_id', $user->_id)
                        ->whereYear('created_at', $currentYear)
                        ->whereMonth('created_at', $currentMonth)
                        ->sum('score');
        
                    $total_score = $game_score + $quiz_score;
        
                    $all_scores[] = [
                        'user_id' => $user->_id,
                        'nama' => $user->name,
                        'total_score' => $total_score,
                        'game_score' => $game_score,
                        'quiz_score' => $quiz_score
                    ];
                } catch (ModelNotFoundException $e) {
                } catch (\Exception $e) {
                }

            }
            
            usort($all_scores, function ($a, $b) {
                return $b['total_score'] <=> $a['total_score'];
            });

            return response()->json(['data' => $all_scores]);
                
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while retrieving scores. Please try again later.'], 500);
        }
    }
}
