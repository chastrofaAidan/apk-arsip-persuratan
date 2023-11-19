<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KodeSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('kode_surat')->insert([
            [
                'kode_surat' => '895',
                'keterangan_kode_surat' => 'Metode',
            ],

            [
                'kode_surat' => '896',
                'keterangan_kode_surat' => 'Tenaga Pengajar / Widyaiswara / Narasumber',
            ],
            [
                'kode_surat' => '897',
                'keterangan_kode_surat' => 'Administrasi Pendidikan',
            ],
            [
                'kode_surat' => '898',
                'keterangan_kode_surat' => 'Fasilitas Belajar',
            ],
            [
                'kode_surat' => '899',
                'keterangan_kode_surat' => 'Sarana',
            ],
            [
                'kode_surat' => '900',
                'keterangan_kode_surat' => 'Keuangan',
            ],
            [
                'kode_surat' => '901',
                'keterangan_kode_surat' => 'Nota Keuangan',
            ],
            [
                'kode_surat' => '902',
                'keterangan_kode_surat' => 'APBN',
            ],
            [
                'kode_surat' => '903',
                'keterangan_kode_surat' => 'APBD',
            ],
            [
                'kode_surat' => '904',
                'keterangan_kode_surat' => 'APBN-P',
            ],
            [
                'kode_surat' => '905',
                'keterangan_kode_surat' => 'Dana Alokasi Umum',
            ],
            [
                'kode_surat' => '906',
                'keterangan_kode_surat' => 'Dana Alokasi Khusus',
            ],
            [
                'kode_surat' => '907',
                'keterangan_kode_surat' => 'Dekonsentrasi',
            ],
            [
                'kode_surat' => '910',
                'keterangan_kode_surat' => 'Anggaran',
            ],
            [
                'kode_surat' => '911',
                'keterangan_kode_surat' => 'Anggaran Rutin',
            ],
            [
                'kode_surat' => '912',
                'keterangan_kode_surat' => 'Anggaran Pembangunan',
            ],
            [
                'kode_surat' => '913',
                'keterangan_kode_surat' => 'Anggaran Belanja Tambahan',
            ],
            [
                'kode_surat' => '914',
                'keterangan_kode_surat' => 'Daftar Isian Kegiatan (DIK)',
            ],
            [
                'kode_surat' => '915',
                'keterangan_kode_surat' => 'Daftar Isian Proyek (DIP)',
            ],
            [
                'kode_surat' => '916',
                'keterangan_kode_surat' => 'Revisi Anggaran',
            ],
            [
                'kode_surat' => '421',
                'keterangan_kode_surat' => 'Sekolah',
            ],
            [
                'kode_surat' => '422',
                'keterangan_kode_surat' => 'Administrasi Sekolah',
            ],
            [
                'kode_surat' => '423',
                'keterangan_kode_surat' => 'Metode Belajar',
            ],
            [
                'kode_surat' => '424',
                'keterangan_kode_surat' => 'Tenaga Pengajar',
            ],
            [
                'kode_surat' => '425',
                'keterangan_kode_surat' => 'Sarana Pendidikan',
            ],
            [
                'kode_surat' => '426',
                'keterangan_kode_surat' => 'Keolahragaan',
            ],
            [
                'kode_surat' => '797',
                'keterangan_kode_surat' => 'Bidang Pendapatan',
            ],
            [
                'kode_surat' => '799',
                'keterangan_kode_surat' => 'Bidang Bendaharaan',
            ],
            [
                'kode_surat' => '800',
                'keterangan_kode_surat' => 'Kepegawaian',
            ],
            [
                'kode_surat' => '810',
                'keterangan_kode_surat' => 'Pengadaan',
            ],
            [
                'kode_surat' => '811',
                'keterangan_kode_surat' => 'Lamaran',
            ],
            [
                'kode_surat' => '812',
                'keterangan_kode_surat' => 'Pengujian Kesehatan',
            ],
            [
                'kode_surat' => '813',
                'keterangan_kode_surat' => 'Pengangkatan Calon Pegawai',
            ],
            [
                'kode_surat' => '814',
                'keterangan_kode_surat' => 'Pengangkatan Tenaga Lepas',
            ],
            [
                'kode_surat' => '820',
                'keterangan_kode_surat' => 'Mutasi',
            ],
            [
                'kode_surat' => '821',
                'keterangan_kode_surat' => 'Pengangkatan',
            ],
            [
                'kode_surat' => '005',
                'keterangan_kode_surat' => 'Undangan',
            ],
        ]);
    }
}
