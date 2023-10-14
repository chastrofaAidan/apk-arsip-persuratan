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
    return view('welcome');
});


Route::get('/arsip','ArsipController@index');


Route::get('/preview/{pdf}', 'ArsipController@preview')->name('preview');
// Route::get('/walas/tambah','WalasController@tambah');
// Route::post('/walas/store','WalasController@store');
// Route::get('/walas/edit/{id}','WalasController@edit');
// Route::post('/walas/update','WalasController@update');
// Route::get('/walas/hapus/{id}','WalasController@hapus');
// // Soft Deletes Wali Kelas
// Route::get('/walas/trash', 'WalasController@trash');
// Route::get('/walas/kembalikan/{id}', 'WalasController@kembalikan');
// Route::get('/walas/kembalikan_semua', 'WalasController@kembalikan_semua');
// Route::get('/walas/hapus_permanen/{id}', 'WalasController@hapus_permanen');
// Route::get('/walas/hapus_permanen_semua', 'WalasController@hapus_permanen_semua');
