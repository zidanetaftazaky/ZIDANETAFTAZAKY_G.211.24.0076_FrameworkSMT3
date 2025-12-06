<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Proses autentikasi user
     */
    public function authenticate(Request $request)
    {
        // Validasi input form
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        // Coba login dengan data dari tabel users
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/perpus'); // ke dashboard
        }

        // Jika gagal login
        return back()->with('loginError', 'Username atau Password salah.');
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        Auth::logout(); // hapus autentikasi

        $request->session()->invalidate(); // hapus session
        $request->session()->regenerateToken(); // buat token baru

        // kembali ke halaman login
        return redirect('/login')->with('success', 'Anda telah logout.');
    }
}
