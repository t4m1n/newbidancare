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
                    Daftar Order Pasien
                </h5>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th>Pasien</th>
                            <th>No HP</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th>Tgl Order</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                        <tr>
                            <td class="text-center">{{ $loop->iteration + $orders->firstItem() - 1 }}</td>
                            <td><span class="badge bg-light-secondary">{{ $order->namapasien }}</span></td>
                            <td>
                                {{ $order->nohp }}
                                <a href="https://wa.me/{{$order->nohp}}" class="btn btn-success" target="_blank">
                                    <i class="fab fa-whatsapp"></i> Chat on WhatsApp
                                </a>
                            </td>
                            <td>
                                <pre>{{ $order->keterangan }}</pre>
                            </td>
                            <td>
                                @if ($order->status === 'Order')
                                <span class="badge bg-warning">{{ $order->status }}</span>
                                @elseif($order->status === 'success')
                                <span class="badge bg-success">{{ $order->status }}</span>
                                @endif
                            </td>
                            <td>{{ $order->tglorder }}</td>
                            <td class="text-center">
                                <a href="{{ route('checkout.detail', $order->id) }}" class="btn icon icon-left btn-success me-2 text-nowrap">
                                    <i class="bi bi-eye-fill"></i> Detail Order
                                </a>
                                @can('order.edit')
                                <a href="{{ route('oders.edit', $order) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                @endcan
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                Data belum tersedia.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $orders->links('components.pagination') }}
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