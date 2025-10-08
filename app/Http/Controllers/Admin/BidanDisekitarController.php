<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidanDisekitarController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        // Otorisasi: Pastikan user punya izin 'bidandisekitar.view'
        $this->authorize('bidandisekitar.view');

        $user = Auth::user();

        // Ambil semua data bidandisekitars
        $bidandisekitars = Pasien::join('bidans', 'pasiens.idkabupaten', '=', 'bidans.idkabupaten')
            ->join('users', 'bidans.user_id', '=', 'users.id')
            ->join('provinsi', 'bidans.idprovinsi', '=', 'provinsi.id')
            ->join('kabupaten', 'bidans.idkabupaten', '=', 'kabupaten.id')
            ->where('pasiens.user_id', 5)
            ->select(
                'bidans.*',
                'users.name',
                'provinsi.namaprovinsi',
                'kabupaten.namakabupaten'
            )
            ->get();
            // ->paginate(10);

        // Kirim data ke view
        return view('admin.bidandisekitars.index', compact('bidandisekitars'));
    }
}
