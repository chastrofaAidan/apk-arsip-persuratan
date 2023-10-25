<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KodePosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('kode_pos')->insert([
            // [
            //     'kode_pos' => '.2',
            //     'keterangan_kode_pos' => 'Non Gelar / Diploma',
            // ],
            // [
            //     'kode_pos' => '895',
            //     'keterangan_kode_pos' => 'Metode',
            // ],
            // [
            //     'kode_pos' => '.1',
            //     'keterangan_kode_pos' => 'Kuliah',
            // ],
            // [
            //     'kode_pos' => '.2',
            //     'keterangan_kode_pos' => 'Ceramah, Simposium',
            // ],
            
        ]);
    }
}
