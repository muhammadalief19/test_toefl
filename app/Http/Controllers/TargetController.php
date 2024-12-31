<?php

namespace App\Http\Controllers;
use App\Models\Target;
use Illuminate\Http\Request;

class TargetController extends Controller
{
    private $data;

    public function __construct() {
        $this->data["title"] = "Target";
    }

    public function index() {
        $data = $this->data;
        $data["no"] = 1;
        $data["targetData"] = Target::all();
        return view('target.index', compact('data'));
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'name_level_target'=> 'required',
            'score_target' => 'required'
            ],
            [
                'name_level_target.required' => 'Nama Score Level Wajib Diisi',
                'score_target.required' => 'Target Score Wajib Diisi',
            ],
        );
        $createData = Target::create($validatedData);

        if ($createData) {
            toastr()->success('Target berhasil ditambahkan');
            return back();
        } else {
            toastr()->error('Target gagal ditambahkan');
            return back();
        }
    }

    public function update(Request $request, $id)
    {
        $forum = Target::find($id);

        if(!$forum) {
            toastr()->error('Forum Tidak Ditemukan');
            return back();
        }

        $validatedData = $request->validate([
            'forum_name'=> 'required|max:100',
            'description' => 'required'
            ],
            [
                'forum_name.required' => 'Nama Role Wajib Diisi',
                'description.required' => 'Deskripsi Wajib Diisi',
            ],
        );

        $updateData = $forum->update($validatedData);

        if ($updateData) {
            toastr()->success('Forum berhasil diupdate');
            return back();
        } else {
            toastr()->error('Forum gagal diupdate');
            return back();
        }
    }

    public function destroy($id) {
        $forum = Target::find($id);

        if(!$forum) {
            toastr()->error('Forum Tidak Ditemukan');
            return back();
        }

        $deleteData = $forum->delete();

        if ($deleteData) {
            toastr()->success('Forum berhasil didelete');
            return back();
        } else {
            toastr()->error('Forum gagal didelete');
            return back();
        }
    }
}
