<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Forum;
use App\Models\Topic;
use App\Models\Post;
use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        try {
            $posts = Post::with('topic')->get();
            $randomPosts = $posts->shuffle();

            return response()->json([
                'status' => 200,
                'success' => true,
                'data' => $randomPosts
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'success' => false,
                'data' => $e->getMessage()
            ]);
        }
    }

    public function getByID($id){
        try {
            $topic = Post::with('topic')->find($id);

            return response()->json([
                'status' => 200,
                'success' => true,
                'data' => $topic
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'success' => false,
                'data' => $e->getMessage()
            ]);
        }
    }

    public function store(Request $request) {
        try {
            $date = new Carbon();
            $validatedData = $request->validate([
                'topic_id' => 'required',
                'content' => 'required',

            ]);

            $createData = Post::create([
                'topic_id' => $validatedData['topic_id'],
                'posted_by' => Auth()->user()->_id,
                'content' => $validatedData['content'],
                'posted_at' => $date->now()->isoFormat('Y-M-D H:mm:ss'),
            ]);

            if($createData) {
                return response()->json([
                    'status' => 200,
                    'success' => true,
                    'data' => true
                ]);
            }
        } catch(Exception $e) {
            return response()->json([
                'status' => 500,
                'success' => false,
                'data' => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, $id) {
        try {
            $date = new Carbon();
            $validatedData = $request->validate([
                'topic_id' => 'required',
                'posted_by' => 'required',
                'content' => 'required',
                'posted_at' => 'required'
            ]);

            $updateData = Post::find($id)->update([
                'topic_id' => $validatedData['topic_id'],
                'content' => $validatedData['content'],
                'posted_at' => $date->now()->isoFormat('Y-M-D H:mm:ss'),
            ]);

            if($updateData) {
                return response()->json([
                    'status' => 200,
                    'success' => true,
                    'data' => true
                ]);
            }
        } catch(Exception $e) {
            return response()->json([
                'status' => 500,
                'success' => false,
                'data' => $e->getMessage()
            ]);
        }
    }

    public function delete($id) {
        try {
            $deleteData = Post::where('_id', $id)->delete();

            if($deleteData) {
                return response()->json([
                    'status' => 200,
                    'success' => true,
                    'data' => true
                ]);
            }
        } catch(Exception $e) {
            return response()->json([
                'status' => 500,
                'success' => false,
                'data' => $e->getMessage()
            ]);
        }
    }
}
