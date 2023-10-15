<?php

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

Route::get('/', function () {
    return view('login/login');
});

Route::get('/side', function () {
    return view('partials/sidebar');
});


Route::get('/arsip','ArsipController@index');
Route::get('/arsip/tambah','ArsipController@tambah');
Route::post('/arsip/store','ArsipController@store');
Route::get('/arsip/hapus/{id}','ArsipController@hapus');
Route::get('/arsip/edit/{id}','ArsipController@edit');
Route::post('/arsip/update','ArsipController@update');


Route::get('/preview/{pdf}', 'ArsipController@preview')->name('preview');
// // Soft Deletes Wali Kelas
// Route::get('/walas/trash', 'WalasController@trash');
// Route::get('/walas/kembalikan/{id}', 'WalasController@kembalikan');
// Route::get('/walas/kembalikan_semua', 'WalasController@kembalikan_semua');
// Route::get('/walas/hapus_permanen/{id}', 'WalasController@hapus_permanen');
// Route::get('/walas/hapus_permanen_semua', 'WalasController@hapus_permanen_semua');
