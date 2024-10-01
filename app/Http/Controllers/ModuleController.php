<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Module;

class ModuleController extends Controller
{
    private $data;
    public function __construct()
    {
        $this->data["title"] = "Module";
    }

    public function index(){
        $data = $this->data;
        $data['no'] = 1;
        $data["moduleData"] = Module::with('course')->get();
        $data["courseData"] = Course::all();
        return view('module.first', compact('data'));
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'course_id' => 'required',
            'module_name' => 'required',
            'module_description' => 'required'
        ],
        [
            'course_id.required' => 'Course Wajib Diisi',
            'module_name.required' => 'Nama Module Wajib Diisi',
            'module_description.required' => 'Deskripsi Module Wajib Diisi',
        ],);

        $createData = Module::create([
            'course_id' => $validatedData['course_id'],
            'module_name' => $validatedData['module_name'],
            'module_description' => $validatedData['module_description'],
        ]);

        if ($createData) {
            toastr()->success('Module berhasil ditambahkan');
            return back();
        } else {
            toastr()->error('Module gagal ditambahkan');
            return back();
        }
    }

    public function update(Request $request, $id){
        $Module = Module::find($id);

        if(!$Module) {
            toastr()->error('Module tidak ditemukan');
            return back();
        }

        $validatedData = $request->validate([
            'course_id' => 'required',
            'module_name' => 'required',
            'module_description' => 'required'
        ],
        [
            'course_id.required' => 'Course Wajib Diisi',
            'module_name.required' => 'Nama Module Wajib Diisi',
            'module_description.required' => 'Deskripsi Module Wajib Diisi',
        ],);

        $updateData = $Module->update($validatedData);

        if ($updateData) {
            toastr()->success('Module berhasil diupdate');
            return back();
        } else {
            toastr()->error('Module gagal diupdate');
            return back();
        }
    }

    public function destroy($id){
        $Module = Module::find($id);

        if (!$Module) {
            toastr()->error('Module tidak ditemukan');
            return back();
        }

        $deleteData = $Module->delete();

        if ($deleteData) {
            toastr()->success('Module berhasil dihapus');
            return back();
        } else {
            toastr()->error('Module gagal dihapus');
            return back();
        }
    }
}
