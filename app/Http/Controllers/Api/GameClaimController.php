<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GameClaim;
use Exception;
use Illuminate\Http\Request;

class GameClaimController extends Controller
{
    /**
     * Display a listing of the resource. History
     */
    public function index()
    {
        try{
            $user = auth()->user();
            $user_games = GameClaim::with('user','game_set.quiz','game_set.game')->where('user_id', $user->_id)->get();

            return response()->json(['data' => $user_games]);
        }catch(Exception $e){
            return response()->json(['success' => false, 'data' => null]);
        }
    }

    /**
     * Show the form for creating a new resource. Check is there any Claim sudah ada, optional :D
     */
    public function create()
    {
        try{
            $user = auth()->user();
            $user_games = GameClaim::with('user','game_set.quiz','game_set.game')->where('user_id', $user->_id)->get();
            if(empty($user_games)){
                return response()->json(['success' => true, 'data' => true]);   
            }
            return response()->json(['success'=> true, 'data' => false]);
        }catch(Exception $e){
            return response()->json(['success' => false, 'data' => false]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'game_set_id' => 'required',
            ]);

            $user = auth()->user();
            $user_game = new GameClaim();

            $user_game->user_id = $user->id;
            $user_game->game_set_id = $request->game_set_id;
            $user_game->is_completed = false;
            $user_game->save();
    
            return response()->json([
                'success' => true,
                'data'=> $user_game
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
       try{
        $user = auth()->user();
        $user_games = GameClaim::with('user','game_set.quiz','game_set.game')->where('user_id',$user->_id)->where('game_set_id',$id)->get();
            
       
        return response()->json(['success' => true, 'data' => $user_games]);   
       }catch(Exception $e){
        return response()->json(['success' => false, 'data' => []]);
       }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try{
            $user = auth()->user();
            $user_games = GameClaim::with('user','game_set.quiz','game_set.game')->where('user_id',$user->_id)->where('_id',$id)->first();
                
           
            return response()->json(['success' => true, 'data' => $user_games]);   
        }catch(Exception $e){
            return response()->json(['success' => false, 'data' => []]);
        }
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
