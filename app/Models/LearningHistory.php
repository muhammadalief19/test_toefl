<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
class LearningHistory extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'learning_history';

    protected $fillable = [
        'user_id',
        'course_id',
        'module_id',
        'completion_date',
        'progress'
    ];
}
