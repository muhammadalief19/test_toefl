<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LearningProfileController extends Controller
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            "user_id" => "required|numeric",
            "learning_style" => "required",
        ]);
    }
}
