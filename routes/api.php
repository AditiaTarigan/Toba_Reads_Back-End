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

// PUBLIC ROUTES (bisa diakses tanpa login)
Route::get('/buku', [BukuController::class, 'index']); // List buku
Route::get('/buku/{id}', [BukuController::class, 'show']); // Detail buku
Route::get('/kategori', [KategoriBukuController::class, 'index']); // List kategori
Route::get('/penulis', [PenulisController::class, 'index']); // List penulis
Route::get('/karya', [KaryaUserController::class, 'index']); // List karya

// PROTECTED ROUTES (perlu login)
Route::middleware(['auth:sanctum'])->group(function () {
    // USERS
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    // BUKU (create, update, delete butuh login)
    Route::post('/buku', [BukuController::class, 'store']);
    Route::put('/buku/{id}', [BukuController::class, 'update']);
    Route::delete('/buku/{id}', [BukuController::class, 'destroy']);

    // LAST READ
    Route::get('/last-read/{id_user}', [BukuController::class, 'lastRead']);
    Route::post('/last-read', [BukuController::class, 'storeLastRead']);

    // REVIEW
    Route::post('/review', [ReviewController::class, 'store']);
    Route::delete('/review/{id}', [ReviewController::class, 'destroy']);

    // FAVORIT
    Route::get('/favorit/user/{id}', [FavoritController::class, 'indexByUser']);
    Route::post('/favorit', [FavoritController::class, 'store']);
    Route::delete('/favorit/{id}', [FavoritController::class, 'destroy']);

    // KARYA USER (create, update, delete butuh login)
    Route::post('/karya', [KaryaUserController::class, 'store']);
    Route::put('/karya/{id}', [KaryaUserController::class, 'update']);
    Route::delete('/karya/{id}', [KaryaUserController::class, 'destroy']);

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
    Route::post('/logout', [AuthController::class, 'logout']);

    // Tambahkan header CORS
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Requested-With');
});
