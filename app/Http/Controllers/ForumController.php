<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    private $data;

    public function __construct() {
        $this->data["title"] = "Forum";
    }

    public function index() {
        $data = $this->data;
        $data["no"] = 1;
        $data["forumData"] = Forum::with('topic')->get();
        return view('forum.index', compact('data'));
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'forum_name'=> 'required|max:100',
            'description' => 'required'
            ],
            [
                'forum_name.required' => 'Nama Role Wajib Diisi',
                'description.required' => 'Deskripsi Wajib Diisi',
            ],
        );
        $createData = Forum::create($validatedData);

        if ($createData) {
            toastr()->success('Forum berhasil ditambahkan');
            return back();
        } else {
            toastr()->error('Forum gagal ditambahkan');
            return back();
        }
    }

    public function update(Request $request, $id)
    {
        $forum = Forum::find($id);

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
        $forum = Forum::find($id);

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
