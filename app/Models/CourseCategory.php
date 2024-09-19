<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class CourseCategory extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'course_categories';

    protected $fillable = [
        'category_name'
    ];
}
