<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil semua seeder dalam urutan yang logis
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class, // <-- Tambahkan ini
            MenuSeeder::class,
            UserSeeder::class, // <-- Panggil UserSeeder yang baru
        ]);
    }
}
