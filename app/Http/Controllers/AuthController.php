<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function verifyLogin (Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $email = $request->email;
        $password = $request->password;

        $user = User::query()->where('email', $email)->first();
        if($user === null){
            return redirect('/login')->with(['error','User tidak ditemukan']);
        }
        #kondisi user ada
        #cek password apakah sama / tidak
        if(password_verify($password,$user->password)){
            #jika password benar
            Auth::login($user);
            return redirect('/dashboard');
        }
        #jika password salah
        return redirect('/login')->with(['error','Password salah']);
    }
}