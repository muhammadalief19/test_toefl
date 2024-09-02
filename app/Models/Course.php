<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'courses';

    protected $fillable = [
        'category_id',
        'course_name',
        'description',
        'instructor_id',
        'difficulty_level_id',
        'duration',
        'price'
    ];

    public function category() {
        return $this->belongsTo(CourseCategory::class, 'category_id', '_id');
    }

    public function difficultyLevel() {
        return $this->belongsTo(DifficultyLevel::class, 'difficulty_level_id', '_id');
    }

    public function module() {
        return $this->hasOne(Module::class, 'course_id', '_id');
    }

    public function learningHistory() {
        return $this->belongsTo(LearningHistory::class, 'course_id', '_id');
    }

    public function recommendation() {
        return $this->belongsTo(Recommendation::class, 'recommended_courses', '_id');
    }

    public function payment() {
        return $this->belongsTo(Payment::class, 'course_id', '_id');
    }

    public function instructor() {
        return $this->belongsTo(User::class, 'instructor_id', '_id');
    }
}
