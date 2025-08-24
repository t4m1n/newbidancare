<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Hapus komentar di bawah untuk menjalankan seeder

        // 1. Membuat satu user spesifik untuk testing login
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            // password otomatis di-hash menjadi 'password'
        ]);

        // 2. Membuat 10 user dummy lainnya secara acak
        User::factory(10)->create();
    }
}
