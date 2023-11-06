<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KepalaSekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kepala_sekolah')->insert([
            [
                'id_kepala_sekolah' => '01',
                'nama_kepala_sekolah' => '',
                'golongan_kepala_sekolah' => 'SEKOLAH MENENGAH KEJURUAN NEGERI 1 CIMAHI',
                'nip_kepala_sekolah' => 'logo.png',
                'tanda_tangan' => 'ttd.png',
            ],
        ]);
    }
}
