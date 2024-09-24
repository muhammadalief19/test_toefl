<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $data;

    public function __construct()
    {
        $this->data["title"] = "User List";
    }

    public function menu() {
        $data = $this->data;
        $data["title"] = "Menu";
        $data["userRoleData"] = UserRole::all();

        return view('user.menu', compact([
            'data'
        ]));
    }

    public function index($role) {
        $data = $this->data;
        $data["userData"] = User::with(["role"])->where('role_id', $role)->get();
        $data["no"] = 1;
        $data["role"] = UserRole::find($role);

        return view('user.index', compact([
            'data'
        ]));
    }


}
