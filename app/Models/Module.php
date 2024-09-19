<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'modules';

    protected $fillable = [
        'course_id',
        'module_name',
        'module_description'
    ];

    public function course() {
        return $this->belongsTo(Course::class, 'course_id', '_id');
    }

    public function material() {
        return $this->hasMany(Material::class, 'module_id', '_id');
    }

    public function quizzes() {
        return $this->hasMany(Quiz::class, 'module_id', '_id');
    }

    public function learningHistory() {
        return $this->hasMany(LearningHistory::class, 'module_id', '_id');
    }
}
