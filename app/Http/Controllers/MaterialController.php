<?php

namespace App\Http\Controllers;


use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Material;
use App\Models\MaterialType;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Exception;
use Log;
use FFMpeg\FFMpeg;
use FFMpeg\FFProbe;

class MaterialController extends Controller
{
    private $data;
    public function __construct()
    {
        $this->data["title"] = "Material";
    }

    public function index(){
        $data = $this->data;
        $data['no'] = 1;
        $data["materialData"] = Material::with('module')->get();
        $data["materialTypeData"] = MaterialType::all();
        $data["moduleData"] = Module::all();
        return view('material.index', compact('data'));
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'module_id' => 'required',
            'type_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'file_path' => 'nullable|file|mimes:mp4,mov,ogg,qt',
        ],
        [
            'module_id.required' => 'Id Module Wajib Diisi',
            'type_id.required' => 'Tipe Materi Wajib Diisi',
            'title.required' => 'Judul Module Wajib Diisi',
            'description.required' => 'Deskripsi Module Wajib Diisi',
        ]);

        $date = new Carbon();
        $save_video = null;
        $duration = null;

        if ($request->hasFile('file_path')) {
            $video = $request->file('file_path');
            $videoName = $video->getClientOriginalName(); // Ambil nama file asli
            $videoPath = public_path('storage/module/video/' . $videoName);

            // Cek apakah file dengan nama tersebut sudah ada di disk
            if (!file_exists($videoPath)) {
                // Jika belum ada, simpan file baru
                $video->move(public_path('storage/module/video/'), $videoName);
            }

            $save_video = 'storage/module/video/' . $videoName;

            // Hitung durasi video
            $ffprobe = FFProbe::create();
            $duration = $ffprobe
                ->format(public_path($save_video))
                ->get('duration');

            $duration = (int)$duration; // Konversi ke detik dan bulatkan
        }

        $createData = Material::create([
            'module_id' => $validatedData['module_id'],
            'type_id' => $validatedData['type_id'],
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'file_path' => $save_video,
            'duration' => $duration,
            'created_at' => $date->now()->isoFormat('Y-M-D H:mm:ss'),
        ]);

        if ($createData) {
            toastr()->success('Materi berhasil ditambahkan');
            return back();
        } else {
            toastr()->error('Materi gagal ditambahkan');
            return back();
        }
    }


    public function update(Request $request, $id){
        $Materi = Material::find($id);

        if(!$Materi) {
            toastr()->error('Materi tidak ditemukan');
            return back();
        }

        $validatedData = $request->validate([
            'module_id' => 'required',
            'type_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'file_path' => 'nullable|file|mimes:mp4,mov,ogg,qt',
        ],
        [
            'module_id.required' => 'Id Module Wajib Diisi',
            'type_id.required' => 'Tipe Materi Wajib Diisi',
            'title.required' => 'Judul Module Wajib Diisi',
            'description.required' => 'Deskripsi Module Wajib Diisi',
        ]);

        $date = new Carbon();
        $save_video = null;
        $duration = null;

        if ($request->hasFile('file_path')) {
            $video = $request->file('file_path');
            $videoName = $video->getClientOriginalName(); // Ambil nama file asli
            $videoPath = public_path('storage/module/video/' . $videoName);

            // Cek apakah file dengan nama tersebut sudah ada di disk
            if (!file_exists($videoPath)) {
                // Jika belum ada, simpan file baru
                $video->move(public_path('storage/module/video/'), $videoName);
            }

            $save_video = 'storage/module/video/' . $videoName;

            // Hitung durasi video
            $ffprobe = FFProbe::create();
            $duration = $ffprobe
                ->format(public_path($save_video))
                ->get('duration');

            $duration = (int)$duration; // Konversi ke detik dan bulatkan
        }

        $updateData = $Materi->update([
            'module_id' => $validatedData['module_id'],
            'type_id' => $validatedData['type_id'],
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'file_path' => $save_video,
            'duration' => $duration,
            'created_at' => $date->now()->isoFormat('Y-M-D H:mm:ss'),
        ]);

        if ($updateData) {
            toastr()->success('Materi berhasil diupdate');
            return back();
        } else {
            toastr()->error('Materi gagal diupdate');
            return back();
        }
    }



    public function destroy($id){
        $Materi = Material::find($id);

        if (!$Materi) {
            toastr()->error('Materi tidak ditemukan');
            return back();
        }

        $deleteData = $Materi->delete();

        if ($deleteData) {
            toastr()->success('Materi berhasil dihapus');
            return back();
        } else {
            toastr()->error('Materi gagal dihapus');
            return back();
        }
    }
}
