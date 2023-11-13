<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KodePosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('kode_pos')->insert([
            [
                'kode_pos' => '895',
                'keterangan_kode_pos' => 'Metode',
            ],

            [
                'kode_pos' => '896',
                'keterangan_kode_pos' => 'Tenaga Pengajar / Widyaiswara / Narasumber',
            ],
            [
                'kode_pos' => '897',
                'keterangan_kode_pos' => 'Administrasi Pendidikan',
            ],
            [
                'kode_pos' => '898',
                'keterangan_kode_pos' => 'Fasilitas Belajar',
            ],
            [
                'kode_pos' => '899',
                'keterangan_kode_pos' => 'Sarana',
            ],
            [
                'kode_pos' => '900',
                'keterangan_kode_pos' => 'Keuangan',
            ],
            [
                'kode_pos' => '901',
                'keterangan_kode_pos' => 'Nota Keuangan',
            ],
            [
                'kode_pos' => '902',
                'keterangan_kode_pos' => 'APBN',
            ],
            [
                'kode_pos' => '903',
                'keterangan_kode_pos' => 'APBD',
            ],
            [
                'kode_pos' => '904',
                'keterangan_kode_pos' => 'APBN-P',
            ],
            [
                'kode_pos' => '905',
                'keterangan_kode_pos' => 'Dana Alokasi Umum',
            ],
            [
                'kode_pos' => '906',
                'keterangan_kode_pos' => 'Dana Alokasi Khusus',
            ],
            [
                'kode_pos' => '907',
                'keterangan_kode_pos' => 'Dekonsentrasi',
            ],
            [
                'kode_pos' => '910',
                'keterangan_kode_pos' => 'Anggaran',
            ],
            [
                'kode_pos' => '911',
                'keterangan_kode_pos' => 'Anggaran Rutin',
            ],
            [
                'kode_pos' => '912',
                'keterangan_kode_pos' => 'Anggaran Pembangunan',
            ],
            [
                'kode_pos' => '913',
                'keterangan_kode_pos' => 'Anggaran Belanja Tambahan',
            ],
            [
                'kode_pos' => '914',
                'keterangan_kode_pos' => 'Daftar Isian Kegiatan (DIK)',
            ],
            [
                'kode_pos' => '915',
                'keterangan_kode_pos' => 'Daftar Isian Proyek (DIP)',
            ],
            [
                'kode_pos' => '916',
                'keterangan_kode_pos' => 'Revisi Anggaran',
            ],
            [
                'kode_pos' => '421',
                'keterangan_kode_pos' => 'Sekolah',
            ],
            [
                'kode_pos' => '422',
                'keterangan_kode_pos' => 'Administrasi Sekolah',
            ],
            [
                'kode_pos' => '423',
                'keterangan_kode_pos' => 'Metode Belajar',
            ],
            [
                'kode_pos' => '424',
                'keterangan_kode_pos' => 'Tenaga Pengajar',
            ],
            [
                'kode_pos' => '425',
                'keterangan_kode_pos' => 'Sarana Pendidikan',
            ],
            [
                'kode_pos' => '426',
                'keterangan_kode_pos' => 'Keolahragaan',
            ],
            [
                'kode_pos' => '797',
                'keterangan_kode_pos' => 'Bidang Pendapatan',
            ],
            [
                'kode_pos' => '799',
                'keterangan_kode_pos' => 'Bidang Bendaharaan',
            ],
            [
                'kode_pos' => '800',
                'keterangan_kode_pos' => 'Kepegawaian',
            ],
            [
                'kode_pos' => '810',
                'keterangan_kode_pos' => 'Pengadaan',
            ],
            [
                'kode_pos' => '811',
                'keterangan_kode_pos' => 'Lamaran',
            ],
            [
                'kode_pos' => '812',
                'keterangan_kode_pos' => 'Pengujian Kesehatan',
            ],
            [
                'kode_pos' => '813',
                'keterangan_kode_pos' => 'Pengangkatan Calon Pegawai',
            ],
            [
                'kode_pos' => '814',
                'keterangan_kode_pos' => 'Pengangkatan Tenaga Lepas',
            ],
            [
                'kode_pos' => '820',
                'keterangan_kode_pos' => 'Mutasi',
            ],
            [
                'kode_pos' => '821',
                'keterangan_kode_pos' => 'Pengangkatan',
            ],
            [
                'kode_pos' => '005',
                'keterangan_kode_pos' => 'Undangan',
            ],
        ]);
    }
}
