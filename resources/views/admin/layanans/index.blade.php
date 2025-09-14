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
                    Daftar Layanan
                </h5>
                @can('layanans.create')
                <a href="{{ route('layanans.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i> Tambah Layanan
                </a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th>Nama Kategori</th>
                            <th>Nama Layanan</th>
                            <th>Harga</th>
                            <th>Keterangan</th>
                            <th>Gambar</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($layanans as $layanan)
                        <tr>
                            <td class="text-center">{{ $loop->iteration + $layanans->firstItem() - 1 }}</td>
                            <td>
                                <span class="badge bg-light-secondary">{{ $layanan->layanankategori->namalayanankategori }}</span><br>
                                <span class="badge bg-light-success">{{ $layanan->name }}</span>
                            </td>
                            <td>{{ $layanan->namalayanan }}</td>
                            <td>Rp. {{ number_format($layanan->harga, 0, ',', '.') }},-</td>
                            <td>{{ $layanan->keterangan }}</td>
                            <td>
                                @if ($layanan->gambar)
                                <img src="{{ asset('storage/' . $layanan->gambar) }}" alt="Gambar Layanan" width="100">
                                @else
                                <span class="text-muted">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td>
                                @if ($layanan->statusenabled == 1)
                                <span class="badge bg-success">Aktif</span>
                                @else
                                <span class="badge bg-danger">Tidak Aktif</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @can('layanans.edit')
                                <a href="{{ route('layanans.edit', $layanan) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                @endcan

                                @can('layanans.delete')
                                <form action="{{ route('layanans.destroy', $layanan) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menonaktifkan layanan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">
                                Data belum tersedia.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $layanans->links('components.pagination') }}
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