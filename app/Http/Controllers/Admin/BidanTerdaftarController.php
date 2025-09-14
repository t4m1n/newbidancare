<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidan;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BidanTerdaftarController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        // Otorisasi: Pastikan user punya izin 'bidanterdaftar.view'
        $this->authorize('bidanterdaftar.view');

        // Ambil semua data bidanterdaftar
        $bidanterdaftars = Bidan::join('users', 'bidans.user_id', '=', 'users.id')
            ->join('provinsi', 'bidans.idprovinsi', '=', 'provinsi.id')
            ->join('kabupaten', 'bidans.idkabupaten', '=', 'kabupaten.id')
            ->select(
                'bidans.*',
                'users.name',
                'provinsi.namaprovinsi',
                'kabupaten.namakabupaten'
            )
            ->where('bidans.approv', 1)
            ->paginate(10);

        // Kirim data ke view
        return view('admin.bidanterdaftars.index', compact('bidanterdaftars'));
    }
}
