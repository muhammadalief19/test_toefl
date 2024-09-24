<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class SSOController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.sso-login'); // Form login Blade
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!($token = JWTAuth::attempt($credentials))) {
            return back()->withErrors(['error' => 'Email atau password salah']);
        }

        // Simpan token di session
        session(['jwt_token' => $token]);

        return redirect('/dashboard');
    }

    public function logout()
    {
        Auth::logout();
        session()->forget('jwt_token');
        return redirect('/login');
    }
}
