<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class DifficultyLevel extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'difficulty_levels';

    protected $fillable = [
        'level_name'
    ];
}
