<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizType;
use App\Models\Module;
use App\Models\QuizContent;
use App\Models\QuizOption;
use App\Models\QuizAnswerKey;
use App\Models\QuizQuestion;
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
        $data['quizQuestionData'] = QuizQuestion::where('quiz_id', $id)->get();
        $data['quizzesId'] = $id;

        return view('quiz.question', compact('data'));
    }

    public function questionStore(Request $request) {
        $validatedData = $request->validate([
            'quiz_id' => 'required',
            'question' => 'required',
        ],
        [
            'quiz_id.required' => 'Id Quiz Wajib Diisi',
            'question.required' => 'Judul Quiz Wajib Diisi',
        ]);

        $createData = QuizQuestion::create([
            'quiz_id' => $validatedData['quiz_id'],
            'question' => $validatedData['question'],
        ]);

        if ($createData) {
            toastr()->success('Question Quiz berhasil ditambahkan');
            return back();
        } else {
            toastr()->error('Question Quiz gagal ditambahkan');
            return back();
        }
    }

    public function questionUpdate(Request $request, $id) {
        $question = QuizQuestion::find($id);
        $validatedData = $request->validate([
            'question' => 'required',
        ],
        [
            'question.required' => 'Judul Quiz Wajib Diisi',
        ]);

        $updateData = $question->update([
            'question' => $validatedData['question'],
        ]);

        if ($updateData) {
            toastr()->success('Question Quiz berhasil diupdate');
            return back();
        } else {
            toastr()->error('Question Quiz gagal diupdate');
            return back();
        }
    }

    public function questionContentStore(Request $request) {
        $validatedData = $request->validate([
            'quiz_question_id' => 'required',
            'content' => 'required',
        ],
        [
            'quiz_question_id.required' => 'Id Quiz Wajib Diisi',
            'content.required' => 'Content Quiz Wajib Diisi',
        ]);

        $createData = QuizContent::create([
            'quiz_question_id' => $validatedData['quiz_question_id'],
            'content' => $validatedData['content'],
        ]);

        if ($createData) {
            toastr()->success('Content Quiz berhasil ditambahkan');
            return back();
        } else {
            toastr()->error('Content Quiz gagal ditambahkan');
            return back();
        }
    }

    public function questionContentUpdate(Request $request, $id) {
        $content = QuizContent::find($id);
        $validatedData = $request->validate([
            'content' => 'required',
        ],
        [
            'content.required' => 'Content Quiz Wajib Diisi',
        ]);

        $updateData = $content->update([
            'content' => $validatedData['content'],
        ]);

        if ($updateData) {
            toastr()->success('Content Quiz berhasil diupdate');
            return back();
        } else {
            toastr()->error('Content Quiz gagal diupdate');
            return back();
        }
    }

    public function quizOptionsStore(Request $request) {
        // Validasi data dari form
        $validatedData = $request->validate([
            'quiz_content_id' => 'required',
            'options.*' => 'required',
        ],
        [
            'quiz_content_id.required' => 'Id Quiz Wajib Diisi',
            'options.*.required' => 'Setiap opsi wajib diisi',
        ]);

        try {
            // Cari OptionQuiz berdasarkan quiz_content_id yang diterima
            $existingOptions = QuizOption::where('quiz_content_id', $validatedData['quiz_content_id'])->first();

            if ($existingOptions) {
                // Jika OptionQuiz sudah ada, cek jumlah opsi yang ada
                $currentOptions = $existingOptions->options;

                if (count($currentOptions) >= 5) {
                    toastr()->error('Opsi sudah mencapai maksimal 5, tidak bisa menambah lebih banyak.');
                    return back();
                }

                // Tambahkan opsi dari request, namun pastikan jumlah total opsi tidak lebih dari 5
                $newOptions = array_slice(array_merge($currentOptions, $validatedData['options']), 0, 5);

                // Update QuizOption dengan opsi baru
                $existingOptions->update([
                    'options' => $newOptions,
                ]);

                toastr()->success('Options Quiz berhasil diperbarui.');
                return back();
            } else {
                // Jika OptionQuiz belum ada, cek apakah jumlah opsi yang diinput kurang dari atau sama dengan 5
                // if (count($validatedData['options']) != 5) {
                //     toastr()->error('Anda harus menambahkan tepat 5 opsi.');
                //     return back();
                // }

                // Buat OptionQuiz baru dengan 5 opsi
                $createData = QuizOption::create([
                    'quiz_content_id' => $validatedData['quiz_content_id'],
                    'options' => $validatedData['options'],
                ]);

                if ($createData) {
                    toastr()->success('Options Quiz berhasil ditambahkan.');
                    return back();
                } else {
                    // Jika createData gagal, tampilkan toastr error dengan data yang di-validate
                    $errorMessages = implode(", ", $validatedData['options']);
                    toastr()->error("Gagal menambahkan opsi: " . $errorMessages);
                    return back();
                }
            }
        } catch (\Exception $e) {
            // Tangani error jika terjadi masalah lain
            toastr()->error('Terjadi kesalahan: ' . $e->getMessage());
            return back();
        }
    }

    public function storeAnswerKey(Request $request) {
        // Validasi input
        $validatedData = $request->validate([
            'quiz_content_id' => 'required',
            'quiz_option_id' => 'required',
            'quiz_options' => 'required',
            'explanation' => 'required',
        ]);

        try {
            $existingAnswerKey = QuizAnswerKey::where('quiz_option_id', $validatedData['quiz_option_id'])->exists();

            if ($existingAnswerKey) {
                // Jika sudah ada kunci untuk quiz_option_id ini, tampilkan toastr error
                toastr()->error('Opsi ini sudah ditetapkan sebagai kunci jawaban.');
                return back();
            }

            // Simpan kunci jawaban di QuizAnswerKey
            $answerKey = QuizAnswerKey::create([
                'quiz_content_id' => $validatedData['quiz_content_id'],
                'quiz_option_id' => $validatedData['quiz_option_id'],
                'quiz_options' => $validatedData['quiz_options'],
                'explanation' => $validatedData['quiz_option_id'],
            ]);
            if ($answerKey) {
                toastr()->success('Kunci Jawaban berhasil ditambahkan.');
            return back();
            } else {
                // Jika createData gagal, tampilkan toastr error dengan data yang di-validate

                toastr()->error("Gagal menambahkan opsi: ");
                return back();
            }


        } catch (\Exception $e) {
            // Jika gagal, tampilkan error
            toastr()->error('Gagal menambahkan kunci jawaban. ' . $e->getMessage());
            return back();
        }
    }
}
