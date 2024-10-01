<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Forum;
use App\Models\Topic;
use App\Models\Post;
use App\Models\Comment;
use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        try {
            $comments = Comment::with('post')->get();

            return response()->json([
                'status' => 200,
                'success' => true,
                'data' => $comments
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'success' => false,
                'data' => $e->getMessage()
            ]);
        }
    }

    public function getByCommentID($id){
        try {
            $comment = Comment::with('post')->find($id);

            return response()->json([
                'status' => 200,
                'success' => true,
                'data' => $comment
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'success' => false,
                'data' => $e->getMessage()
            ]);
        }
    }

    public function getByPostID($post_id){
        try {
            $comment = Comment::with('post')->where('post_id',$post_id)->get();

            return response()->json([
                'status' => 200,
                'success' => true,
                'data' => $comment
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
            $validatedData = $request->validate([
                'post_id' => 'required',
                'commented_by' => 'required',
                'content' => 'required',
            ]);

            $createData = Comment::create([
                'post_id' => $validatedData['post_id'],
                'commented_by' => Auth()->user()->_id,
                'content' => $validatedData['content'],
                'commented_at' => Carbon::now(),
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
            $validatedData = $request->validate([
                'post_id' => 'required',
                'commented_by' => 'required',
                'content' => 'required',
            ]);

            $updateData = Comment::create([
                'post_id' => $validatedData['post_id'],
                'commented_by' => Auth()->user()->_id,
                'content' => $validatedData['content'],
                'commented_at' => Carbon::now(),
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
            $deleteData = Comment::where('_id', $id)->delete();

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
