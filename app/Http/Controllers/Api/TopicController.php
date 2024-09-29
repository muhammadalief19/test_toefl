<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Forum;
use App\Models\Topic;
use Exception;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function index(){
        try {
            $topic = Topic::with('post')->get();

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

    public function getByID($id){
        try {
            $topic = Topic::with('post')->find($id);

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

            $validatedData = $request->validate([
                'forum_id' => 'required',
                'topic_title' => 'required',
                'created_by' => 'required',
            ]);

            $createData = Topic::create([
                'forum_id' => $validatedData['forum_id'],
                'topic_title' => $validatedData['topic_title'],
                'created_by' => Auth()->user()->_id,
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
                'forum_id' => 'required',
                'topic_title' => 'required',
                'created_by' => 'required',
            ]);

            $updatedData = Topic::find($id)->update([
                'forum_id' => $validatedData['forum_id'],
                'topic_title' => $validatedData['topic_title'],
                'created_by' => Auth()->user()->_id,
            ]);

            if($updatedData) {
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
            $deleteData = Topic::where('_id', $id)->delete();

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
