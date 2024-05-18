<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;


class QuizAnswer extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'game_answers';

    protected $fillable = [
        'quiz_option_id','game_claim_id', 'quiz_content_id'
    ];

    public function claim(){
        return $this->belongsTo(GameClaim::class,'game_claim_id','_id');
    }

    public function option(){
        return $this->belongsTo(QuizOption::class,'quiz_option_id','_id');
    }

    public function content(){
        return $this->belongsTo(QuizContent::class,'quiz_content_id','_id');
    }

}
