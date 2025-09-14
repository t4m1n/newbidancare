<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidan;
use App\Models\Kabupaten;
use App\Models\Layanan;
use App\Models\Pasien;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class BidanController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        // Otorisasi: Pastikan user punya izin 'bidanpengajuan.view'
        $this->authorize('bidanpengajuan.view');

        // Ambil semua data bidanterdaftar
        $bidanpengajuans = Bidan::join('users', 'bidans.user_id', '=', 'users.id')
            ->join('provinsi', 'bidans.idprovinsi', '=', 'provinsi.id')
            ->join('kabupaten', 'bidans.idkabupaten', '=', 'kabupaten.id')
            ->select(
                'bidans.*',
                'users.name',
                'provinsi.namaprovinsi',
                'kabupaten.namakabupaten'
            )
            ->where('bidans.approv', 0)
            ->paginate(10);



        // Kirim data ke view
        return view('admin.bidanpengajuans.index', compact('bidanpengajuans'));
    }

    public function approve($id)
    {
        $bidan = Bidan::findOrFail($id);
        $bidan->approv = 1;
        $bidan->save();

        return redirect()->back()->with('success', 'Bidan berhasil disetujui.');
    }

    public function unapprove($id)
    {
        $bidan = Bidan::findOrFail($id);
        $bidan->approv = 0;
        $bidan->save();

        return redirect()->back()->with('success', 'Persetujuan bidan berhasil dibatalkan.');
    }

    public function profile($id)
    {
        $provinsis = Provinsi::all();
        $kabupatens = Kabupaten::all();

        $bidanprofile = Bidan::join('users', 'bidans.user_id', '=', 'users.id')
            ->join('provinsi', 'bidans.idprovinsi', '=', 'provinsi.id')
            ->join('kabupaten', 'bidans.idkabupaten', '=', 'kabupaten.id')
            ->select(
                'bidans.*',
                'users.name',
                'provinsi.namaprovinsi',
                'kabupaten.namakabupaten'
            )
            ->where('bidans.id', $id)
            ->where('bidans.approv', 1)
            ->first();

        $layanans = Layanan::where('idbidan', $id)
            ->join('bidans', 'bidans.id', '=', 'layanan.idbidan')
            ->join('users', 'bidans.user_id', '=', 'users.id')
            ->select('layanan.*', 'users.name')
            ->latest()
            ->paginate(10);

        $pasien = Pasien::where('user_id', Auth::id())->first();

        // Kirim data ke view
        return view('admin.bidan.view', compact('bidanprofile', 'layanans', 'pasien'));
    }
}
