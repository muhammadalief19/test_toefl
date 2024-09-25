<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\DifficultyLevel;
use App\Models\User;
use App\Models\UserRole;
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
        $instructor = UserRole::where('role_name','instructor')->first();
        $data["no"] = 1;
        $data['courseData'] = Course::with(['category', 'difficultyLevel'])->get();
        $data['courseCategoriesData'] = CourseCategory::all();
        $data['instructorsData'] = User::where('role_id', $instructor->_id)->get();
        $data['levelsData'] = DifficultyLevel::all();

        return view('course.index', compact(['data']));
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'category_id' => 'required',
            'course_name' => 'required|string|max:255',
            'description' => 'required|string',
            'instructor_id' => 'required',
            'difficulty_level_id' => 'required',
            'duration' => 'required|numeric',
            'price' => 'required|numeric'
        ]);

        $createdData = Course::create($validatedData);

        if ($createdData) {
            toastr()->success('Course berhasil ditambahkan');
            return back();
        } else {
            toastr()->error('Course gagal ditambahkan');
            return back();
        }
    }

    public function update(Request $request, $id) {
        $course = Course::find($id);

        if(!$course) {
            toastr()->error('Course tidak ditemukan');
            return back();
        }

        $validatedData = $request->validate([
            'category_id' => 'required',
            'course_name' => 'required|string|max:255',
            'description' => 'required|string',
            'instructor_id' => 'required',
            'difficulty_level_id' => 'required',
            'duration' => 'required|numeric',
            'price' => 'required|numeric'
        ]);

        $updatedData = $course->update($validatedData);

        if ($updatedData) {
            toastr()->success('Course berhasil diupdate');
            return back();
        } else {
            toastr()->error('Course gagal diupdate');
            return back();
        }
    }

    public function destroy($id) {
        $course = Course::find($id);

        if(!$course) {
            toastr()->error('Course tidak ditemukan');
            return back();
        }

        $deletedData = $course->delete();

        if ($deletedData) {
            toastr()->success('Course berhasil didelete');
            return back();
        } else {
            toastr()->error('Course gagal didelete');
            return back();
        }
    }
}
