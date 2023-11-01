<?php

use App\Http\Controllers\ArsipController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TemplateSuratController;
use Illuminate\Support\Facades\Route;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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
    Route::get('/arsip/search', 'ArsipController@searchArsip');
    Route::post('/arsip/store', 'ArsipController@store');
    Route::get('/arsip/hapus/{id}', 'ArsipController@hapus');
    Route::get('/arsip/edit/{id}', 'ArsipController@edit');
    Route::post('/arsip/update', 'ArsipController@update');
    Route::get('/pengarsipan_surat', 'ArsipController@tambah');
    // Route::get('/surat_masuk', 'ArsipController@masuk')->name('masuk');
    // Route::get('/surat_keluar', 'ArsipController@keluar')->name('keluar');
    Route::get('/pembuatan_surat', 'TemplateSuratController@index');
    Route::get('/settings', 'TemplateSuratController@settings');
    Route::get('/profile', 'TemplateSuratController@profile');
    Route::get('/surat_dispen', 'TemplateSuratController@suratDispen'); 
});

Route::middleware(['auth', 'userAkses:admin'])->group(function () {
    // Route::get('/surat_masuk', 'ArsipController@masuk')->name('masuk');
    // Route::get('/surat_keluar','ArsipController@keluar')->name('keluar');
});

Route::get('/surat_masuk', [ArsipController::class, 'masuk'])->middleware('userAkses:superadmin,admin')->name('masuk');
Route::get('/surat_keluar', [ArsipController::class, 'keluar'])->middleware('userAkses:superadmin,admin')->name('keluar');
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