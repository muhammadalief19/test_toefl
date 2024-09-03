<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Question extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'questions';
    protected $fillable = [
        'quiz_id',
        'packet_id', 
        'part_question', 
        'description_part_question', 
        'key_question',
        'question_text',
        'question_type',
        'options',
        'correct_answer',
        'score'
    ];
    use HasFactory;

    public function packet()
    {
        return $this->belongsTo(Paket::class, 'packet_id', '_id');
    }

    public function multipleChoices()
    {
        return $this->hasMany(MultipleChoice::class, 'question_id', '_id');
    }

    public function nestedQuestion()
    {
        return $this->belongsTo(NestedQuestion::class, 'nested_question_id', '_id');
    }

    public function nesteds()
    {
        return $this->hasMany(Nested::class, 'question_id', '_id');
    }
}
