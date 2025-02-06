<?php

namespace App\Http\Controllers;

use App\Mail\CreateUserMail;
use App\Mail\RegisterOtpMail;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    private $data;

    public function __construct()
    {
        $this->data['title'] = 'User List';
    }

    public function menu()
    {
        $data = $this->data;
        $data['title'] = 'Menu';
        $data['userRoleData'] = UserRole::all();

        return view('user.menu', compact(['data']));
    }

    public function index($role)
    {
        $data = $this->data;
        $data['userData'] = User::with(['role'])
            ->where('role_id', $role)
            ->get();
        $data['no'] = 1;
        $data['role'] = UserRole::find($role);

        return view('user.index', compact(['data']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role_id' => 'required',
        ]);

        $validTokenRegister = rand(1000, 9999);
        $now = now();  // Waktu saat ini
        $expiredAt = $now->copy()->addHour()->toDateTimeString();
        $password = uniqid();

        $role = UserRole::where('_id', $request->role_id)->first();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'role_id' => $role->_id,
            'otp_register' => $validTokenRegister,
            'otp_register_expired_at' => $expiredAt,
            'otp_forgot' => null,
            'otp_forgot_expired_at' => null,
            'is_verified_register' => false,
            'is_verified_forgot' => false,
            'email_verified_at' => null,
        ]);

        $get_user_email = $user['email'];
        $get_user_name = $user['name'];
        Mail::to($user['email'])->send(new RegisterOtpMail($get_user_email, $get_user_name, $validTokenRegister));
        Mail::to($user['email'])->send(new CreateUserMail($get_user_email, $get_user_name, $password));

        if ($user) {
            toastr()->success('User berhasil ditambahkan');
            return back();
        } else {
            toastr()->error('User gagal ditambahkan');
            return back();
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::where('_id', $id)->first();

        if(!$user) {
            toastr()->error('User Tidak Ditemukan');
            return back();
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $updatedData = $user->update($validatedData);

        if ($updatedData) {
            toastr()->success('User berhasil diupdate');
            return back();
        } else {
            toastr()->error('User gagal diupdate');
            return back();
        }
    }

    public function destroy($id) {
        $user = User::find($id);

        if(!$user) {
            toastr()->error('User Tidak Ditemukan');
            return back();
        }

        $deleteData = $user->delete();

        if ($deleteData) {
            toastr()->success('User berhasil didelete');
            return back();
        } else {
            toastr()->error('User gagal didelete');
            return back();
        }
    }

}
