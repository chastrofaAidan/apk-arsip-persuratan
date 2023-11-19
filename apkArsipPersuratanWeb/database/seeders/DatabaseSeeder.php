<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AkunSeeder::class);
        $this->call(KopSuratSeeder::class);
        $this->call(KodeSuratSeeder::class);
        $this->call(KepalaSekolahSeeder::class);
    }
}
