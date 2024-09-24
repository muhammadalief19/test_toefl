<?php

namespace App\Http\Controllers;

use App\Models\CourseCategory;
use Illuminate\Http\Request;

class CourseCategoryController extends Controller
{
    private $data;

    public function __construct()
    {
        $this->data['title'] = 'Course Category';
    }

    public function index()
    {
        $data = $this->data;
        $data['courseCategoryData'] = CourseCategory::all();
        $data['no'] = 1;

        return view('course-category.index', compact(['data']));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_name' => 'required',
        ]);

        $createData = CourseCategory::create($validatedData);

        if ($createData) {
            toastr()->success('Course Category berhasil ditambahkan');
            return back();
        } else {
            toastr()->error('Course Category gagal ditambahkan');
            return back();
        }
    }

    public function update(Request $request, $id)
    {
        $courseCategory = CourseCategory::find($id);

        if (!$courseCategory) {
            toastr()->error('Course Category tidak ditemukan');
            return back();
        }

        $validatedData = $request->validate([
            'category_name' => 'required',
        ]);

        $updateData = $courseCategory->update($validatedData);

        if ($updateData) {
            toastr()->success('Course Category berhasil diupdate');
            return back();
        } else {
            toastr()->error('Course Category gagal diupdate');
            return back();
        }
    }

    public function destroy($id)
    {
        $courseCategory = CourseCategory::find($id);

        if (!$courseCategory) {
            toastr()->error('Course Category tidak ditemukan');
            return back();
        }

        $deleteData = $courseCategory->delete();

        if ($deleteData) {
            toastr()->success('Course Category berhasil didelete');
            return back();
        } else {
            toastr()->error('Course Category gagal didelete');
            return back();
        }
    }
}
