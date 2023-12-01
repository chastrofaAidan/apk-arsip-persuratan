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
    Route::get('/profile', [UserController::class, 'profile']);
    Route::get('/profile/update', [UserController::class, 'profileUpdate']);
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

    // CRUD Kode Surat 
    Route::get('/kode_surat/tambah', [TemplateSuratController::class, 'kodeSuratTambah']);
    Route::post('/kode_surat/store', [TemplateSuratController::class, 'kodeSuratStore']);
    Route::get('/kode_surat/edit/{id}', [TemplateSuratController::class, 'kodeSuratEdit']);
    Route::post('/kode_surat/update', [TemplateSuratController::class, 'kodeSuratUpdate']);
    Route::get('/kode_surat/hapus/{id}', [TemplateSuratController::class, 'kodeSuratHapus']);
    
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

    // View Pegawai
    Route::get('/pegawai', [UserController::class, 'pegawai']);
    Route::get('/pegawai/hapus/{id}', [UserController::class, 'pegawaiHapus']);
    Route::get('/pegawai/tambah', [UserController::class, 'pegawaiTambah']);
    Route::post('/pegawai/store', [UserController::class, 'pegawaiStore']);
    Route::get('/pegawai/edit/{id}', [UserController::class, 'pegawaiViewUpdate'])->name('pegawai.edit');
    Route::put('/pegawai/update/{id}', [UserController::class, 'pegawaiUpdate'])->name('pegawai.update');

    // CRUD Kop Surat
    Route::post('/kop_surat/update', [ArsipController::class, 'kopSuratUpdate']);
    
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
    Route::get('/surat_masuk/arsip/{id}', [ArsipController::class, 'masukArsip']);
    // Route::post('/surat_masuk/archive', [ArsipController::class, 'masukPengarsipan']);
    Route::get('/surat_masuk/hapus/{id}', [ArsipController::class, 'masukHapus']);

    // CRUD Surat Keluar
    Route::get('/surat_keluar/edit/{id}', [ArsipController::class, 'keluarEdit']);
    Route::post('/surat_keluar/update', [ArsipController::class, 'keluarUpdate']);
    Route::get('/surat_keluar/arsip/{id}', [ArsipController::class, 'keluarArsip']);
    // Route::post('/surat_keluar/archive', [ArsipController::class, 'keluarPengarsipan']);
    Route::get('/surat_keluar/hapus/{id}', [ArsipController::class, 'keluarHapus']);    
    
    // View Template Surat (View - Surat Keluar) (DEBUGGING ONLY)
    Route::get('/surat_ijin', [TemplateSuratController::class, 'suratIjin']);
    Route::get('/surat_pengantar', [TemplateSuratController::class, 'suratPengantar']);
    Route::get('/surat_perintah', [TemplateSuratController::class, 'suratPerintah']);
    Route::get('/surat_pernyataan', [TemplateSuratController::class, 'suratPernyataan']);

    // Pembuatan Surat (Add - Pembuatan Surat)
    Route::get('/pembuatan_surat_ijin', [TemplateSuratController::class, 'ijin']);
    Route::get('/pembuatan_surat_pengantar', [TemplateSuratController::class, 'pengantar']);
    Route::get('/pembuatan_surat_perintah', [TemplateSuratController::class, 'perintah']);
    Route::get('/pembuatan_surat_pernyataan', [TemplateSuratController::class, 'pernyataan']);

    // Penyimpanan Surat (Store - Pembuatan Surat)
    Route::post('/pembuatan_surat/store', [ArsipController::class, 'pembuatanSurat'])->name('pembuatanSuratStore');
    Route::post('/surat_ijin/download', [ArsipController::class, 'ijinStore']);
    // Route::post('/surat_pengantar/download', [ArsipController::class, 'pengantarStore']);
    // Route::post('/surat_perintah/download', [ArsipController::class, 'perintahStore']);
    // Route::post('/surat_pernyataan/download', [ArsipController::class, 'pernyataanStore']);

    // Pendataan Surat Keluar
    Route::get('/surat_keluar/tambah', [ArsipController::class, 'keluarTambah']);
    Route::get('/surat_keluar/tambah/{file}', [ArsipController::class, 'keluarTambahPembuatan']);
    Route::post('/surat_keluar/store', [ArsipController::class, 'keluarStore']);


    // CRUD Surat Arsip
    Route::get('/pengarsipan_surat', [ArsipController::class, 'tambah']);
    Route::post('/arsip/store', [ArsipController::class, 'store']);
    Route::get('/surat_arsip/edit/{id}', [ArsipController::class, 'edit']);
    Route::post('/arsip/update', [ArsipController::class, 'update']);
    Route::get('/arsip/hapus/{id}', [ArsipController::class, 'hapus']);
});

