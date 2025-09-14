<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class PasienTerdaftarController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        // Otorisasi: Pastikan user punya izin 'pasienterdaftar.view'
        $this->authorize('pasienterdaftar.view');

        // Ambil semua data bidanterdaftar
        $pasienterdaftars = Pasien::join('users', 'pasiens.user_id', '=', 'users.id')
            ->join('provinsi', 'pasiens.idprovinsi', '=', 'provinsi.id')
            ->join('kabupaten', 'pasiens.idkabupaten', '=', 'kabupaten.id')
            ->select(
                'pasiens.*',
                'users.name',
                'provinsi.namaprovinsi',
                'kabupaten.namakabupaten'
            )
            ->paginate(10);

        // Kirim data ke view
        return view('admin.pasienterdaftars.index', compact('pasienterdaftars'));
    }
}
