<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController
{
    public function login()
    {
        return view('auth.login');
    }

    public function auth(Request $request)
    {
        $validator = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        $email = $validator['email'];
        $password = $validator['password'];
        
        if (Auth::guard('web')->attempt(['email' => $email, 'password' => $password])) {
            return redirect()->route('dashboard')->with('loginSuccess', "Login Berhasil");
        } elseif (Auth::guard('customer')->attempt(['email' => $email, 'password' => $password])) {
            return redirect()->route('client')->with('loginSuccess', "Login Berhasil");
        } else {
            return back()->with('loginError', "Email atau Password Anda salah!");
        }
        
    }

    public function logout(Request $request)
    {
        //Log out
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
