<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    private $data;

    public function __construct()
    {
        $this->data['title'] = 'Configuration';
    }

    public function index() {
        $data = $this->data;
        $data["no"] = 1;
        $data['configurationData'] = Configuration::all();

        return view('configuration.index', compact(['data']));
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            "config_name" => "required|string",
            "config_value" => "required|string"
        ]);

        $createData = Configuration::create($validatedData);

        if($createData) {
            toastr()->success('Configuration berhasil ditambahkan');
            return back();
        } else {
            toastr()->error('Configuration gagal ditambahkan');
            return back();
        }
    }

    public function update(Request $request, $id) {
        $config = Configuration::find($id);

        if(!$config) {
            toastr()->error('Configuration Tidak Ditemukan');
            return back();
        }

        $validatedData = $request->validate([
            "config_name" => "required|string",
            "config_value" => "required|string"
        ]);

        $updateData = $config->update($validatedData);

        if($updateData) {
            toastr()->success('Configuration berhasil diupdate');
            return back();
        } else {
            toastr()->error('Configuration gagal diupdate');
            return back();
        }
    }

    public function destroy($id) {
        $config = Configuration::find($id);

        if(!$config) {
            toastr()->error('Configuration Tidak Ditemukan');
            return back();
        }

        $deleteData = $config->delete();

        if($deleteData) {
            toastr()->success('Configuration berhasil didelete');
            return back();
        } else {
            toastr()->error('Configuration gagal didelete');
            return back();
        }
    }
}
