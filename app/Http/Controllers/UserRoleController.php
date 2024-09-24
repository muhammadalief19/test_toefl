<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\toastr;

class UserRoleController extends Controller
{
    private $data;

    public function __construct()
    {
        $this->data["title"] = "User Role";
    }

    public function index()
    {
        $data = $this->data;
        $data["userRoleData"] = UserRole::all();
        $data["no"] = 1;
        return view('userRole.index', compact(['data']));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'role_name' => 'required',
            ],
            [
                'role_name.required' => 'Nama Role Wajib Diisi',
            ],
        );

        $createData = UserRole::create($validatedData);

        if ($createData) {
            toastr()->success('User Role berhasil ditambahkan');
            return back();
        } else {
            toastr()->error('User Role gagal ditambahkan');
            return back();
        }
    }

    public function update(Request $request, $id)
    {
        $role = UserRole::find($id);

        if(!$role) {
            toastr()->success('User Role Tidak Ditemukan');
            return back();
        }

        $validatedData = $request->validate(
            [
                'role_name' => 'required',
            ],
            [
                'role_name.required' => 'Nama Role Wajib Diisi',
            ],
        );

        $updateData = $role->update($validatedData);

        if ($updateData) {
            toastr()->success('User Role berhasil diupdate');
            return back();
        } else {
            toastr()->error('User Role gagal diupdate');
            return back();
        }
    }

    public function destroy($id) {
        $role = UserRole::find($id);

        if(!$role) {
            toastr()->success('User Role Tidak Ditemukan');
            return back();
        }

        $deleteData = $role->delete();

        if ($deleteData) {
            toastr()->success('User Role berhasil didelete');
            return back();
        } else {
            toastr()->error('User Role gagal didelete');
            return back();
        }
    }
}
