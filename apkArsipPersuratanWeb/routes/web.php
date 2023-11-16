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


// Rute SEMUA ROLE bisa akses
Route::middleware(['auth', 'userAkses:superadmin,admin,user'])->group(function () {
    // Dashboard / Logout
    Route::get('/home', function () {
        return redirect('/dashboard');
    });
    Route::get('/dashboard', [ArsipController::class, 'index']);
    Route::get('/logout', [SessionController::class, 'logout']);

    // Profile
    Route::get('/profile', [UserController::class, 'profile'])->middleware('userAkses:admin,user');
    Route::get('/profile/update', [UserController::class, 'profileUpdate'])->middleware('userAkses:admin,user');
    Route::post('/user/update', [UserController::class, 'updateProfile']);


    // View Surat_Masuk / Surat_Keluar / Surat_Arsip
    Route::get('/surat_masuk', [ArsipController::class, 'masuk'])->name('masuk');
    Route::get('/surat_keluar', [ArsipController::class, 'keluar'])->name('keluar');
    Route::get('/surat_arsip', [ArsipController::class, 'arsip']);
    
    // Search/Pagination/Filter Surat_Masuk / Surat_Keluar / Surat_Arsip
    // Route::get('/surat_masuk/search', [ArsipController::class, 'searchMasuk']);
    // Route::get('/surat_keluar/search', [ArsipController::class, 'searchKeluar']);
    // Route::get('/surat_arsip/search', [ArsipController::class, 'searchArsip']);

    // Preview dan Download PDF
    Route::get('/preview/{pdf}', [ArsipController::class, 'preview'])->name('preview');
});




// Rute SUPER-ADMIN & ADMIN bisa akses
Route::middleware(['auth', 'userAkses:superadmin,admin'])->group(function () {
    // Settings
    Route::get('/settings', [TemplateSuratController::class, 'settings']);

    // CRUD Kode Pos 
    Route::get('/kode_pos/tambah', [TemplateSuratController::class, 'kodePosTambah']);
    Route::post('/kode_pos/store', [TemplateSuratController::class, 'kodePosStore']);
    Route::get('/kode_pos/edit/{id}', [TemplateSuratController::class, 'kodePosEdit']);
    Route::post('/kode_pos/update', [TemplateSuratController::class, 'kodePosUpdate']);
    Route::get('/kode_pos/hapus/{id}', [TemplateSuratController::class, 'kodePosHapus']);
    
});




// Rute SUPER-ADMIN bisa akses
Route::middleware(['auth', 'userAkses:superadmin'])->group(function () {

    // Registrasi (Add/Store - User)
    // Route::get('/registrasi', [UserController::class, 'registrasi']);
    // Route::post('/registrasi/store', [ArsipController::class, 'registrasiStore']);
    

    // Manage User (View/Edit/Update/Delete - User) 
    // Route::get('/manage_user/edit/{id}', [ArsipController::class, 'userEdit']);
    // Route::post('/manage_user/update', [ArsipController::class, 'userUpdate']);
    // Route::get('/manage_user/hapus/{id}', [ArsipController::class, 'userHapus']);


    // CRUD Kop Surat
    // Route::post('/kop_surat/update', [ArsipController::class, 'kopSuratUpdate']);
    

    // CRUD Kepala Sekolah
    Route::post('/kepala_sekolah/update', [ArsipController::class, 'kepalaSekolahUpdate']);
});




// Rute ADMIN bisa akses
Route::middleware(['auth', 'userAkses:admin'])->group(function () {

    // CRUD Surat Masuk
    Route::get('/surat_masuk/tambah', [ArsipController::class, 'masukTambah']);
    Route::post('/surat_masuk/store', [ArsipController::class, 'masukStore']);
    Route::get('/surat_masuk/edit/{id}', [ArsipController::class, 'masukEdit']);
    Route::post('/surat_masuk/update', [ArsipController::class, 'masukUpdate']);
    Route::get('/surat_masuk/hapus/{id}', [ArsipController::class, 'masukHapus']);

    
    // CRUD Surat Keluar
    Route::get('/surat_keluar/edit/{id}', [ArsipController::class, 'keluarEdit']);
    Route::post('/surat_keluar/update', [ArsipController::class, 'keluarUpdate']);
    Route::get('/surat_keluar/hapus/{id}', [ArsipController::class, 'keluarHapus']);    

    // View Template Surat (View - Surat Keluar) (DEBUGGING ONLY)
    Route::get('/surat_ijin', [TemplateSuratController::class, 'suratIjin']);
    Route::get('/surat_pengantar', [TemplateSuratController::class, 'suratPengantar']);
    Route::get('/surat_perintah', [TemplateSuratController::class, 'suratPerintah']);
    Route::get('/surat_pernyataan', [TemplateSuratController::class, 'suratPernyataan']);

    // Pembuatan Surat (Add - Surat Keluar)
    Route::get('/pembuatan_surat_ijin', [TemplateSuratController::class, 'ijin']);
    Route::get('/pembuatan_surat_pengantar', [TemplateSuratController::class, 'index']);
    Route::get('/pembuatan_surat_perintah', [TemplateSuratController::class, 'index']);
    Route::get('/pembuatan_surat_pernyataan', [TemplateSuratController::class, 'index']);

    // Penyimpanan Template Surat (Store - Surat Keluar)
    // Route::post('/surat_ijin/store', [ArsipController::class, 'ijinStore']);
    // Route::post('/surat_pengantar/store', [ArsipController::class, 'pengantarStore']);
    // Route::post('/surat_perintah/store', [ArsipController::class, 'perintahStore']);
    // Route::post('/surat_pernyataan/store', [ArsipController::class, 'pernyataanStore']);


    // CRUD Surat Arsip
    Route::get('/pengarsipan_surat', [ArsipController::class, 'tambah']);
    Route::post('/arsip/store', [ArsipController::class, 'store']);
    Route::get('/surat_arsip/edit/{id}', [ArsipController::class, 'edit']);
    Route::post('/arsip/update', [ArsipController::class, 'update']);
    Route::get('/arsip/hapus/{id}', [ArsipController::class, 'hapus']);


    Route::post('/kop_surat/update', [TemplateSuratController::class, 'kopSuratUpdate']);
    Route::post('/kepala_sekolah/update', [TemplateSuratController::class, 'kepalaSekolahUpdate']);

});