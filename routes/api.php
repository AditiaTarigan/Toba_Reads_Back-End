<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    UserController,
    PenulisController,
    KategoriBukuController,
    BukuController,
    ReviewController,
    FavoritController,
    KaryaUserController,
    NotifikasiController,
    KuisController,
    SoalKuisController,
    HasilKuisController
};

// AUTH
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// USERS
Route::middleware([])->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
});

// PENULIS
Route::apiResource('penulis', PenulisController::class);

// KATEGORI BUKU
Route::apiResource('kategori', KategoriBukuController::class);

// BUKU
Route::apiResource('buku', BukuController::class);

// REVIEW
Route::post('/review', [ReviewController::class, 'store']);
Route::delete('/review/{id}', [ReviewController::class, 'destroy']);

// FAVORIT
Route::get('/favorit/user/{id}', [FavoritController::class, 'indexByUser']);
Route::post('/favorit', [FavoritController::class, 'store']);
Route::delete('/favorit/{id}', [FavoritController::class, 'destroy']);

// KARYA USER
Route::apiResource('karya', KaryaUserController::class);

// NOTIFIKASI
Route::get('/notif/{id_user}', [NotifikasiController::class, 'index']);
Route::put('/notif/baca/{id}', [NotifikasiController::class, 'baca']);

// KUIS
Route::apiResource('kuis', KuisController::class);

// SOAL KUIS
Route::post('/soal', [SoalKuisController::class, 'store']);

// HASIL KUIS
Route::post('/hasil-kuis', [HasilKuisController::class, 'store']);
Route::get('/hasil-kuis/user/{id_user}', [HasilKuisController::class, 'history']);

// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
