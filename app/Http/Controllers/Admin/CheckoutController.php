<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidan;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Pasien;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    use AuthorizesRequests;

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'total' => 'required|numeric',
        ]);

        try {
            DB::beginTransaction();

            $orderId = (string) Str::uuid();

            // Simpan ke Order
            $order = Order::create([
                'id' => $orderId,
                'statusenabled' => true,
                'pasien_id' => $request->pasienid,
                'bidan_id' => $request->bidanid,
                'status' => 'Order',
                'tglorder' => date('Y-m-d H:i:s'),
                'tglselesai' => null,
                'total' => $request->total,
            ]);

            // Simpan setiap item sebagai OrderDetail
            foreach ($request->items as $item) {
                OrderDetail::create([
                    'id' => (string) Str::uuid(),
                    'statusenabled' => true,
                    'order_id' => $orderId,
                    'layanan_id' => $item['id'],
                    'namalayanan' => $item['namalayanan'],
                    'jumlah' => $item['quantity'],
                    'harga' => $item['harga'],
                    'jumlah_bayar' => $item['harga'] * $item['quantity'],
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => 'Checkout berhasil',
                'order_id' => $orderId
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Checkout gagal: ' . $e->getMessage()
            ], 500);
        }
    }

    public function order(Request $request)
    {
        $bidan = Bidan::where('user_id', Auth::user()->id)->first();
        $pasien = Pasien::where('user_id', Auth::user()->id)->first();

        if ($bidan) {
            $orders = DB::table('order_t as o')
                ->join('bidans as bd', 'o.bidan_id', '=', 'bd.id')
                ->join('pasiens as ps', 'o.pasien_id', '=', 'ps.id')
                ->join('users as ubd', 'bd.user_id', '=', 'ubd.id')
                ->join('users as ups', 'ps.user_id', '=', 'ups.id')
                ->select(
                    'o.*',
                    'ubd.name as namabidan',
                    'ups.name as namapasien',
                    'ps.nohp',
                    'ps.keterangan'
                )
                ->where('o.bidan_id', $bidan->id)
                ->when($request->status, function ($query, $status) {
                    return $query->where('o.Order', $status);
                })
                ->orderBy('o.tglorder', 'desc')
                ->paginate(10);
        } elseif ($pasien) {
            $orders = DB::table('order_t as o')
                ->join('bidans as bd', 'o.bidan_id', '=', 'bd.id')
                ->join('pasiens as ps', 'o.pasien_id', '=', 'ps.id')
                ->join('users as ubd', 'bd.user_id', '=', 'ubd.id')
                ->join('users as ups', 'ps.user_id', '=', 'ups.id')
                ->select(
                    'o.*',
                    'ubd.name as namabidan',
                    'ups.name as namapasien',
                    'ps.nohp',
                    'ps.keterangan'
                )
                ->where('o.pasien_id', $pasien->id)
                ->when($request->status, function ($query, $status) {
                    return $query->where('o.status', $status);
                })
                ->orderBy('o.tglorder', 'desc')
                ->paginate(10);
        } else {
            $orders = collect(); // Jika bukan bidan atau pasien, kembalikan koleksi kosong
        }



        return view('admin.checkouts.index', compact('orders'));
    }

    public function orderDetail($id)
    {
        $order = DB::table('order_t as o')
            ->where('o.id', $id)
            ->join('pasiens as ps', 'o.pasien_id', '=', 'ps.id')
            ->join('users as ups', 'ps.user_id', '=', 'ups.id')
            ->select(
                'o.*',
                'ups.name as namapasien',
                'ps.nohp',
                'ps.keterangan'
            )
            ->first();

        $orderdetails = DB::table('order_t as o')
            ->join('order_detail_t as od', 'o.id', '=', 'od.order_id')
            ->select(
                'od.*'
            )
            ->where('o.id', $id)
            ->orderBy('o.tglorder', 'desc')
            ->get();

        return view('admin.checkouts.detail', compact('order', 'orderdetails'));
    }

    public function terima($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'Diterima';
        $order->tglselesai = date('Y-m-d H:i:s');
        $order->save();

        return redirect()->back()->with('success', 'Pesanan diterima.');
    }

    public function tolak($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'Ditolak';
        $order->tglselesai = date('Y-m-d H:i:s');
        $order->save();

        return redirect()->back()->with('error', 'Pesanan ditolak.');
    }

    public function selesai($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'Selesai';
        $order->tglselesai = date('Y-m-d H:i:s');
        $order->save();

        return redirect()->back()->with('error', 'Pesanan selesai.');
    }
}
