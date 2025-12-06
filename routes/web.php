<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PinjamController;
use App\Http\Controllers\PerpusController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Halaman Awal & Info
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('/perpus/login');
});

Route::get('/info', function () {
    return view('info', ['progdi' => 'TI']);
});

Route::get('/info/{kd}', [InfoController::class, 'infoMhs']);


/*
|--------------------------------------------------------------------------
| Autentikasi (Login & Logout)
|--------------------------------------------------------------------------
*/
// Halaman login hanya bisa dibuka oleh user yang belum login
Route::get('/login', [PerpusController::class, 'login'])->middleware('guest')->name('login');

// Proses login
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');

// Logout (hanya untuk yang sudah login)
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');


/*
|--------------------------------------------------------------------------
| Halaman Utama (Hanya setelah login)
|--------------------------------------------------------------------------
*/
Route::get('/perpus', [PerpusController::class, 'index'])->middleware('auth');


/*
|--------------------------------------------------------------------------
| CRUD Buku (Hanya untuk user login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Buku
    Route::get('/buku', [BukuController::class, 'index']);
    Route::get('/buku/add', [BukuController::class, 'add']);
    Route::post('/buku/save', [BukuController::class, 'save']);
    Route::get('/buku/edit/{id}', [BukuController::class, 'edit']);
    Route::get('/buku/delete/{id}', [BukuController::class, 'delete']);

    // Anggota
    Route::get('/anggota', [AnggotaController::class, 'index']);
    Route::get('/anggota/add', [AnggotaController::class, 'add']);
    Route::post('/anggota/save', [AnggotaController::class, 'save']);
    Route::get('/anggota/edit/{id}', [AnggotaController::class, 'edit']);
    Route::get('/anggota/delete/{id}', [AnggotaController::class, 'delete']);

    // Peminjaman
    Route::get('/pinjam', [PinjamController::class, 'index']);
    Route::get('/pinjam/add', [PinjamController::class, 'add']);
    Route::post('/pinjam/save', [PinjamController::class, 'save']);
    Route::get('/pinjam/edit/{id}', [PinjamController::class, 'edit']);
    Route::get('/pinjam/delete/{id}', [PinjamController::class, 'delete']);
});
