<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KopSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kop_surat')->insert([
            [
                'id_kop_surat' => '01',
                'kode_surat' => 'SMKN.1-Cadisdik Wil.VII',
                'nama_instansi' => 'SEKOLAH MENENGAH KEJURUAN NEGERI 1 CIMAHI',
                'logo_instansi' => 'kop_surat.png',
                'alamat_instansi' => 'Jalan Mahar Martanegara no, 48 Leuwigajah',
                'kontak_instansi' => '(002) 6629683',
                'website_instansi' => 'http://www.smkn1-cmi.sch.id',
                'email_instansi' => 'info@smkn1-cmi.sch.id',
                'kode_pos' => 'Kota Cimahi - 40533',
                'lingkup_wilayah' => 'CABANG DINAS PENDIDIKAN WILAYAH VII'
            ],
        ]);
    }
}
