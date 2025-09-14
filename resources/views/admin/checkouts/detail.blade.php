@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.css') }}">
@endpush

@section('content')
<div class="page-heading">
    <h3>{{ $pageTitle ?? 'Default Judul' }}</h3>
</div>
<div class="page-content">
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">
                    Daftar Order Detail Pasien
                </h5>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tbody>
                        <tr>
                            <td>No. Order</td>
                            <th>: {{$order->id}}</th>
                        </tr>
                        <tr>
                            <td>Tgl. Order</td>
                            <th>: {{$order->tglorder}}</th>
                        </tr>
                        <tr>
                            <td>Pasien</td>
                            <th>: {{$order->namapasien}}</th>
                        </tr>
                        <tr>
                            <td>No. HP</td>
                            <th>: {{$order->nohp}} <a href="https://wa.me/{{$order->nohp}}" class="btn btn-success" target="_blank">
                                    <i class="fab fa-whatsapp"></i> Chat on WhatsApp
                                </a></th>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <th>: {{$order->keterangan}}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th>Layanan</th>
                            <th>Qty</th>
                            <th>Harga Satuan</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orderdetails as $orderdetail)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $orderdetail->namalayanan }}</td>
                            <td>{{ $orderdetail->jumlah }}</td>
                            <td>Rp {{ number_format($orderdetail->harga, 0, ',', '.') }}</td> <!-- Format harga satuan -->
                            <td>Rp {{ number_format($orderdetail->jumlah_bayar, 0, ',', '.') }}</td> <!-- Format total (jumlah_bayar) -->
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center"> <!-- Perbaiki colspan menjadi 5 karena ada tambahan kolom -->
                                Data belum tersedia.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-right"><strong>Total</strong></td>
                            <td><span class="badge bg-light-secondary"><b>Rp {{ number_format($orderdetails->sum('jumlah_bayar'), 0, ',', '.') }}</b></span></td> <!-- Jumlahkan jumlah_bayar -->
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
    // Tunggu sampai semua HTML dimuat
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil semua tombol dengan kelas .btn-delete
        const deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah aksi default tombol

                // Ambil form terdekat dari tombol yang diklik
                const form = this.closest('form');

                // Tampilkan SweetAlert
                Swal.fire({
                    title: 'Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    // Jika pengguna menekan "Ya, hapus!"
                    if (result.isConfirmed) {
                        // Submit form untuk menghapus data
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endpush