<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SuratMasukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tanggal_surat_1 = Carbon::create(2023, 11, 4);
        $tanggal_surat_2 = Carbon::create(2023, 10, 27);
        $tanggal_surat_3 = Carbon::create(2023, 11, 19);
    
        DB::table('surat_masuk')->insert([
            [
                'no_masuk' => '001',
                'tanggal_masuk' => $tanggal_surat_1, // corrected variable name
                'kode_masuk' => '421/001/SMKN.1-Cadisdik Wil.VII',
                'pengirim' => 'Dinas Pendidikan Prov. Jabar',
                'identitas_masuk' => '279/0924 - A 29 Sep 2022',
                'pokok_masuk' => 'Perlombaan Tingkat Provinsi',
                'keterangan_masuk' => 'Arsiparis'
            ],
            [
                'no_masuk' => '002',
                'tanggal_masuk' => $tanggal_surat_2, // corrected variable name
                'kode_masuk' => '005/002/SMKN.1-Cadisdik Wil.VII',
                'pengirim' => 'Fakultas Pendidikan Ilmu Pengetahuan Sosial (UPI)',
                'identitas_masuk' => '426/1025/Disdikpora/2022',
                'pokok_masuk' => 'Permohonan Izin Karya Ilmiah',
                'keterangan_masuk' => ''
            ],
            [
                'no_masuk' => '003',
                'tanggal_masuk' => $tanggal_surat_2, // corrected variable name
                'kode_masuk' => '421/003/SMKN.1-Cadisdik Wil.VII',
                'pengirim' => 'UPI',
                'identitas_masuk' => '3372/TU 03/Cadisdik Wil IV.',
                'pokok_masuk' => 'Permohonan Permintaan Data',
                'keterangan_masuk' => ''
            ],
            [
                'no_masuk' => '004',
                'tanggal_masuk' => $tanggal_surat_2, // corrected variable name
                'kode_masuk' => '005/004/SMKN.1-Cadisdik Wil.VII',
                'pengirim' => 'Fakultas Pendidikan Ilmu Pengetahuan Sosial (UPI)',
                'identitas_masuk' => '426/1025/Disdikpora/2022',
                'pokok_masuk' => 'Permohonan Izin Mengadakan Observasi / Tugas Mata Kuliah',
                'keterangan_masuk' => ''
            ],
            [
                'no_masuk' => '005',
                'tanggal_masuk' => $tanggal_surat_2, // corrected variable name
                'kode_masuk' => '899/005/SMKN.1-Cadisdik Wil.VII',
                'pengirim' => 'Gerakan Pramuka Kuarter Cabang Kota Cimahi',
                'identitas_masuk' => '279/0924 - A 29 Sep 2022',
                'pokok_masuk' => 'Permohonan Bantuan Sarana Prasarana',
                'keterangan_masuk' => 'Arsiparis - Kepala Sekolah'
            ],
            [
                'no_masuk' => '006',
                'tanggal_masuk' => $tanggal_surat_2, // corrected variable name
                'kode_masuk' => '421/006/SMKN.1-Cadisdik Wil.VII',
                'pengirim' => 'Asy-Shifa Festival 9',
                'identitas_masuk' => '3372/TU 03/Cadisdik Wil IV.',
                'pokok_masuk' => 'Undangan',
                'keterangan_masuk' => ''
            ],
        ]);
    }
}
