<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class GameClaim extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'game_claims';

    protected $fillable = [
        'game_set_id','user_id'
    ];

    use HasFactory;

    public function game_set(){
        return $this->belongsTo(GameSet::class,'game_set_id','_id');
    }
    
    public function user(){
        return $this->belongsTo(User::class,'user_id','_id');
    }
   
    
}
