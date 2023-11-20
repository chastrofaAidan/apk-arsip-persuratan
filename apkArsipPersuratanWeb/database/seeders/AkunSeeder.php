<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'SUPER ADMIN TATA USAHA',
                'email' => 'superadmin@gmail.com',
                'role' => 'superadmin',
                'profile' => 'logo.png',
                'password' => bcrypt('123')
            ],
            [
                'name' => 'ADMIN TATA USAHA',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'profile' => 'logo.png',
                'password' => bcrypt('123')
            ],
            [
                'name' => 'USER TATA USAHA',
                'email' => 'user@gmail.com',
                'role' => 'user',
                'profile' => 'logo.png',
                'password' => bcrypt('123')
            ]
        ];
        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
