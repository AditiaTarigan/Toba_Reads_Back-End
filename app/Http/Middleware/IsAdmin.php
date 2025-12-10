<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah user login
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        // 2. Cek Role.
        // Asumsi: Di Model User ada relasi function role() { return $this->belongsTo(Role::class); }
        // Dan di tabel roles ada kolom 'nama_role'
        if (Auth::user()->role->nama_role !== 'admin') {
            Auth::logout();
            return redirect()->route('admin.login')->withErrors(['email' => 'Akses ditolak. Anda bukan Admin.']);
        }

        return $next($request);
    }
}
