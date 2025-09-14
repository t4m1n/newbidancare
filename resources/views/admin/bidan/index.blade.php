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
                    Bidan Terdaftar
                </h5>
                <!-- @can('provinsi.create')
                <a href="{{ route('provinsis.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i> Tambah Provinsi
                </a>
                @endcan -->
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th>Nama Bidan</th>
                            <th>No HP (WA)</th>
                            <th>No. STR</th>
                            <th>Deskripsi</th>
                            <th>Provinsi</th>
                            <th>Kabupaten</th>
                            <th>Alamat</th>
                            <th>Map</th>
                            <th>Pasien</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bidanterdaftars as $bidanterdaftar)
                        <tr>
                            <td class="text-center">{{ $loop->iteration + $bidanterdaftars->firstItem() - 1 }}</td>
                            <td>{{ $bidanterdaftar->name }}</td>
                            <td>{{ $bidanterdaftar->nohp }}</td>
                            <td>{{ $bidanterdaftar->str }}</td>
                            <td>{{ $bidanterdaftar->keterangan }}</td>
                            <td>{{ $bidanterdaftar->namaprovinsi }}</td>
                            <td>{{ $bidanterdaftar->namakabupaten }}</td>
                            <td>{{ $bidanterdaftar->alamat }}</td>
                            <td class="text-center">
                                @if ($bidanterdaftar->latitude && $bidanterdaftar->longitude)
                                <a href="https://www.google.com/maps?q={{ $bidanterdaftar->latitude }},{{ $bidanterdaftar->longitude }}" target="_blank" class="btn btn-sm btn-info">
                                    <i class="bi bi-map-fill"></i>
                                </a>
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $bidanterdaftar->bersedia == 1 ? 'bg-success' : 'bg-danger' }}">
                                    {{ $bidanterdaftar->bersedia == 1 ? 'Buka' : 'Tutup' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <form action="{{ route('bidan.unapprove', $bidanterdaftar->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin membatalkan persetujuan bidan ini?')">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-danger btn-sm">Batal Approv</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11" class="text-center">
                                Data tidak tersedia.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $bidanterdaftars->links('components.pagination') }}
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