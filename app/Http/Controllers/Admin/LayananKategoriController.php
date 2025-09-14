<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\IconHelper;
use App\Http\Controllers\Controller;
use App\Models\LayananKategori;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class LayananKategoriController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('layanankategori.view');

        $layanankategoris = LayananKategori::latest()->paginate(10);

        return view('admin.layanankategoris.index', compact('layanankategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('layanankategoris.create');
        $icons = IconHelper::getIcons();
        return view('admin.layanankategoris.create', compact('icons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Otorisasi: Pastikan user punya izin 'provinsi.create'
        $this->authorize('layanankategoris.create');

        // Validasi input dari form
        $validated = $request->validate([
            'namalayanankategori' => 'required|string|max:255|unique:layanan_kategori,namalayanankategori',
        ], [
            'namalayanankategori.required' => 'Nama Kategori Layanan tidak boleh kosong.',
            'namalayanankategori.unique' => 'Nama Kategori Layanan sudah digunakan.',
        ]);

        $validated['id'] = (string) Str::uuid();
        $validated['statusenabled'] = 1;

        // Simpan data baru ke database
        LayananKategori::create($validated);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('layanankategoris.index')->with('success', 'Kategori Layanan baru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Ambil data provinsi berdasarkan ID
        $layanankategoris = LayananKategori::findOrFail($id);

        // Kirim ke view untuk menampilkan detail
        return view('admin.layanankategoris.show', compact('layanankategoris'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LayananKategori $layanankategori)
    {
        // Otorisasi: Pastikan user punya izin 'provinsi.edit'
        $this->authorize('layanankategoris.edit');

        // Kirim data provinsi yang ingin diubah ke view
        return view('admin.layanankategoris.edit', compact('layanankategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LayananKategori $layanankategori)
    {
        // Otorisasi: Pastikan user punya izin 'layanankategoris.edit'
        $this->authorize('layanankategoris.edit');

        // Validasi input dari form
        $validated = $request->validate([
            'namalayanankategori' => [
                'required',
                'string',
                'max:255',
                Rule::unique('layanan_kategori', 'namalayanankategori')->ignore($layanankategori->id, 'id')
            ],
        ], [
            'namalayanankategori.required' => 'Nama Kategori Layanan tidak boleh kosong.',
            'namalayanankategori.unique' => 'Nama Kategori Layanan sudah terdaftar.',
        ]);

        // Update data ke database
        $layanankategori->update($validated);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('layanankategoris.index')->with('success', 'Kategori Layanan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LayananKategori $layanankategori)
    {
        // Otorisasi
        $this->authorize('layanankategoris.delete');

        // Soft delete manual: update statusenabled = 0
        $layanankategori->update(['statusenabled' => 0]);

        return redirect()->route('layanankategoris.index')
            ->with('success', 'Kategori Layanan berhasil dinonaktifkan.');
    }
}
