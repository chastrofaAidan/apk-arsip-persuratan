<?php

use App\Http\Controllers\ArsipController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArsipController;



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

Route::get('/', function () {
    return view('login/login');
});

// Route::get('/dashboard', function () {
//     return view('partials/sidebar');
// });


// Route::get('/arsip', 'ArsipController@index');
Route::get('/arsip/tambah', 'ArsipController@tambah');
Route::post('/arsip/store', 'ArsipController@store');
Route::get('/arsip/hapus/{id}', 'ArsipController@hapus');
Route::get('/arsip/edit/{id}', 'ArsipController@edit');
Route::post('/arsip/update', 'ArsipController@update');

Route::get('/preview/{pdf}', 'ArsipController@preview')->name('preview');

Route::get('/surat_masuk', 'ArsipController@masuk');
Route::get('/surat_keluar','ArsipController@keluar');

Route::get('/arsip/search','ArsipController@searchArsip');
Route::get('/surat_masuk/search','ArsipController@searchSuratMasuk');
Route::get('/surat_keluar/search','ArsipController@searchSuratKeluar');
// Route::get('/surat_masuk/search',[ArsipController::class,'search']);


// // Soft Deletes Wali Kelas
// Route::get('/walas/trash', 'WalasController@trash');
// Route::get('/walas/kembalikan/{id}', 'WalasController@kembalikan');
// Route::get('/walas/kembalikan_semua', 'WalasController@kembalikan_semua');
// Route::get('/walas/hapus_permanen/{id}', 'WalasController@hapus_permanen');
// Route::get('/walas/hapus_permanen_semua', 'WalasController@hapus_permanen_semua');


// Middleware Login
Route::middleware(['guest'])->group(function () {
    Route::get('/', [SessionController::class, 'index'])->name('login');
    Route::post('/', [SessionController::class, 'login']);
});
Route::get('/home', function () {
    return redirect('/dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ArsipController::class, 'index2']);
    Route::get('/arsip', [ArsipController::class, 'index'])->middleware('userAkses:superadmin');
    // Route::get('/admin/admin', [ArsipController::class, 'admin'])->middleware('userAkses:admin');
    Route::get('/logout', [SessionController::class, 'logout']);
});
