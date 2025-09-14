<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\IconHelper;
use App\Http\Controllers\Controller;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProvinsiController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Otorisasi: Pastikan user punya izin 'provinsi.view'
        $this->authorize('provinsi.view');

        // Ambil semua data provinsi
        $provinsis = Provinsi::latest()->paginate(10);

        // Kirim data ke view
        return view('admin.provinsis.index', compact('provinsis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Otorisasi: Pastikan user punya izin 'provinsi.create'
        $this->authorize('provinsi.create');
        $icons = IconHelper::getIcons();
        // Kirim ke view untuk menampilkan form pembuatan provinsi
        return view('admin.provinsis.create', compact('icons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Otorisasi: Pastikan user punya izin 'provinsi.create'
        $this->authorize('provinsi.create');

        // Validasi input dari form
        $validated = $request->validate([
            'id' => 'required|string|max:255|unique:provinsi,id',
            'namaprovinsi' => 'required|string|max:255',
        ], [
            'id.required' => 'ID provinsi tidak boleh kosong.',
            'id.unique' => 'ID provinsi ini sudah ada.',
            'namaprovinsi.required' => 'Nama provinsi tidak boleh kosong.',
        ]);

        // Simpan data baru ke database
        Provinsi::create($validated);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('provinsis.index')->with('success', 'Provinsi baru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Ambil data provinsi berdasarkan ID
        $provinsi = Provinsi::findOrFail($id);

        // Kirim ke view untuk menampilkan detail
        return view('admin.provinsis.show', compact('provinsi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Provinsi $provinsi)
    {
        // Otorisasi: Pastikan user punya izin 'provinsi.edit'
        $this->authorize('provinsis.edit');

        // Kirim data provinsi yang ingin diubah ke view
        return view('admin.provinsis.edit', compact('provinsi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Provinsi $provinsi)
    {
        // Otorisasi: Pastikan user punya izin 'provinsi.edit'
        $this->authorize('provinsi.edit');

        // Validasi input dari form
        $validated = $request->validate([
            'namaprovinsi' => 'required|string|max:255',
        ]);

        // Update data provinsi di database
        $provinsi->update($validated);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('provinsis.index')->with('success', 'Provinsi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provinsi $provinsi)
    {
        // Otorisasi: Pastikan user punya izin 'provinsi.delete'
        $this->authorize('provinsis.delete');

        // Hapus data provinsi dari database
        $provinsi->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('provinsis.index')->with('success', 'Provinsi berhasil dihapus.');
    }
}
