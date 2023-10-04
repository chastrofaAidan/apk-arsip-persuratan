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

        $tanggal_surat = Carbon::create(2023, 8, 20);
    
        DB::table('arsip')->insert([
            [
                'kode_surat' => '001001001',
                'judul_surat' => 'Penawaran Sponsor Produk Crumbs N Yums ',
                'perusahaan' => 'Crumbs N Yums',
                'jenis_surat' => 'Surat Masuk',
                'tanggal_surat' => $tanggal_surat,
                'perihal_surat' => 'Penawaran Sponsor',
                'file_surat' => 'Ewow.pdf',
                'keterangan' => 'Penawaran Sponsor untuk Kegiatan Sumpah Pemuda tanggal 28 Oktober'
            ],
            [
                'kode_surat' => '001001001',
                'judul_surat' => 'Penawaran Sponsor Produk Crumbs N Yums ',
                'perusahaan' => 'Crumbs N Yums',
                'jenis_surat' => 'Surat Masuk',
                'tanggal_surat' => $tanggal_surat,
                'perihal_surat' => 'Penawaran Sponsor',
                'file_surat' => 'Ewow.pdf',
                'keterangan' => 'Penawaran Sponsor untuk Kegiatan Sumpah Pemuda tanggal 28 Oktober'
            ],
        ]);
    }
}
