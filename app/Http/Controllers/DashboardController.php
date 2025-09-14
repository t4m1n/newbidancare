<?php

namespace App\Http\Controllers;

use App\Models\Bidan;
use App\Models\Kabupaten;
use App\Models\Pasien;
use App\Models\Provinsi;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $user = Auth::user();
        $bidan = $user->bidan; // Mengakses relasi bidan dari user yang sedang login
        $pasien = $user->pasien; // Mengakses relasi pasien dari user yang sedang login
        $provinsis = Provinsi::all();
        $kabupatens = Kabupaten::all();

        $countPengajuan = Bidan::where('approv', 0)->count();
        $countTerdaftar = Bidan::where('approv', 1)->count();
        $countPasien = Pasien::count();

        $countBidanTerdekat = Pasien::join('bidans', 'pasiens.idkabupaten', '=', 'bidans.idkabupaten')
            ->where('pasiens.user_id', $user->id)
            ->groupBy('pasiens.idkabupaten')
            ->count();

        return view(
            'dashboard',
            compact(
                'user',
                'bidan',
                'pasien',
                'provinsis',
                'kabupatens',
                'countPengajuan',
                'countTerdaftar',
                'countPasien',
                'countBidanTerdekat'
            )
        );
    }

    public function getKabupatensByProvinsi(Request $request)
    {
        // Ambil kabupaten berdasarkan idprovinsi
        $kabupatens = Kabupaten::where('idprovinsi', $request->idprovinsi)->get();

        // Mengembalikan data kabupaten dalam bentuk JSON
        return response()->json($kabupatens);
    }

    public function storeOrUpdate(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'user_id' => 'required',
            'idprovinsi' => 'required',
            'idkabupaten' => 'required',
            'alamat' => 'required|string',
            // 'nohp' => ['required', 'regex:/^\+62\d{10,15}$/'], // Validasi nomor WhatsApp
            'nohp' => 'required', // Validasi nomor WhatsApp
            'bersedia' => 'nullable|in:0,1', // Validasi nilai 0 atau 1 untuk bersedia
            'str' => 'required|string',
            'longitude' => 'required|string',
            'latitude' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        // Tentukan ID bidan (jika ada, kita update berdasarkan id tersebut, jika tidak, kita buat baru)
        $bidanId = $request->id ?? (string) Str::uuid(); // Misalnya Anda mengirimkan id di form jika ingin melakukan update

        // Jika ada id, maka update, jika tidak ada maka create
        $bidan = Bidan::updateOrCreate(
            ['id' => $bidanId], // Mencari berdasarkan id jika ada
            [
                'statusenabled' => 1,
                'user_id' => $request->user_id,
                'idprovinsi' => $request->idprovinsi,
                'idkabupaten' => $request->idkabupaten,
                'alamat' => $request->alamat,
                'nohp' => $request->nohp,
                'keterangan' => $request->keterangan,
                'str' => $request->str,
                'bersedia' => $request->bersedia ? 1 : 0,
                'longitude' => $request->longitude,
                'latitude' => $request->latitude,
                'approv' => 0,
            ]
        );

        // Redirect atau respons lainnya setelah berhasil menyimpan atau memperbarui data
        return redirect()->route('dashboard')->with('success', 'Data Bidan berhasil disimpan/diupdate');
    }

    public function storeOrUpdatePasien(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'user_id' => 'required',
            'idprovinsi' => 'required',
            'idkabupaten' => 'required',
            'alamat' => 'required|string',
            'nohp' => 'required', // Validasi nomor WhatsApp
            'tgllhr' => 'required|date',
            'keterangan' => 'nullable|string',
            'longitude' => 'required|string',
            'latitude' => 'required|string'
        ]);

        // Tentukan ID bidan (jika ada, kita update berdasarkan id tersebut, jika tidak, kita buat baru)
        $pasienId = $request->id ?? (string) Str::uuid(); // Misalnya Anda mengirimkan id di form jika ingin melakukan update

        // Jika ada id, maka update, jika tidak ada maka create
        $bidan = Pasien::updateOrCreate(
            ['id' => $pasienId], // Mencari berdasarkan id jika ada
            [
                'statusenabled' => 1,
                'user_id' => $request->user_id,
                'idprovinsi' => $request->idprovinsi,
                'idkabupaten' => $request->idkabupaten,
                'alamat' => $request->alamat,
                'nohp' => $request->nohp,
                'keterangan' => $request->keterangan,
                'tgllhr' => $request->tgllhr,
                'longitude' => $request->longitude,
                'latitude' => $request->latitude,
            ]
        );

        // Redirect atau respons lainnya setelah berhasil menyimpan atau memperbarui data
        return redirect()->route('dashboard')->with('success', 'Data Pasien berhasil disimpan/diupdate');
    }
}
