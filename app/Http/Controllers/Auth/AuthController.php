<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        $role = UserRole::where('role_name', 'admin')->first();
        if (Auth::attempt($credentials)) {
            if (Auth::user()->role_id == $role->_id) {
                return redirect()->route('dashboard');
            } else {
                return back()->with('error', 'u dont have permisson to access admin panel etoefl');
            }
        }
        return redirect()->back()->with('error', 'Email atau Password salah');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
