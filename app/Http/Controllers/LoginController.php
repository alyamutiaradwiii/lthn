<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function auth(Request $request)
    {
        $validasi = $request->validate([
            'email' => 'required',
            'password' => 'required|min:5'
        ],
        [
            'email.required' => 'email wajib diisi',
            'password.required' => 'password wajib di isi',
            'password.min' => 'password minimal 5 karakter',

        ]);

        if (Auth::attempt($validasi)){
            $request->session()->regenerate();

            return redirect()->route('buku.index')->with('success', 'Login Berhasil!!');
        }

        return back();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
