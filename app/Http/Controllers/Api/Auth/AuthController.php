<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserScorer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::guard('api')->attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::guard('api')->user();
        return response()->json([
            'success' => true,
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
                function ($attribute, $value, $fail) {
                    $allowedDomains = ['pens.ac.id', 'it.student.pens.ac.id']; // Tambahkan domain yang diizinkan di sini
                    $domain = substr(strrchr($value, "@"), 1);
                    if (!in_array($domain, $allowedDomains)) {
                        $fail('The ' . $attribute . ' must be a valid email address with allowed domains: ' . implode(', ', $allowedDomains));
                    }
                },
            ],
            // 'prodi' => 'required|string|max:255',
            // 'nrp' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            // 'prodi' => $request->prodi,
            // 'nrp' => $request->nrp,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'target_id' => "",
        ]);

        $token = Auth::guard('api')->login($user);
        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function logout()
    {
        Auth::guard('api')->logout();
        return response()->json([
            'success' => true,
            'message' => 'Successfully logged out',
        ]);
    }

    public function profile()
    {
        $user = auth()->user()->_id;
        $userInit = User::with('target')->where('_id', $user)->first();
        $scoreUserLatest = UserScorer::where('user_id', $user)->latest()->first();
        if ($scoreUserLatest == null) {
            return response()->json([
                'success' => true,
                'message' => 'level and score are not available yet. (belum isi level dan test)',
                'data' => [
                    'id' => $userInit->_id,
                    'level' => "",
                    'current_score' => "",
                    'target_score' => $userInit->target ? $userInit->target->score_target : "",
                    'name_user' => $userInit->name,
                    'email_user' => $userInit->email,
                ]
            ], 201);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data Profile User has completed',
            'data' => [
                'id' => $userInit->_id,
                'level' => $scoreUserLatest->level_profiency,
                'current_score' => $scoreUserLatest->score_toefl,
                'target_score' => $userInit->target ? $userInit->target->score_target : "",
                'name_user' => $userInit->name,
                'email_user' => $userInit->email,
            ]
        ], 200);
    }
}
