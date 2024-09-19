<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Recommendation extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'recommendations';

    protected $fillable = [
        'user_id',
        'assesment_id',
        'recommended_courses',
        'priority_level',
        'recommendation_date',
        'status'
    ];
}
