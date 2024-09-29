<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DifficultyLevel;
use Illuminate\Http\Request;
use Exception;

class DifficultyLevelController extends Controller
{
    public function index() {
        $level = DifficultyLevel::all();

        return response()->json(
            [
                'success' => true,
                'message' => 'Data level berhasil didapat',
                'payload' => $level
            ],
            200,
        );
    }
}
