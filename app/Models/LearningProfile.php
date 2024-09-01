<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningProfile extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'learning_profiles';

    protected $fillable = [
        'user_id',
        'learning_style',
        'career_goals',
        'strengths',
        'areas_of_improvement',
        'preferred_course_types',
        'updated_at'
    ];
}
