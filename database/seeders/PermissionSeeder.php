<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil menu yang relevan terlebih dahulu
        // Kita asumsikan MenuSeeder sudah berjalan sebelumnya
        $categoryMenu = Menu::where('route_name', 'categories.index')->first();
        $productMenu = Menu::where('route_name', 'products.index')->first();

        // Daftar izin yang dikelompokkan berdasarkan menu
        $permissions = [
            // Permissions untuk Kategori
            'category.view' => ['name' => 'Lihat Kategori', 'menu_id' => $categoryMenu->id ?? null],
            'category.create' => ['name' => 'Tambah Kategori', 'menu_id' => $categoryMenu->id ?? null],
            'category.edit' => ['name' => 'Edit Kategori', 'menu_id' => $categoryMenu->id ?? null],
            'category.delete' => ['name' => 'Hapus Kategori', 'menu_id' => $categoryMenu->id ?? null],
            // Permissions untuk Produk
            'product.view' => ['name' => 'Lihat Produk', 'menu_id' => $productMenu->id ?? null],
            'product.create' => ['name' => 'Tambah Produk', 'menu_id' => $productMenu->id ?? null],
            'product.edit' => ['name' => 'Edit Produk', 'menu_id' => $productMenu->id ?? null],
            'product.delete' => ['name' => 'Hapus Produk', 'menu_id' => $productMenu->id ?? null],
        ];

        // Buat permissions
        foreach ($permissions as $slug => $details) {
            Permission::updateOrCreate(
                ['slug' => $slug],
                ['name' => $details['name'], 'menu_id' => $details['menu_id']]
            );
        }

        // Berikan semua izin ke role Admin
        $adminRole = Role::where('slug', 'admin')->first();
        if ($adminRole) {
            $allPermissions = Permission::pluck('id');
            $adminRole->permissions()->sync($allPermissions);
        }
    }
}
