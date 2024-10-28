<?php

namespace App\Http\Controllers;

use App\Models\MultipleChoice;
use App\Models\Nested;
use App\Models\NestedQuestion;
use App\Models\Paket;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PacketFullController extends Controller
{
    private $data;

    public function __construct()
    {
        $this->data["title"] = "Full Packet";
    }

    public function getFullPaket()
    {
        $data = $this->data;
        $dataPacketFull = Paket::with('questions')->where('tipe_test_packet', 'Full Test')->latest()->get();
        return view('datapacketfull.first', compact('dataPacketFull','data'));
    }
    public function index($id)
    {
        $dataPacketFull = Paket::with('questions')->where('tipe_test_packet', 'Full Test')->latest()->get();
        
        $data = $this->data;
        $questions = Question::where('packet_id', $id)
        ->orderBy('created_at', 'desc')
        ->get();
        $dataId = $id;
        return view('datapacketfull.index', compact('dataPacketFull', 'dataId', 'data','questions'));
    }

    public function getEntryQuestionFull($id)
    {
        $data = $this->data;
        $dataPacketFull = Paket::where('_id', $id)->first();
        return view('datapacketfull.entry', compact('dataPacketFull','data'));
    }

    public function postEntryQuestionFull(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'packet_id' => 'required',
            'type_question' => 'required',
            'question' => 'required',
            'key_question' => 'required'
        ]);

        if ($request->part_question == 'A-SHORT TALKS') {
            $questionData = [
                'packet_id' => $request->packet_id,
                'type_question' => $request->type_question,
                'part_question' => 'A',
                'description_part_question' => 'Short Talks',
                'key_question' => $request->key_question,
            ];

            if ($request->hasFile('question')) {
                $file = $request->file('question');
                $fileName = $file->getClientOriginalName();
                $filePath = $file->storeAs('/questions', $fileName, 'public');
            // $filePath = Storage::cloud()->put('/questions', $file);

                $questionData['question_text'] = $filePath;
            } else {
                $questionData['question_text'] = $request->question;
            }

            $map = Question::create($questionData);
            MultipleChoice::create([
                'question_id' => $map->_id,
                'choice' => $request->key_question,
            ]);
        }

        if ($request->part_question == 'B-Long Conversation') {
            $questionData = [
                'packet_id' => $request->packet_id,
                'type_question' => $request->type_question,
                'part_question' => 'B',
                'description_part_question' => 'Long Conversation',
                'key_question' => $request->key_question,
            ];

            if ($request->hasFile('question')) {
                $file = $request->file('question');
                $fileName = $file->getClientOriginalName();
                $filePath = $file->storeAs('/questions', $fileName, 'public');
                // $filePath = Storage::cloud()->put('/questions', $file);

                $questionData['question_text'] = $filePath;
            } else {
                $questionData['question_text'] = $request->question;
            }

            $map = Question::create($questionData);
            MultipleChoice::create([
                'question_id' => $map->_id,
                'choice' => $request->key_question,
            ]);
        }

        if ($request->part_question == 'C-Mini-Lectures') {
            $questionData = [
                'packet_id' => $request->packet_id,
                'type_question' => $request->type_question,
                'part_question' => 'C',
                'description_part_question' => 'Mini-Lectures',
                'key_question' => $request->key_question,
            ];

            if ($request->hasFile('question')) {
                $file = $request->file('question');
                $fileName = $file->getClientOriginalName();
                $filePath = $file->storeAs('/questions', $fileName, 'public');
            // $filePath = Storage::cloud()->put('/questions', $file);

                $questionData['question_text'] = $filePath;
            } else {
                $questionData['question_text'] = $request->question;
            }

            $map = Question::create($questionData);
            MultipleChoice::create([
                'question_id' => $map->_id,
                'choice' => $request->key_question,
            ]);
        }

        if ($request->part_question == 'A-Sentence Completitions') {
            $questionData = [
                'packet_id' => $request->packet_id,
                'type_question' => $request->type_question,
                'part_question' => 'A',
                'description_part_question' => 'Sentence Completitions',
                'key_question' => $request->key_question,
            ];

            if ($request->hasFile('question')) {
                $file = $request->file('question');
                $fileName = $file->getClientOriginalName();
                $filePath = $file->storeAs('/questions', $fileName, 'public');
                // $filePath = Storage::cloud()->put('/questions', $file);

                $questionData['question_text'] = $filePath;
            } else {
                $questionData['question_text'] = $request->question;
            }

            $map = Question::create($questionData);
            MultipleChoice::create([
                'question_id' => $map->_id,
                'choice' => $request->key_question,
            ]);
        }

        if ($request->part_question == 'B-Error Recognition') {
            $questionData = [
                'packet_id' => $request->packet_id,
                'type_question' => $request->type_question,
                'part_question' => 'B',
                'description_part_question' => 'Error Recognition',
                'key_question' => $request->key_question,
            ];

            if ($request->hasFile('question')) {
                $file = $request->file('question');
                $fileName = $file->getClientOriginalName();
                $filePath = $file->storeAs('/questions', $fileName, 'public');
            // $filePath = Storage::cloud()->put('/questions', $file);

                $questionData['question_text'] = $filePath;
            } else {
                $questionData['question_text'] = $request->question;
            }

            $map = Question::create($questionData);
            MultipleChoice::create([
                'question_id' => $map->_id,
                'choice' => $request->key_question,
            ]);
        }

        if ($request->part_question == "") {
            $questionData = [
                'packet_id' => $request->packet_id,
                'type_question' => $request->type_question,
                'part_question' => "",
                'description_part_question' => "",
                'key_question' => $request->key_question,
            ];

            if ($request->hasFile('question')) {
                $file = $request->file('question');
                $fileName = $file->getClientOriginalName();
                $filePath = $file->storeAs('/questions', $fileName, 'public');
            // $filePath = Storage::cloud()->put('/questions', $file);

                $questionData['question_text'] = $filePath;
            } else {
                $questionData['question_text'] = $request->question;
            }

            $map = Question::create($questionData);
            MultipleChoice::create([
                'question_id' => $map->_id,
                'choice' => $request->key_question,
            ]);
        }

        return back()->with('success', 'Data Question Berhasil Ditambahkan');
    }

    public function entryMultiple(Request $request, $id)
    {
        $validatedData = $request->validate([
            'choice.*' => 'required|string',
        ]);

        $question = Question::findOrFail($id);

        $oldKeyQuestion = $question->key_question;

        if ($request->filled('key_question') && $request->key_question != $question->key_question) {
            $question->key_question = $request->key_question;
            $question->save();
            return back()->with('success', 'Data Question dan Multiple Choice berhasil diperbarui');
        }

        $key = Question::where('_id', $id)->first();
        $key = $key->key_question;

        MultipleChoice::where('question_id', $question->id)->delete();


        MultipleChoice::create([
            'question_id' => $question->id,
            'choice' => $key,
        ]);

        foreach ($request->choice as $choice) {
            MultipleChoice::create([
                'question_id' => $question->id,
                'choice' => $choice,
            ]);
        }

        $message = ($oldKeyQuestion != $question->key_question) ? 'Data Question dan Multiple Choice berhasil diperbarui' : 'Data Multiple Choice berhasil diperbarui';

        return back()->with('success', $message);
    }

    public function editQuestion(Request $request, $id)
    {
        if ($request->hasFile('question')) {
            $file = $request->file('question');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('/questions', $fileName, 'public');
            // $filePath = Storage::cloud()->put('/questions', $file);

            $questionData['question_text'] = $filePath;
        } else {
            $questionData['question_text'] = $request->question ? $request->question : null;
        }

        $question = Question::findOrFail($id);
        $question->question_text = $questionData['question_text'];
        $question->save();

        return back()->with('success', 'Data Question Berhasil Diubah');
    }

    public function editAnswer(Request $request, $id)
    {
        $request->validate([
            'key_question' => 'required',
        ]);

        $selectQuestionKeyAnswerAwal = Question::where('_id', $id)->first();
        $ambilKeyAnswerNya = $selectQuestionKeyAnswerAwal['key_question'];

        $question = Question::findOrFail($id);
        $question->key_question = $request->key_question;
        $question->save();

        // select init multiple choice
        MultipleChoice::where('question_id', $id)->where('choice', $ambilKeyAnswerNya)
            ->delete();

        MultipleChoice::create([
            'question_id' => $id,
            'choice' => $request->key_question,
        ]);

        return back()->with('success', 'Data Answer Berhasil Diubah');
    }

    public function entryNestedFullQuestion($id)
    {
        $data = $this->data;
        $initPaket = $id;
        $nestedQuestionPacket = NestedQuestion::where('packet_id', $id)->get();
        return view('datapacketfull.entrynested', compact('nestedQuestionPacket', 'initPaket', 'data'));
    }

    public function addNestedFullQuestion(Request $request, $id)
    {
          $request->validate([
            'question_nested' => 'required',
        ]);

        if ($request->hasFile('question_nested')) {
            $file = $request->file('question_nested');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('/nested_question', $fileName, 'public');
            // $filePath = Storage::cloud()->put('/nested_question', $file);

            $questionData['question_nested'] = $filePath;
            NestedQuestion::create([
                'packet_id' => $id,
                'question_nested' => $questionData['question_nested'],
            ]);
        } else {
            $questionData['question_nested'] = $request->question_nested;
            NestedQuestion::create([
                'packet_id' => $id,
                'question_nested' => $questionData['question_nested'],
            ]);
        }


        return back()->with('success', 'Data Nested Question Berhasil Ditambahkan');
    }

    public function getAllNested($idNested, $idPaket)
    {
        $data = $this->data;
        $initNestedQuestion = NestedQuestion::where('_id', $idNested)->first();
        $getAllQuestionPaket = Question::where('packet_id', $idPaket)->get();

        $getAllQuestionNotNested = [];
        foreach ($getAllQuestionPaket as $dataQuestion) {
            $cekDataNested = Nested::where('question_id', $dataQuestion->_id)->first();
            if (!$cekDataNested) {
                $getAllQuestionNotNested[] = $dataQuestion;
            }
        }

        $getAllQuestionNotNested = array_filter($getAllQuestionNotNested, function ($question) use ($idNested) {
            $nestedQuestions = Nested::where('nested_question_id', '!=', $idNested)->pluck('question_id')->toArray();
            return !in_array($question->_id, $nestedQuestions);
        });

        $getAllNestedQuestionPaket = Nested::with('question')->where('nested_question_id', $idNested)->get();

        return view('datapacketfull.getallnested', compact('getAllQuestionNotNested', 'getAllNestedQuestionPaket', 'idNested', 'initNestedQuestion', 'data'));
    }

    public function storeDataNested(Request $request, $id)
    {
        Nested::create([
            'nested_question_id' => $request->nested_question_id,
            'question_id' => $id,
        ]);

        return back()->with('success', 'Data Nested Question Berhasil Ditambahkan');
    }

    public function deleteNestedQuestion($id)
    {
        Nested::where('_id', $id)->delete();
        return back()->with('success', 'Data Nested Question Berhasil Dihapus');
    }

    // masukin
    public function editNested(Request $request, $id)
    {

        if ($request->hasFile('question_nested')) {
            $file = $request->file('question_nested');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('/nested_question', $fileName, 'public');
            // $filePath = Storage::cloud()->put('/nested_question', $file);
            $questionData['question_nested'] = $filePath;
            NestedQuestion::where('_id', $id)->update([
                'question_nested' => $questionData['question_nested'],
            ]);
        } else {
            $questionData['question_nested'] = $request->question_nested;
            NestedQuestion::where('_id', $id)->update([
                'question_nested' => $questionData['question_nested'],
            ]);
        }

        return back()->with('success', 'Data Nested Question Berhasil Diubah');
    }

    public function searchFullPaket(Request $request)
    {
        if($request->has('search')){
            $dataPacketFull = Paket::where('name_packet', 'LIKE', '%'.$request->search.'%')->where('tipe_test_packet', 'Full Test')->get();
        } else {
            $dataPacketFull = Paket::where('name_packet', 'LIKE', '%'.$request->search.'%')->where('tipe_test_packet', 'Full Test')->get();
        }

        return view('datapacketfull.first', compact('dataPacketFull'));
    }

    public function searchQuestion(Request $request, $id)
    {
        $search = $request->input('search');
        if($request->has('search')){
            $dataPacketFull = Paket::with(['questions' => function($query) use ($search) {
                $query->where('question_text', 'LIKE', "%{$search}%");
            }])->where('_id', $id)->get();
        } else {
            $dataPacketFull = Paket::with(['questions' => function($query) use ($search) {
                $query->where('question_text', 'LIKE', "%{$search}%");
            }])->where('_id', $id)->get();
        }


        $dataId = $id;
        return view('datapacketfull.index', compact('dataPacketFull', 'dataId'));
    }
}
