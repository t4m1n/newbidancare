<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Menu;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::latest()->paginate(10);


        return view("admin.roles.index", compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Otorisasi
        // $this->authorize('role.create');

        // Ambil semua menu utama (yang tidak punya parent),
        // beserta relasi sub-menu (children) dan permission-nya masing-masing.
        // Ini adalah cara yang sangat efisien (eager loading).
        $menus = Menu::whereNull('parent_id')
            ->with('children.permissions', 'permissions')
            ->orderBy('order')
            ->get();

        // Kirim data menu yang sudah terstruktur ke view
        return view('admin.roles.create', compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Otorisasi: Pastikan user punya izin
        // $this->authorize('role.create');

        // 2. Validasi data yang masuk
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'slug' => 'required|string|max:255|unique:roles,slug',
            'permissions' => 'nullable|array', // Pastikan permissions adalah array
            'permissions.*' => 'exists:permissions,id' // Pastikan setiap isinya ada di tabel permissions
        ]);

        // 3. Buat Role baru hanya dengan nama dan slug
        $role = Role::create([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
        ]);

        // 4. Lampirkan (attach/sync) permissions ke role yang baru dibuat
        // Kita cek dulu apakah ada permission yang dipilih
        if (!empty($validated['permissions'])) {
            $role->permissions()->sync($validated['permissions']);
        }

        // 5. Redirect ke halaman index dengan pesan sukses
        return redirect()->route('roles.index')->with('success', 'Role baru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        // Otorisasi
        // $this->authorize('role.edit');

        // Ambil semua menu dengan relasi permission-nya, sama seperti di method create
        $menus = Menu::whereNull('parent_id')
            ->with('children.permissions', 'permissions')
            ->orderBy('order')
            ->get();

        // Kirim data role yang akan diedit dan data menu ke view
        return view('admin.roles.edit', compact('role', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Role $role)
    {
        // Otorisasi
        // $this->authorize('role.edit');

        // Validasi, pastikan slug unik tapi abaikan untuk role saat ini
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'slug' => 'required|string|max:255|unique:roles,slug,' . $role->id,
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        // Update nama dan slug role
        $role->update([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
        ]);

        // Gunakan sync() untuk memperbarui permissions
        // Jika tidak ada permission yang dipilih, kirim array kosong
        $role->permissions()->sync($validated['permissions'] ?? []);

        return redirect()->route('roles.index')->with('success', 'Role berhasil diperbarui.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        // 1. Otorisasi
        // $this->authorize('role.delete');

        // 2. Hapus role dari database
        // Eloquent akan otomatis menghapus relasinya di tabel pivot (permission_role, menu_role, dll)
        $role->delete();

        // 3. Redirect kembali dengan pesan sukses
        return redirect()->route('roles.index')->with('success', 'Role berhasil dihapus.');
    }
}
