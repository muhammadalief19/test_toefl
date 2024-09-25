<?php

namespace App\Http\Controllers;

use App\Models\DifficultyLevel;
use Illuminate\Http\Request;

class DifficultyLevelController extends Controller
{
    private $data;
    
    public function __construct()
    {
        $this->data['title'] = 'Difficulty Level';
    }

    public function index()
    {
        $data = $this->data;
        $data["no"] = 1;
        $data['difficultyLevelData'] = DifficultyLevel::all();

        return view('difficulty-level.index', compact(['data']));
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'level_name' => "required"
        ]);

        $createData = DifficultyLevel::create($validatedData);

        if($createData) {
            toastr()->success('Level berhasil ditambahkan');
            return back();
        } else {
            toastr()->error('Level gagal ditambahkan');
            return back();
        }
    }

    public function update(Request $request, $id) {
        $level = DifficultyLevel::find($id);

        if(!$level) {
            toastr()->error('Level tidak ditemukan');
            return back();
        }

        $validatedData = $request->validate([
            'level_name' => "required"
        ]);

        $updateData = $level->update($validatedData);

        if($updateData) {
            toastr()->success('Level berhasil diupdate');
            return back();
        } else {
            toastr()->error('Level gagal diupdate');
            return back();
        }
    }

    public function destroy($id) {
        $level = DifficultyLevel::find($id);

        if(!$level) {
            toastr()->error('Level tidak ditemukan');
            return back();
        }

        $deleteData = $level->delete();

        if($deleteData) {
            toastr()->success('Level berhasil dihapus');
            return back();
        } else {
            toastr()->error('Level gagal dihapus');
            return back();
        }
    }
}
