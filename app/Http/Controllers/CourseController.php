<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    private $data;
    
    public function __construct()
    {
        $this->data['title'] = 'Course';
    }

    public function index() {
        $data = $this->data;
        $data["no"] = 1;
        $data['courseData'] = Course::with(['category', 'difficultyLevel'])->get();

        return view('course.index', compact(['data']));
    }
}
