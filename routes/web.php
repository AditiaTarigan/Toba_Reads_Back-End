<?php

use Illuminate\Support\Facades\Route;

// HAPUS withoutMiddleware untuk semua route
Route::get('/', function () {
    return view('welcome');
}); // TANPA withoutMiddleware

Route::get('/hallo', function () {
    return view('hallo');
}); // TANPA withoutMiddleware
