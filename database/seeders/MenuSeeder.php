<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Role;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil role yang sudah kita buat
        $adminRole = Role::where('slug', 'admin')->first();
        $userRole = Role::where('slug', 'user')->first();

        // 1. Buat Parent Menu Dashboard
        $dashboard = Menu::updateOrCreate([
            'name' => 'Dashboard',
            'route_name' => 'dashboard', // Sesuaikan dengan name() di web.php
            'icon' => 'bi bi-grid-fill',
            'order' => 1,
        ]);

        // 2. Buat Parent Menu Manajemen Akses
        $accessManagement = Menu::updateOrCreate([
            'name' => 'Manajemen Akses',
            'icon' => 'bi bi-shield-lock-fill',
            'order' => 2,
        ]);

        // 3. Buat Sub-menu di bawah Manajemen Akses
        $userManagement = Menu::updateOrCreate([
            'parent_id' => $accessManagement->id,
            'name' => 'Manajemen User',
            'route_name' => 'users.index', // Contoh nama route
            'order' => 1,
        ]);

        $roleManagement = Menu::updateOrCreate([
            'parent_id' => $accessManagement->id,
            'name' => 'Manajemen Role',
            'route_name' => 'roles.index', // Contoh nama route
            'order' => 2,
        ]);

        $accessManagement = Menu::updateOrCreate([
            'name' => 'Manajemen Barang',
            'icon' => 'bi bi-minecart',
            'order' => 3,
        ]);


        $roleManagement = Menu::updateOrCreate([
            'parent_id' => $accessManagement->id,
            'name' => 'Manajemen Produk',
            'route_name' => 'products.index', // Contoh nama route
            'order' => 2,
        ]);

        $roleManagement = Menu::updateOrCreate([
            'parent_id' => $accessManagement->id,
            'name' => 'Manajemen Kategori',
            'route_name' => 'categories.index', // Contoh nama route
            'order' => 2,
        ]);


        // --- Berikan Hak Akses ---

        // Admin dapat mengakses semua menu
        $adminRole->menus()->sync(Menu::all()->pluck('id'));

        // User hanya dapat mengakses Dashboard
        $userRole->menus()->sync($dashboard->id);
    }
}
