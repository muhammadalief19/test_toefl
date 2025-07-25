<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class UserAnswer extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'user_answers';
    protected $fillable = [
        'packet_id',
        'user_id',
        'question_id',
        'quiz_id',
        'bookmark',
        'answer_user',
        'selected_answer',
        'is_correct',
        'answered_at'
    ];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', '_id');
    }

    public function packet()
    {
        return $this->belongsTo(Paket::class, 'packet_id', '_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id', '_id');
    }

    public function answer()
    {
        return $this->hasMany(Answer::class, 'question_id', 'question_id');
    }
}

