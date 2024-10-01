<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaterialType;
class MaterialTypeController extends Controller
{
    private $data;
    public function __construct()
    {
        $this->data["title"] = "Material Types";
    }

    public function index(){
        $data = $this->data;
        $data['no'] = 1;
        $data["materialTypeData"] = MaterialType::all();

        return view('materialType.index', compact('data'));
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'type_name' => 'required'
        ],
        [
            'type_name.required' => 'Tipe Material Wajib Diisi',
        ],);

        $createData = MaterialType::create([
            'type_name' => $validatedData['type_name'],
        ]);

        if ($createData) {
            toastr()->success('Tipe Material berhasil ditambahkan');
            return back();
        } else {
            toastr()->error('Tipe Material gagal ditambahkan');
            return back();
        }
    }

    public function update(Request $request, $id){
        $MaterialType = MaterialType::find($id);

        if(!$MaterialType) {
            toastr()->error('Tipe Material tidak ditemukan');
            return back();
        }

        $validatedData = $request->validate([
            'type_name' => 'required'
        ],
        [
            'type_name.required' => 'Tipe Material Wajib Diisi',
        ],);

        $updateData = $MaterialType->update($validatedData);

        if ($updateData) {
            toastr()->success('Tipe Material berhasil diupdate');
            return back();
        } else {
            toastr()->error('Tipe Material gagal diupdate');
            return back();
        }
    }

    public function destroy($id){
        $MaterialType = MaterialType::find($id);

        if (!$MaterialType) {
            toastr()->error('Tipe Material tidak ditemukan');
            return back();
        }

        $deleteData = $MaterialType->delete();

        if ($deleteData) {
            toastr()->success('Tipe Material berhasil dihapus');
            return back();
        } else {
            toastr()->error('Tipe Material gagal dihapus');
            return back();
        }
    }
}
