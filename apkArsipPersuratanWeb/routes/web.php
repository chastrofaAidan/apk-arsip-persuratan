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

Route::get('/walas','WalasController@index');
Route::get('/walas/tambah','WalasController@tambah');
Route::post('/walas/store','WalasController@store');
Route::get('/walas/edit/{id}','WalasController@edit');
Route::post('/walas/update','WalasController@update');
Route::get('/walas/hapus/{id}','WalasController@hapus');
