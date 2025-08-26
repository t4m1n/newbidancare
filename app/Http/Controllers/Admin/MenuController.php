<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu; // <-- Import model Menu
use Illuminate\Http\Request;
use App\Helpers\IconHelper;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 2. Ambil semua data menu dengan relasi parent-nya untuk efisiensi
        $menus = Menu::with('parent')->latest()->paginate(5);

        // 3. Kirim data ke view
        return view('admin.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parentMenus = Menu::whereNull('route_name')->orWhere('route_name', '=', '')->get();
        // Siapkan daftar ikon untuk dikirim ke view
        $icons = IconHelper::getIcons();

        return view('admin.menu.create', compact('parentMenus', 'icons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Otorisasi: Pastikan user punya izin 'menu.create'
        // $this->authorize('menu.create');

        // 2. Validasi input dari form
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:menus,id',
            // Pastikan route_name unik jika diisi, kecuali untuk menu yang sama (berguna saat update)
            'route_name' => 'nullable|string|max:255|unique:menus,route_name',
            'icon' => 'nullable|string|max:255',
            'order' => 'required|integer',
        ], [
            // Pesan error kustom (opsional, tapi bagus)
            'name.required' => 'Nama menu tidak boleh kosong.',
            'route_name.unique' => 'Route name ini sudah digunakan menu lain.',
            'order.required' => 'Urutan tampil tidak boleh kosong.',
        ]);

        // 3. Simpan data baru ke database
        Menu::create($validated);

        // 4. Redirect kembali ke halaman index dengan pesan sukses (flash message)
        return redirect()->route('menus.index')->with('success', 'Menu baru berhasil ditambahkan.');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function getBootstrapIcons()
    {
        // Ini hanya sebagian kecil contoh, daftar lengkapnya sangat panjang.
        // Anda bisa menambahkannya sesuai kebutuhan.
        return [
            'bi bi-app',
            'bi bi-grid-fill',
            'bi bi-shield-shaded',
            'bi bi-box-seam-fill',
            'bi bi-person-fill',
            'bi bi-people-fill',
            'bi bi-gear-fill',
            'bi bi-card-list',
            'bi bi-table',
            'bi bi-bar-chart-fill',
            'bi bi-pie-chart-fill',
            'bi bi-file-earmark-text-fill',
            'bi bi-calendar-event-fill',
            'bi bi-chat-dots-fill',
            'bi bi-envelope-fill',
            'bi bi-star-fill',
            'bi bi-bookmark-fill',
            'bi bi-bell-fill',
            'bi bi-house-door-fill',
            'bi bi-folder-fill',
            'bi bi-tag-fill',
            'bi bi-cart-fill',
            'bi bi-credit-card-fill',
        ];
    }
}
