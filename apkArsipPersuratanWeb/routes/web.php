<?php

use App\Http\Controllers\ArsipController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TemplateSuratController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Middleware untuk proses login
Route::middleware(['guest'])->group(function () {
    Route::get('/', [SessionController::class, 'index'])->name('login');
    Route::post('/', [SessionController::class, 'login']);
});

Route::get('/home', function () {
    return redirect('/dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ArsipController::class, 'index']);
    Route::get('/surat_arsip', [ArsipController::class, 'arsip'])->middleware('userAkses:admin');
    Route::get('/logout', [SessionController::class, 'logout']);
    Route::get('/profile', [UserController::class, 'profile'])->middleware('userAkses:admin,user');
    Route::get('/profile/update', [UserController::class, 'profileUpdate'])->middleware('userAkses:admin,user');
});

Route::middleware(['auth', 'userAkses:admin'])->group(function () {
    // Rute untuk manajemen arsip
    Route::get('/surat_arsip/search', [ArsipController::class, 'searchArsip']);
    Route::post('/arsip/store', [ArsipController::class, 'store']);
    Route::get('/arsip/hapus/{id}', [ArsipController::class, 'hapus']);
    Route::get('/surat_arsip/edit/{id}', [ArsipController::class, 'edit']);
    Route::post('/arsip/update', [ArsipController::class, 'update']);
    Route::get('/pengarsipan_surat', [ArsipController::class, 'tambah']);

    // Rute untuk pembuatan surat
    Route::get('/pembuatan_surat_ijin', [TemplateSuratController::class, 'ijin']);
    Route::get('/pembuatan_surat_pengantar', [TemplateSuratController::class, 'index']);
    Route::get('/pembuatan_surat_perintah', [TemplateSuratController::class, 'index']);
    Route::get('/pembuatan_surat_pernyataan', [TemplateSuratController::class, 'index']);
    Route::get('/settings', [TemplateSuratController::class, 'settings']);
});

// Rute untuk pembuatan surat berdasarkan hak akses admin
Route::middleware(['auth', 'userAkses:admin'])->group(function () {
    Route::get('/pembuatan_surat_ijin', [TemplateSuratController::class, 'ijin']);
    Route::get('/pembuatan_surat_pengantar', [TemplateSuratController::class, 'pengantar']);
    Route::get('/pembuatan_surat_perintah', [TemplateSuratController::class, 'perintah']);
    Route::get('/pembuatan_surat_pernyataan', [TemplateSuratController::class, 'pernyataan']);
});

// Rute untuk manajemen surat masuk
Route::middleware(['auth', 'userAkses:admin,user'])->group(function () {
    Route::get('/surat_masuk', [ArsipController::class, 'masuk'])->name('masuk');
    Route::get('/surat_masuk/tambah', [ArsipController::class, 'masukTambah']);
    Route::post('/surat_masuk/store', [ArsipController::class, 'masukStore']);
    Route::get('/surat_masuk/edit/{id}', [ArsipController::class, 'masukEdit']);
    Route::post('/surat_masuk/update', [ArsipController::class, 'masukUpdate']);
    Route::get('/surat_masuk/hapus/{id}', [ArsipController::class, 'masukHapus']);
});

// Rute untuk manajemen surat keluar
Route::middleware(['auth', 'userAkses:admin,user'])->group(function () {
    Route::get('/surat_keluar', [ArsipController::class, 'keluar'])->name('keluar');
    Route::get('/surat_keluar/edit/{id}', [ArsipController::class, 'keluarEdit']);
    Route::post('/surat_keluar/store', [ArsipController::class, 'keluarStore']);
    Route::post('/surat_keluar/update', [ArsipController::class, 'keluarUpdate']);
    Route::get('/surat_keluar/hapus/{id}', [ArsipController::class, 'keluarHapus']);
});

// Rute untuk pembaruan profil pengguna
Route::post('/user/update', [UserController::class, 'updateProfile']);

// Rute untuk melihat profil dan pengaturan berdasarkan hak akses
Route::middleware(['auth', 'userAkses:admin,user'])->group(function () {
    Route::get('/profile', [UserController::class, 'profile']);
    Route::get('/settings', [TemplateSuratController::class, 'settings']);
});

// Rute untuk melihat pratinjau berdasarkan hak akses
Route::get('/preview/{pdf}', [ArsipController::class, 'preview'])->name('preview');
