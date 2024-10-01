<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Forum;
use Exception;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index(){
        try {
            $forum = Forum::with('topic')->latest();

            return response()->json([
                'status' => 200,
                'success' => true,
                'data' => $forum
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'success' => false,
                'data' => $e->getMessage()
            ]);
        }

    }
}
