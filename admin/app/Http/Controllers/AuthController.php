<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    // LOGIN (ADMIN & KONSUMEN)
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // login admin
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect('/admin/dashboard');
        }

        // login konsumen
        if (Auth::guard('web')->attempt($credentials)) {
            return redirect('/user/dashboard');
        }

        return back()->with('error', 'Email atau password salah');
    }

    //  REGISTER (KONSUMEN SAJA)
    public function register(Request $request)
    {
        $request->validate([
            'nama_pemilik' => 'required|string|max:100',
            'email' => 'required|email|unique:konsumens,email',
            'password' => 'required|min:6',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

        User::create([
            'nama_pemilik' => $request->nama_pemilik,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil');
    }



    // LOGOUT (AMAN UNTUK MULTI AUTH)
    public function logout()
    {
        Auth::guard('admin')->logout();
        Auth::guard('web')->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/login'); // pastikan /login memang ada di web.php
    }


}
