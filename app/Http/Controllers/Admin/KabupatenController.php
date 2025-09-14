<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kabupaten;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class KabupatenController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Otorisasi: Pastikan user punya izin 'kabupaten.view'
        $this->authorize('kabupaten.view');

        // Ambil data kabupaten dengan relasi provinsi dan urutkan berdasarkan nama provinsi
        $kabupatens = Kabupaten::join('provinsi', 'kabupaten.idprovinsi', '=', 'provinsi.id')
            ->select('kabupaten.*', 'provinsi.namaprovinsi')
            ->orderBy('provinsi.namaprovinsi', 'asc') // Urutkan berdasarkan nama provinsi
            ->latest() // Jika perlu urutkan berdasarkan waktu terbaru
            ->paginate(10);

        // Kirim data ke view
        return view('admin.kabupatens.index', compact('kabupatens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Otorisasi: Pastikan user punya izin 'kabupaten.create'
        $this->authorize('kabupatens.create');

        // Ambil semua provinsi untuk dropdown
        $provinsis = Provinsi::all();

        // Kirim ke view untuk menampilkan form pembuatan kabupaten
        return view('admin.kabupatens.create', compact('provinsis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Otorisasi: Pastikan user punya izin 'kabupaten.create'
        $this->authorize('kabupatens.create');

        // Validasi input dari form
        $validated = $request->validate([
            'id' => 'required|string|max:255|unique:kabupaten,id',
            'idprovinsi' => 'required|exists:provinsi,id', // Validasi bahwa idprovinsi ada di tabel provinsi
            'namakabupaten' => 'required|string|max:255',
        ], [
            'id.required' => 'ID kabupaten tidak boleh kosong.',
            'id.unique' => 'ID kabupaten ini sudah ada.',
            'namakabupaten.required' => 'Nama kabupaten tidak boleh kosong.',
            'idprovinsi.required' => 'Provinsi harus dipilih.',
            'idprovinsi.exists' => 'Provinsi yang dipilih tidak valid.',
        ]);

        // Simpan data baru ke database
        Kabupaten::create($validated);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kabupatens.index')->with('success', 'Kabupaten baru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Ambil data kabupaten berdasarkan ID
        $kabupaten = Kabupaten::with('provinsi')->findOrFail($id);

        // Kirim ke view untuk menampilkan detail
        return view('admin.kabupatens.show', compact('kabupaten'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kabupaten $kabupaten)
    {
        // Otorisasi: Pastikan user punya izin 'kabupaten.edit'
        $this->authorize('kabupatens.edit');

        // Ambil semua provinsi untuk dropdown
        $provinsis = Provinsi::all();

        // Kirim data kabupaten yang ingin diubah dan provinsi ke view
        return view('admin.kabupatens.edit', compact('kabupaten', 'provinsis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kabupaten $kabupaten)
    {
        // Otorisasi: Pastikan user punya izin 'kabupaten.edit'
        $this->authorize('kabupatens.edit');

        // Validasi input dari form
        $validated = $request->validate([
            'namakabupaten' => 'required|string|max:255',
            'idprovinsi' => 'required|exists:provinsi,id',
        ]);

        // Update data kabupaten di database
        $kabupaten->update($validated);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kabupatens.index')->with('success', 'Kabupaten berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kabupaten $kabupaten)
    {
        // Otorisasi: Pastikan user punya izin 'kabupaten.delete'
        $this->authorize('kabupatens.delete');

        // Hapus data kabupaten dari database
        $kabupaten->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kabupatens.index')->with('success', 'Kabupaten berhasil dihapus.');
    }
}
