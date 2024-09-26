<?php

namespace App\Http\Controllers;

use App\Models\QuizType;
use Illuminate\Http\Request;

class QuizTypeController extends Controller
{
    private $data;

    public function __construct()
    {
        $this->data['title'] = 'Quiz Type';
    }

    public function index() {
        $data = $this->data;
        $data['quizTypesData'] = QuizType::all();
        $data['no'] = 1;

        return view('quiz-type.index', compact(['data']));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'required|string',
        ]);

        $createData = QuizType::create($validatedData);

        if ($createData) {
            toastr()->success('Quiz Type berhasil ditambahkan');
            return back();
        } else {
            toastr()->error('Quiz Type gagal ditambahkan');
            return back();
        }
    }

    public function update(Request $request, $id) {
        $quizType = QuizType::find($id);

        if (!$quizType) {
            toastr()->error('Quiz Type tidak ditemukan');
            return back();
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'required|string',
        ]);

        $updateData = $quizType->update($validatedData);

        if ($updateData) {
            toastr()->success('Quiz Type berhasil diupdate');
            return back();
        } else {
            toastr()->error('Quiz Type gagal diupdate');
            return back();
        }
    }

    public function destroy($id)
    {
        $quizType = QuizType::find($id);

        if (!$quizType) {
            toastr()->error('Quiz Type tidak ditemukan');
            return back();
        }

        $deleteData = $quizType->delete();

        if ($deleteData) {
            toastr()->success('Quiz Type berhasil dihapus');
            return back();
        } else {
            toastr()->error('Quiz Type gagal dihapus');
            return back();
        }
    }
}
