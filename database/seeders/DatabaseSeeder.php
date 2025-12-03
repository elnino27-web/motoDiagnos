<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Membuat user default (sesuai kode Anda)
        User::factory()->create([
            'name' => 'Washiatul Akmal (Admin)',
            'email' => 'admin1@motodiagnos.com',
            'password' => bcrypt('admin121'),
        ]);

        User::factory()->create([
            'name' => 'Rasul Rajab (Admin)',
            'email' => 'admin2@motodiagnos.com',
            'password' => bcrypt('admin122'),
        ]);

        User::factory()->create([
            'name' => 'Anugrah Restu (Admin)',
            'email' => 'admin3@motodiagnos.com',
            'password' => bcrypt('admin123'),
        ]);

        // 2. Memanggil ExpertSystemSeeder
        $this->call([
            ExpertSystemSeeder::class,
        ]);

    }
}