<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizType;
use App\Models\Module;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        $data['quizzesTypeData'] = QuizType::all();
        $data['moduleData'] = Module::all();
        $data['no'] = 1;

        return view('quiz.index', compact(['data']));
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'order' => 'required',
            'quiz_type_id' => 'required',
            'module_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'passing_score' => 'required',
        ],
        [
            'order.required' => 'Order Wajib Diisi',
            'quiz_type_id.required' => 'Tipe Quiz Wajib Diisi',
            'module_id.required' => 'Module Wajib Diisi',
            'title.required' => 'Judul Quiz Wajib Diisi',
            'description.required' => 'Deskripsi Quiz Wajib Diisi',
            'passing_score.required' => 'Passing core Wajib Diisi',
        ]);
        $date = new Carbon();
        $createData = Quiz::create([
            'order' => $validatedData['order'],
            'quiz_type_id' => $validatedData['quiz_type_id'],
            'module_id' => $validatedData['module_id'],
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'passing_score' => $validatedData['passing_score'],
            'created_at' => $date->now()->isoFormat('Y-M-D H:mm:ss')
        ]);

        if ($createData) {
            toastr()->success('Quiz berhasil ditambahkan');
            return back();
        } else {
            toastr()->error('Quiz gagal ditambahkan');
            return back();
        }
    }

    public function update(Request $request, $id) {
        $Quiz = Quiz::find($id);

        if(!$Quiz) {
            toastr()->error('Quiz tidak ditemukan');
            return back();
        }

        $validatedData = $request->validate([
            'order' => 'required',
            'quiz_type_id' => 'required',
            'module_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'total_questions' => 'required',
            'passing_core' => 'required',
            'created_at'
        ],
        [
            'order.required' => 'Order Wajib Diisi',
            'quiz_type_id.required' => 'Tipe Quiz Wajib Diisi',
            'module_id.required' => 'Module Wajib Diisi',
            'title.required' => 'Judul Quiz Wajib Diisi',
            'description.required' => 'Deskripsi Quiz Wajib Diisi',
            'passing_core.required' => 'Passing core Wajib Diisi',
        ]);
        $date = new Carbon();
        $updateData = $Quiz->update([
            'order.required' => $validatedData['order'],
            'quiz_type_id.required' => $validatedData['quiz_type_id'],
            'module_id.required' => $validatedData['module_id'],
            'title.required' => $validatedData['title'],
            'description.required' => $validatedData['description'],
            'passing_core.required' => $validatedData['passing_core'],
            'passing_core.required' => $date->now()->isoFormat('Y-M-D H:mm:ss')
        ]);

        if ($updateData) {
            toastr()->success('Quiz berhasil diupdate');
            return back();
        } else {
            toastr()->error('Quiz gagal diupdate');
            return back();
        }
    }

    public function destroy($id){
        $Quiz = Quiz::find($id);

        if (!$Quiz) {
            toastr()->error('Quiz tidak ditemukan');
            return back();
        }

        $deleteData = $Quiz->delete();

        if ($deleteData) {
            toastr()->success('Quiz berhasil dihapus');
            return back();
        } else {
            toastr()->error('Quiz gagal dihapus');
            return back();
        }
    }

    public function question($id) {
        $data = $this->data;
        $data['title'] = 'Quiz Questions';
        $data['quizzesData'] = Quiz::with('questions')->where('_id', $id)->get();

        return view('quiz.question', compact('data'));
    }
}
