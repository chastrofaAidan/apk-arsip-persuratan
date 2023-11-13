<?php

use App\Http\Controllers\ArsipController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TemplateSuratController;
use Illuminate\Support\Facades\Route;


// Middleware Login
Route::middleware(['guest'])->group(function () {
    Route::get('/', [SessionController::class, 'index'])->name('login');
    Route::post('/', [SessionController::class, 'login']);
});
Route::get('/home', function () {
    return redirect('/dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ArsipController::class, 'index']);
    // Route::get('/surat_masuk', [ArsipController::class, 'masuk'])->middleware('userAkses:superadmin');
    // Route::get('/surat_keluar', [ArsipController::class, 'keluar'])->middleware('userAkses:superadmin');
    Route::get('/surat_arsip', [ArsipController::class, 'arsip'])->middleware('userAkses:superadmin');
    // Route::get('/admin/admin', [ArsipController::class, 'admin'])->middleware('userAkses:admin');
    Route::get('/logout', [SessionController::class, 'logout']);
});


// Route::get('/dashboard', function () {
//     return view('partials/sidebar'); 
// });

Route::middleware(['auth', 'userAkses:superadmin'])->group(function () {
    Route::get('/surat_arsip/search', 'ArsipController@searchArsip');
    Route::post('/arsip/store', 'ArsipController@store');
    Route::get('/arsip/hapus/{id}', 'ArsipController@hapus');
    Route::get('/surat_arsip/edit/{id}', 'ArsipController@edit');
    Route::post('/arsip/update', 'ArsipController@update');
    Route::get('/pengarsipan_surat', 'ArsipController@tambah');
    // Route::get('/surat_masuk', 'ArsipController@masuk')->name('masuk');
    // Route::get('/surat_keluar', 'ArsipController@keluar')->name('keluar');
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

// Route::middleware(['auth', 'userAkses:admin'])->group(function () {
// Route::get('/surat_masuk', 'ArsipController@masuk')->name('masuk');
// Route::get('/surat_keluar','ArsipController@keluar')->name('keluar');
// });

Route::get('/pembuatan_surat_ijin', [TemplateSuratController::class, 'ijin'])->middleware('userAkses:superadmin');
Route::get('/pembuatan_surat_pengantar', [TemplateSuratController::class, 'pengantar'])->middleware('userAkses:superadmin');
Route::get('/pembuatan_surat_perintah', [TemplateSuratController::class, 'perintah'])->middleware('userAkses:superadmin');
Route::get('/pembuatan_surat_pernyataan', [TemplateSuratController::class, 'pernyataan'])->middleware('userAkses:superadmin');


Route::get('/surat_masuk', [ArsipController::class, 'masuk'])->middleware('userAkses:superadmin,admin')->name('masuk');
Route::get('/surat_masuk/tambah', [ArsipController::class, 'masukTambah'])->middleware('userAkses:superadmin');
Route::post('/surat_masuk/store', [ArsipController::class, 'masukStore'])->middleware('userAkses:superadmin');
Route::get('/surat_masuk/edit/{id}', [ArsipController::class, 'masukEdit'])->middleware('userAkses:superadmin');
Route::post('/surat_masuk/update', [ArsipController::class, 'masukUpdate'])->middleware('userAkses:superadmin');
Route::get('/surat_masuk/hapus/{id}', [ArsipController::class, 'masukHapus'])->middleware('userAkses:superadmin');


Route::get('/surat_keluar', [ArsipController::class, 'keluar'])->middleware('userAkses:superadmin,admin')->name('keluar');
Route::get('/surat_keluar/edit/{id}', [ArsipController::class, 'keluarEdit'])->middleware('userAkses:superadmin');
Route::post('/surat_keluar/store', [ArsipController::class, 'keluarStore'])->middleware('userAkses:superadmin');
Route::post('/surat_keluar/update', [ArsipController::class, 'keluarUpdate'])->middleware('userAkses:superadmin');
Route::get('/surat_keluar/hapus/{id}', [ArsipController::class, 'keluarHapus'])->middleware('userAkses:superadmin');




Route::get('/profile', [TemplateSuratController::class, 'profile'])->middleware('userAkses:superadmin,admin');
Route::get('/settings', [TemplateSuratController::class, 'settings'])->middleware('userAkses:superadmin');


// Route::get('/surat_masuk/search', 'ArsipController@searchSuratMasuk');
// Route::get('/surat_masuk/search', 'ArsipController@searchSuratMasuk');
// Route::get('/surat_keluar/search', 'ArsipController@searchSuratKeluar');

Route::get('/preview/{pdf}', 'ArsipController@preview')->name('preview');




// // Soft Deletes Wali Kelas
// Route::get('/walas/trash', 'WalasController@trash');
// Route::get('/walas/kembalikan/{id}', 'WalasController@kembalikan');
// Route::get('/walas/kembalikan_semua', 'WalasController@kembalikan_semua');
// Route::get('/walas/hapus_permanen/{id}', 'WalasController@hapus_permanen');
// Route::get('/walas/hapus_permanen_semua', 'WalasController@hapus_permanen_semua');