<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Assesment extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'assessments';

    protected $fillable = [
        'user_id',
        'assessment_type',
        'score',
        'result',
        'education_levels',
        'education_goals',
        'assessment_date'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', '_id');
    }
}
