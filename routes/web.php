<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;

// 1. Route Root (/) - Mengarahkan Admin ke Dashboard, Tamu ke Login.
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('admin.dashboard');
    }
    // Mengarahkan ke admin.login, BUKAN admin.aauth.login
    return redirect()->route('admin.login');
})->name('home');

// 2. Route untuk Tamu (Login & Show Form)
Route::middleware('guest')->group(function () {
    // Nama rute: admin.login
    Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    // Nama rute: admin.login.submit
    Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
});

// 3. Route Admin yang Terproteksi
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Nama rute: admin.dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Nama rute: admin.logout
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});
