<?php

namespace App\Http\Controllers;

use App\Mail\RegisterMail;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Mail;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function verifyLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $email = $request->email;
        $password = $request->password;
        #1. ambil user berdasarkan email dan cek apakah sudah verifikasi email
        $user = User::query()
            ->where('email', $email)
            ->whereNotNull('email_verified_at')
            ->first();
        #cek apakah user dengan email tersebut ada atau tidak
        if ($user === null) {
            return redirect('/login')->with('error', 'User tidak ditemukan');
        }
        #kondisi usernya ada
        #cek password apakah sama atau tidak
        if (password_verify($password, $user->password)) {
            #kondisi benar
            Auth::login($user);
            return redirect('/dashboard');
        }
        return redirect('/login')->with('error', 'User tidak ditemukan');

    }
    public function register()
    {
        return view('auth.register');
    }

    public function prosesRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);
        #kondisi dimana semua inputan sudah benar
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = password_hash($request->password, PASSWORD_DEFAULT);
        $user->save();
        #kirimkan emailnya
        Mail::to($request->email)->send(new RegisterMail($user));
        return redirect('/login')
            ->with('success', 'Register berhasil silahkan konfirmasi register diemail anda');

    }

    public function registerVerify($email, $token)
    {
        $emailHash = md5($email);
        if ($emailHash !== $token) {
            return redirect('/login')->with('error', 'User Tidak di temukan');
        }
        #tokennya benar
        $user = User::query()->where('email', $email)->first();
        if ($user === null) {
            return redirect('/login')->with('error', 'User Tidak di temukan');
        }
        #user ada
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->save();
        return redirect('/login')->with('success', 'Akun anda berhasil diaktivasi');
    }
}
