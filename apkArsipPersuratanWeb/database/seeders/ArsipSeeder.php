<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ArsipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $tanggal_surat_1 = Carbon::create(2023, 8, 20);
        $tanggal_surat_2 = Carbon::create(2023, 10, 23);
        $tanggal_surat_3 = Carbon::create(2023, 11, 4);
    
        DB::table('arsip')->insert([
            [
                'kode_surat' => '001001001',
                'judul_surat' => 'Kegiatan Studi Banding Crumbs N Yums',
                'perusahaan' => 'Crumbs N Yums',
                'jenis_surat' => 'Surat keluar',
                'tanggal_surat' => $tanggal_surat_1,
                'perihal_surat' => 'Studi Banding',
                'file_surat' => 'EWOWcopy.pdf',
                'keterangan' => 'Kegiatan Studi Banding Crumbs N Yums'
            ],
            [
                'kode_surat' => '002002002',
                'judul_surat' => 'Penawaran Sponsor Produk Crumbs N Yums',
                'perusahaan' => 'Crumbs N Yums',
                'jenis_surat' => 'Surat Masuk',
                'tanggal_surat' => $tanggal_surat_2,
                'perihal_surat' => 'Penawaran Sponsor',
                'file_surat' => 'EWOW.pdf',
                'keterangan' => 'Penawaran Sponsor Produk Crumbs N Yums'
            ],
            [
                'kode_surat' => '003003003',
                'judul_surat' => 'Dispensasi Lomba Produk Crumbs N Yums',
                'perusahaan' => 'Crumbs N Yums',
                'jenis_surat' => 'Surat Keluar',
                'tanggal_surat' => $tanggal_surat_3,
                'perihal_surat' => 'Dispensasi',
                'file_surat' => 'EWOWcopy.pdf',
                'keterangan' => 'Dispensasi Lomba Produk Crumbs N Yums'
            ],
            [
                'kode_surat' => '004004004',
                'judul_surat' => 'Surat Tugas Babeh',
                'perusahaan' => 'Babeh',
                'jenis_surat' => 'Surat Masuk',
                'tanggal_surat' => $tanggal_surat_1,
                'perihal_surat' => 'Surat Tugas',
                'file_surat' => 'EWOWcopy.pdf',
                'keterangan' => 'Surat Tugas Babeh'
            ],
            [
                'kode_surat' => '005005005',
                'judul_surat' => 'Kegiatan Penyuluhan Produk Babeh',
                'perusahaan' => 'Babeh',
                'jenis_surat' => 'Surat Keluar',
                'tanggal_surat' => $tanggal_surat_2,
                'perihal_surat' => 'Kegiatan Penyuluhan',
                'file_surat' => 'EWOW.pdf',
                'keterangan' => 'Kegiatan Penyuluhan Produk Babeh'
            ],
            [
                'kode_surat' => '006006006',
                'judul_surat' => 'Penawaran Lapangan Kerja Produk Babeh',
                'perusahaan' => 'Babeh',
                'jenis_surat' => 'Surat Masuk',
                'tanggal_surat' => $tanggal_surat_3,
                'perihal_surat' => 'Perusahaan PKL',
                'file_surat' => 'EWOW.pdf',
                'keterangan' => 'Penawaran Lapangan Kerja Produk Babeh'
            ],
        ]);
    }
}
