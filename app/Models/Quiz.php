<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Quiz extends Model
{

    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'quizzes';

    protected $fillable = [
        'order', 
        'module_id', 
        'title', 
        'description', 
        'total_questions', 
        'passing_core', 
        'created_at'
    ];

    public function module() {
        return $this->belongsTo(Module::class, 'module_id', '_id');
    }

    public function type(){
        return $this->belongsTo(QuizType::class,'quiz_type_id','_id');
    }

    public function questions(){
        return $this->hasMany(QuizQuestion::class,'quiz_id','_id');
    }
    
    public function quiz_claim(){
        return $this->hasMany(QuizClaim::class,'quiz_id','_id');
    }
}
