<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    private $data;

    public function __construct()
    {
        $this->data['title'] = 'Quiz';
    }

    public function index() {
        $data = $this->data;
        $data['quizzesData'] = Quiz::all();
        $data['no'] = 1;

        return view('quiz.index', compact(['data']));
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            
        ]);
    }
}
