<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SuratKeluarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tanggal_surat_1 = Carbon::create(2023, 11, 4);
        $tanggal_surat_2 = Carbon::create(2023, 10, 27);
        $tanggal_surat_3 = Carbon::create(2023, 11, 19);

        DB::table('surat_keluar')->insert([
            [
                'no_keluar' => '001',
                'tanggal_keluar' => $tanggal_surat_1, // corrected variable name
                'kode_keluar' => '800/001/SMKN.1-Cadisdik Wil.VII',
                'ditujukan' => 'Guru Matematika',
                'perihal_keluar' => 'Lomba Cerdas Cermat Matematika',
                'surat_keluar' => 'EWOWcopy.pdf',
                'keterangan_keluar' => 'Arsiparis'
            ],
            [
                'no_keluar' => '002',
                'tanggal_keluar' => $tanggal_surat_2, // corrected variable name
                'kode_keluar' => '800/002/SMKN.1-Cadisdik Wil.VII',
                'ditujukan' => 'Guru Bahasa Indonesia',
                'perihal_keluar' => 'Lomba Cerdas Cermat Bahasa Indonesia',
                'surat_keluar' => 'EWOW.pdf',
                'keterangan_keluar' => ''
            ],
            [
                'no_keluar' => '003',
                'tanggal_keluar' => $tanggal_surat_1, // corrected variable name
                'kode_keluar' => '800/003/SMKN.1-Cadisdik Wil.VII',
                'ditujukan' => 'Guru Jepang',
                'perihal_keluar' => 'Seminar Jepang',
                'surat_keluar' => 'EWOWcopy.pdf',
                'keterangan_keluar' => ''
            ],
            [
                'no_keluar' => '004',
                'tanggal_keluar' => $tanggal_surat_3, // corrected variable name
                'kode_keluar' => '800/004/SMKN.1-Cadisdik Wil.VII',
                'ditujukan' => 'Guru Jurusan',
                'perihal_keluar' => 'Seminar SLDC',
                'surat_keluar' => 'EWOW.pdf',
                'keterangan_keluar' => ''
            ],
            [
                'no_keluar' => '005',
                'tanggal_keluar' => $tanggal_surat_3, // corrected variable name
                'kode_keluar' => '800/005/SMKN.1-Cadisdik Wil.VII',
                'ditujukan' => 'Guru Bahasa Inggris',
                'perihal_keluar' => 'Lomba StoryTelling Inggris',
                'surat_keluar' => 'EWOWcopy.pdf',
                'keterangan_keluar' => 'Arsiparis'
            ],
            [
                'no_keluar' => '007',
                'tanggal_keluar' => $tanggal_surat_2, // corrected variable name
                'kode_keluar' => '800/006/SMKN.1-Cadisdik Wil.VII',
                'ditujukan' => 'Guru PKWU',
                'perihal_keluar' => 'Job Fair',
                'surat_keluar' => 'EWOWcopy.pdf',
                'keterangan_keluar' => 'Arsiparis'
            ],
            [
                'no_keluar' => '008',
                'tanggal_keluar' => $tanggal_surat_2, // corrected variable name
                'kode_keluar' => '800/006/SMKN.1-Cadisdik Wil.VII',
                'ditujukan' => 'Guru PKWU',
                'perihal_keluar' => 'Job Fair',
                'surat_keluar' => 'EWOWcopy.pdf',
                'keterangan_keluar' => 'Arsiparis'
            ],
            [
                'no_keluar' => '010',
                'tanggal_keluar' => $tanggal_surat_2, // corrected variable name
                'kode_keluar' => '800/006/SMKN.1-Cadisdik Wil.VII',
                'ditujukan' => 'Guru PKWU',
                'perihal_keluar' => 'Job Fair',
                'surat_keluar' => 'EWOWcopy.pdf',
                'keterangan_keluar' => 'Arsiparis'
            ],
            [
                'no_keluar' => '011',
                'tanggal_keluar' => $tanggal_surat_2, // corrected variable name
                'kode_keluar' => '800/006/SMKN.1-Cadisdik Wil.VII',
                'ditujukan' => 'Guru PKWU',
                'perihal_keluar' => 'Job Fair',
                'surat_keluar' => 'EWOWcopy.pdf',
                'keterangan_keluar' => 'Arsiparis'
            ],
            [
                'no_keluar' => '012',
                'tanggal_keluar' => $tanggal_surat_2, // corrected variable name
                'kode_keluar' => '800/006/SMKN.1-Cadisdik Wil.VII',
                'ditujukan' => 'Guru PKWU',
                'perihal_keluar' => 'Job Fair',
                'surat_keluar' => 'EWOWcopy.pdf',
                'keterangan_keluar' => 'Arsiparis'
            ],
            [
                'no_keluar' => '013',
                'tanggal_keluar' => $tanggal_surat_2, // corrected variable name
                'kode_keluar' => '800/006/SMKN.1-Cadisdik Wil.VII',
                'ditujukan' => 'Guru PKWU',
                'perihal_keluar' => 'Job Fair',
                'surat_keluar' => 'EWOWcopy.pdf',
                'keterangan_keluar' => 'Arsiparis'
            ],
            [
                'no_keluar' => '014',
                'tanggal_keluar' => $tanggal_surat_2, // corrected variable name
                'kode_keluar' => '800/006/SMKN.1-Cadisdik Wil.VII',
                'ditujukan' => 'Guru PKWU',
                'perihal_keluar' => 'Job Fair',
                'surat_keluar' => 'EWOWcopy.pdf',
                'keterangan_keluar' => 'Arsiparis'
            ],
            [
                'no_keluar' => '015',
                'tanggal_keluar' => $tanggal_surat_2, // corrected variable name
                'kode_keluar' => '800/006/SMKN.1-Cadisdik Wil.VII',
                'ditujukan' => 'Guru PKWU',
                'perihal_keluar' => 'Job Fair',
                'surat_keluar' => 'EWOWcopy.pdf',
                'keterangan_keluar' => 'Arsiparis'
            ],

        ]);
    }
}
