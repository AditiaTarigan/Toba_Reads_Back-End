<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 🚨 Perbaikan 1: Gunakan Guard 'web' untuk attempt
        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();

            // Ambil user dari guard 'web'
            $user = Auth::guard('web')->user();

            // 🚨 Perbaikan 2: Cek Role menggunakan user dari Guard 'web'
            if ($user->role->nama_role !== 'admin') {
                Auth::guard('web')->logout(); // Logout dari guard 'web'
                return back()->withErrors(['email' => 'Akun ini bukan akun Admin.']);
            }

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        // 🚨 Perbaikan 3: Logout dari Guard 'web'
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
