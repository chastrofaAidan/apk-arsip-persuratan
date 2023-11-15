<?php

use App\Http\Controllers\ArsipController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TemplateSuratController;
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
});

Route::middleware(['auth', 'userAkses:admin'])->group(function () {
    // Rute untuk manajemen arsip
    Route::get('/surat_arsip/search', 'ArsipController@searchArsip');
    Route::post('/arsip/store', 'ArsipController@store');
    Route::get('/arsip/hapus/{id}', 'ArsipController@hapus');
    Route::get('/surat_arsip/edit/{id}', 'ArsipController@edit');
    Route::post('/arsip/update', 'ArsipController@update');
    Route::get('/pengarsipan_surat', 'ArsipController@tambah');

    // Rute untuk pembuatan surat
    Route::get('/pembuatan_surat_ijin', 'TemplateSuratController@ijin');
    Route::get('/pembuatan_surat_pengantar', 'TemplateSuratController@index');
    Route::get('/pembuatan_surat_perintah', 'TemplateSuratController@index');
    Route::get('/pembuatan_surat_pernyataan', 'TemplateSuratController@index');
    Route::get('/settings', 'TemplateSuratController@settings');
    Route::get('/profile', 'TemplateSuratController@profile');
    Route::get('/profile/update', 'TemplateSuratController@profileUpdate');
    Route::get('/surat_ijin', 'TemplateSuratController@suratIjin');
    Route::get('/surat_pengantar', 'TemplateSuratController@suratPengantar');
    Route::get('/surat_perintah', 'TemplateSuratController@suratPerintah');
    Route::get('/surat_pernyataan', 'TemplateSuratController@suratPernyataan');
});

// Rute untuk pembuatan surat berdasarkan hak akses admin
Route::get('/pembuatan_surat_ijin', [TemplateSuratController::class, 'ijin'])->middleware('userAkses:admin');
Route::get('/pembuatan_surat_pengantar', [TemplateSuratController::class, 'pengantar'])->middleware('userAkses:admin');
Route::get('/pembuatan_surat_perintah', [TemplateSuratController::class, 'perintah'])->middleware('userAkses:admin');
Route::get('/pembuatan_surat_pernyataan', [TemplateSuratController::class, 'pernyataan'])->middleware('userAkses:admin');

// Rute untuk manajemen surat masuk
Route::get('/surat_masuk', [ArsipController::class, 'masuk'])->middleware('userAkses:admin,user')->name('masuk');
Route::get('/surat_masuk/tambah', [ArsipController::class, 'masukTambah'])->middleware('userAkses:admin');
Route::post('/surat_masuk/store', [ArsipController::class, 'masukStore'])->middleware('userAkses:admin');
Route::get('/surat_masuk/edit/{id}', [ArsipController::class, 'masukEdit'])->middleware('userAkses:admin');
Route::post('/surat_masuk/update', [ArsipController::class, 'masukUpdate'])->middleware('userAkses:admin');
Route::get('/surat_masuk/hapus/{id}', [ArsipController::class, 'masukHapus'])->middleware('userAkses:admin');

// Rute untuk manajemen surat keluar
Route::get('/surat_keluar', [ArsipController::class, 'keluar'])->middleware('userAkses:admin,user')->name('keluar');
Route::get('/surat_keluar/edit/{id}', [ArsipController::class, 'keluarEdit'])->middleware('userAkses:admin');
Route::post('/surat_keluar/store', [ArsipController::class, 'keluarStore'])->middleware('userAkses:admin');
Route::post('/surat_keluar/update', [ArsipController::class, 'keluarUpdate'])->middleware('userAkses:admin');
Route::get('/surat_keluar/hapus/{id}', [ArsipController::class, 'keluarHapus'])->middleware('userAkses:admin');

// Rute untuk pembaruan profil pengguna
Route::post('/user/update', 'TemplateSuratController@updateProfile');

// Rute untuk melihat profil dan pengaturan berdasarkan hak akses
Route::get('/profile', [TemplateSuratController::class, 'profile'])->middleware('userAkses:admin,user');
Route::get('/settings', [TemplateSuratController::class, 'settings'])->middleware('userAkses:admin');

// Rute untuk melihat pratinjau berdasarkan hak akses
Route::get('/preview/{pdf}', 'ArsipController@preview')->name('preview');

// Rute untuk manajemen soft deletes pada Wali Kelas (tidak aktifkan untuk sementara)
// Route::get('/walas/trash', 'WalasController@trash');
// Route::get('/walas/kembalikan/{id}', 'WalasController@kembalikan');
// Route::get('/walas/kembalikan_semua', 'WalasController@kembalikan_semua');
// Route::get('/walas/hapus_permanen/{id}', 'WalasController@hapus_permanen');
// Route::get('/walas/hapus_permanen_semua', 'WalasController@hapus_permanen_semua');
