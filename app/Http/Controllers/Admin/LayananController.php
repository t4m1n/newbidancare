<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\IconHelper;
use App\Http\Controllers\Controller;
use App\Models\Bidan;
use App\Models\Layanan;
use App\Models\LayananKategori;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class LayananController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('layanans.view');
        $user = Auth::user();

        if ($user->roles->first()->id === 5) {
            $bidan = Bidan::where('user_id', $user->id)->first();
            $layanans = Layanan::where('idbidan', $bidan->id)
                ->join('bidans', 'bidans.id', '=', 'layanan.idbidan')
                ->join('users', 'bidans.user_id', '=', 'users.id')
                ->select('layanan.*', 'users.name')
                ->latest()
                ->paginate(10);
            return view('admin.layanans.index', compact('layanans', 'bidan'));
        }

        $layanans = Layanan::join('bidans', 'bidans.id', '=', 'layanan.idbidan')
            ->join('users', 'bidans.user_id', '=', 'users.id')
            ->select('layanan.*', 'users.name')
            ->latest()->paginate(10);
        return view('admin.layanans.index', compact('layanans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('layanans.create');
        $user = Auth::user();
        $icons = IconHelper::getIcons();

        if ($user->roles->first()->id === 5) {
            $bidans = Bidan::join('users', 'bidans.user_id', '=', 'users.id')
                ->select('bidans.*', 'users.name')
                ->where('user_id', $user->id)
                ->where('statusenabled', 1)
                ->where('bersedia', 1)
                ->where('approv', 1)
                ->get();
        } else {
            $bidans = Bidan::join('users', 'bidans.user_id', '=', 'users.id')
                ->select('bidans.*', 'users.name')
                ->where('statusenabled', 1)
                ->where('bersedia', 1)
                ->where('approv', 1)
                ->get();
        }

        $layanankategoris = LayananKategori::where('statusenabled', 1)->get();
        return view('admin.layanans.create', compact('icons', 'layanankategoris', 'bidans'));
    }

    public function store(Request $request)
    {
        // Otorisasi: Pastikan user punya izin
        $this->authorize('layanans.create');

        // Validasi input dari form
        $validated = $request->validate([
            'idlayanankategori' => 'required|exists:layanan_kategori,id',
            'namalayanan' => 'required|string|max:255|unique:layanan,namalayanan',
            'harga' => 'required|numeric',
            'keterangan' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'idbidan' => 'required|exists:bidans,id',
        ], [
            'namalayanan.required' => 'Nama Layanan tidak boleh kosong.',
            'namalayanan.unique' => 'Nama Layanan sudah digunakan.',
            'idlayanankategori.required' => 'Kategori Layanan harus dipilih.',
            'idlayanankategori.exists' => 'Kategori Layanan tidak valid.',
            'harga.required' => 'Harga tidak boleh kosong.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'keterangan.required' => 'Keterangan tidak boleh kosong.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau svg.',
            'gambar.max' => 'Ukuran gambar maksimal 2MB.',
            'idbidan.required' => 'Bidan harus dipilih.',
            'idbidan.exists' => 'Bidan tidak valid.',
        ]);

        // Generate UUID untuk kolom id
        $validated['id'] = (string) Str::uuid();

        // Set statusenabled default ke 1 (aktif)
        $validated['statusenabled'] = 1;

        // Upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $path = $file->store('uploads/layanans', 'public'); // simpan di storage/app/public/uploads/layanans
            $validated['gambar'] = $path;
        }

        // Simpan ke database
        Layanan::create($validated);

        // Redirect dengan pesan sukses
        return redirect()->route('layanans.index')->with('success', 'Layanan baru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Ambil data provinsi berdasarkan ID
        $layanans = Layanan::findOrFail($id);

        // Kirim ke view untuk menampilkan detail
        return view('admin.layanans.show', compact('layanans'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Layanan $layanan)
    {
        // Otorisasi: Pastikan user punya izin 'provinsi.edit'
        $this->authorize('layanans.edit');
        $user = Auth::user();

        $layanankategoris = LayananKategori::where('statusenabled', 1)->get();

        if ($user->roles->first()->id === 5) {
            $bidans = Bidan::join('users', 'bidans.user_id', '=', 'users.id')
                ->select('bidans.*', 'users.name')
                ->where('user_id', $user->id)
                ->where('statusenabled', 1)
                ->where('bersedia', 1)
                ->where('approv', 1)
                ->get();
        } else {
            $bidans = Bidan::join('users', 'bidans.user_id', '=', 'users.id')
                ->select('bidans.*', 'users.name')
                ->where('statusenabled', 1)
                ->where('bersedia', 1)
                ->where('approv', 1)
                ->get();
        }

        // Kirim data provinsi yang ingin diubah ke view
        return view('admin.layanans.edit', compact('layanan', 'layanankategoris', 'bidans'));
    }

    public function update(Request $request, Layanan $layanan)
    {
        // Otorisasi: Pastikan user punya izin 'layanans.edit'
        $this->authorize('layanans.edit');

        // Validasi input dari form
        $validated = $request->validate([
            'idbidan' => ['required', 'exists:bidans,id'],
            'idlayanankategori' => ['required', 'exists:layanan_kategori,id'],
            'namalayanan' => [
                'required',
                'string',
                'max:255',
                Rule::unique('layanan', 'namalayanan')->ignore($layanan->id),
            ],
            'harga' => ['required', 'numeric', 'min:0'],
            'keterangan' => ['required', 'string'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'idbidan.required' => 'Bidan wajib dipilih.',
            'idlayanankategori.required' => 'Kategori Layanan wajib dipilih.',
            'namalayanan.required' => 'Nama Layanan tidak boleh kosong.',
            'namalayanan.unique' => 'Nama Layanan sudah terdaftar.',
            'harga.required' => 'Harga harus diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'keterangan.required' => 'Keterangan wajib diisi.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Gambar harus berformat JPG, JPEG, PNG, atau WebP.',
            'gambar.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        // Jika ada file gambar baru diunggah
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($layanan->gambar && Storage::exists('public/' . $layanan->gambar)) {
                Storage::delete('public/' . $layanan->gambar);
            }

            // Simpan gambar baru
            $path = $request->file('gambar')->store('layanan-images', 'public');
            $validated['gambar'] = $path;
        }

        // Update data layanan
        $layanan->update($validated);

        // Redirect ke index dengan pesan sukses
        return redirect()->route('layanans.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Layanan $layanan)
    {
        // Otorisasi
        $this->authorize('layanans.delete');

        // Soft delete manual: update statusenabled = 0
        $layanan->update(['statusenabled' => 0]);

        return redirect()->route('layanans.index')
            ->with('success', 'Layanan berhasil dinonaktifkan.');
    }
}
