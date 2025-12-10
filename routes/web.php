<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;

<<<<<<< HEAD
// Redirect root ke login admin (opsional)
Route::get('/', function () {
    return redirect()->route('admin.login');
});

// Group Route untuk Tamu (Belum Login)
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
});

// Group Route Admin (Terproteksi Middleware 'auth' DAN 'admin')
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    // Nanti tambahkan route kelola buku di sini
    // Route::get('/books', ...);
});
=======
// HAPUS withoutMiddleware untuk semua route
Route::get('/', function () {
    return view('welcome');
}); // TANPA withoutMiddleware

Route::get('/hallo', function () {
    return view('hallo');
}); // TANPA withoutMiddleware
>>>>>>> 8b49cacd0caf28484b6dbb5034e1e644ba5506d5
