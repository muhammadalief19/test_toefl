<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assesmen extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'assessments';

    protected $fillable = [
        'user_id',
        'assessment_type',
        'score',
        'result',
        'assessment_date'
    ];
}
