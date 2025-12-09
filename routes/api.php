<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController; // ← INI YANG BENAR (tanpa \Api)
use App\Http\Controllers\PenulisController;
use App\Http\Controllers\KategoriBukuController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FavoritController;
use App\Http\Controllers\KaryaUserController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\KuisController;
use App\Http\Controllers\SoalKuisController;
use App\Http\Controllers\HasilKuisController;

// CORS Preflight Handler
Route::options('/{any}', function () {
    return response()->json();
})->where('any', '.*');

// AUTH
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// PUBLIC ROUTES (bisa diakses tanpa login)
Route::get('/buku', [BukuController::class, 'index']);
Route::get('/buku/{id}', [BukuController::class, 'show']);
Route::get('/kategori', [KategoriBukuController::class, 'index']);
Route::get('/penulis', [PenulisController::class, 'index']);
Route::get('/karya', [KaryaUserController::class, 'index']);

// USER PUBLIC ROUTES - EMAIL ONLY
Route::get('/user/email/{email}', [UserController::class, 'getByEmail']);

// PROTECTED ROUTES (perlu login)
Route::middleware(['auth:sanctum'])->group(function () {

    // AUTH & PROFILE
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user/profile', [AuthController::class, 'profile']);
    Route::put('/user/profile', [AuthController::class, 'updateProfile']);

    // USERS MANAGEMENT - EMAIL ONLY
    Route::get('/users', [UserController::class, 'index']);
    Route::put('/users/email/{email}', [UserController::class, 'updateByEmail']);
    Route::delete('/users/email/{email}', [UserController::class, 'destroyByEmail']);

    // BUKU MANAGEMENT
    Route::post('/buku', [BukuController::class, 'store']);
    Route::put('/buku/{id}', [BukuController::class, 'update']);
    Route::delete('/buku/{id}', [BukuController::class, 'destroy']);

    // LAST READ
    Route::get('/last-read/{id_user}', [BukuController::class, 'lastRead']);
    Route::post('/last-read', [BukuController::class, 'storeLastRead']);

    // REVIEW MANAGEMENT
    Route::get('/review/user/{id_user}', [ReviewController::class, 'getByUser']);
    Route::get('/review/buku/{id_buku}', [ReviewController::class, 'getByBuku']);
    Route::post('/review', [ReviewController::class, 'store']);
    Route::put('/review/{id}', [ReviewController::class, 'update']);
    Route::delete('/review/{id}', [ReviewController::class, 'destroy']);

    // FAVORIT MANAGEMENT
    Route::get('/favorit/user/{id}', [FavoritController::class, 'indexByUser']);
    Route::get('/favorit/check', [FavoritController::class, 'checkFavorit']);
    Route::post('/favorit', [FavoritController::class, 'store']);
    Route::delete('/favorit/{id}', [FavoritController::class, 'destroy']);
    Route::delete('/favorit/user/{id_user}/buku/{id_buku}', [FavoritController::class, 'destroyByUserAndBuku']);

    // KARYA USER MANAGEMENT
    Route::get('/karya/user/{id_user}', [KaryaUserController::class, 'getByUser']);
    Route::post('/karya', [KaryaUserController::class, 'store']);
    Route::put('/karya/{id}', [KaryaUserController::class, 'update']);
    Route::delete('/karya/{id}', [KaryaUserController::class, 'destroy']);

    // NOTIFIKASI MANAGEMENT
    Route::get('/notif/{id_user}', [NotifikasiController::class, 'index']);
    Route::post('/notif', [NotifikasiController::class, 'store']);
    Route::put('/notif/baca/{id}', [NotifikasiController::class, 'baca']);
    Route::put('/notif/baca-all/{id_user}', [NotifikasiController::class, 'bacaSemua']);
    Route::delete('/notif/{id}', [NotifikasiController::class, 'destroy']);

    // KUIS MANAGEMENT
    Route::apiResource('kuis', KuisController::class);
    Route::get('/kuis/buku/{id_buku}', [KuisController::class, 'getByBuku']);

    // SOAL KUIS MANAGEMENT
    Route::get('/soal/kuis/{id_kuis}', [SoalKuisController::class, 'getByKuis']);
    Route::post('/soal', [SoalKuisController::class, 'store']);
    Route::put('/soal/{id}', [SoalKuisController::class, 'update']);
    Route::delete('/soal/{id}', [SoalKuisController::class, 'destroy']);

    // HASIL KUIS MANAGEMENT
    Route::get('/hasil-kuis', [HasilKuisController::class, 'index']);
    Route::get('/hasil-kuis/user/{id_user}', [HasilKuisController::class, 'history']);
    Route::get('/hasil-kuis/kuis/{id_kuis}', [HasilKuisController::class, 'getByKuis']);
    Route::get('/hasil-kuis/user/{id_user}/kuis/{id_kuis}', [HasilKuisController::class, 'getByUserAndKuis']);
    Route::post('/hasil-kuis', [HasilKuisController::class, 'store']);
    Route::get('/hasil-kuis/{id}', [HasilKuisController::class, 'show']);

    // DASHBOARD & STATS - KOMENTARI DULU KARENA METHOD BELUM ADA
    // Route::get('/dashboard/stats/{id_user}', [UserController::class, 'getUserStats']);
    // Route::get('/dashboard/aktivitas/{id_user}', [UserController::class, 'getUserAktivitas']);

    // SEARCH
    Route::get('/search/buku', [BukuController::class, 'search']);
    Route::get('/search/karya', [KaryaUserController::class, 'search']);
});
