<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Auth;
use App\Models\Topic;
use App\Models\Forum;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    private $data;

    public function __construct() {
        $this->data["title"] = "Topic";
    }

    public function index() {
        $data = $this->data;
        $data["no"] = 1;
        $data["forumData"] = Forum::get();
        $data["topicData"] = Topic::get();
        return view('topic.index', compact('data'));
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
                'forum_id' => 'required',
                'topic_title' => 'required',
            ],
            [
                'forum_id.required' => 'Forum Wajib Diisi',
                'topic_title.required' => 'Judul Topic Wajib Diisi',
            ],
        );
        $createData = Topic::create([
            'forum_id' => $validatedData['forum_id'],
            'topic_title' => $validatedData['topic_title'],
            'created_by' => auth()->user()->_id,
        ]);

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
        $forum = Topic::find($id);

        if(!$forum) {
            toastr()->error('Forum Tidak Ditemukan');
            return back();
        }

        $validatedData = $request->validate([
            'forum_id' => 'required',
            'topic_title' => 'required',
        ],
        [
            'forum_id.required' => 'Forum Wajib Diisi',
            'topic_title.required' => 'Judul Topic Wajib Diisi',
        ]);

        $updateData = $forum->update($validatedData);

        if ($updateData) {
            toastr()->success('Topic berhasil diupdate');
            return back();
        } else {
            toastr()->error('Topic gagal diupdate');
            return back();
        }
    }

    public function destroy($id) {
        $topic = Topic::find($id);

        if(!$topic) {
            toastr()->error('Topic Tidak Ditemukan');
            return back();
        }

        $deleteData = $topic->delete();

        if ($deleteData) {
            toastr()->success('Topic berhasil didelete');
            return back();
        } else {
            toastr()->error('Topic gagal didelete');
            return back();
        }
    }
}
