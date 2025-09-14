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
                    Pasien Terdaftar
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
                            <th>Nama Pasien</th>
                            <th>No HP (WA)</th>
                            <th>Tgl. Lahir</th>
                            <th>Keluhan</th>
                            <th>Provinsi</th>
                            <th>Kabupaten</th>
                            <th>Alamat</th>
                            <th>Map</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pasienterdaftars as $pasienterdaftar)
                        <tr>
                            <td class="text-center">{{ $loop->iteration + $pasienterdaftars->firstItem() - 1 }}</td>
                            <td>{{ $pasienterdaftar->name }}</td>
                            <td>{{ $pasienterdaftar->nohp }}</td>
                            <td>{{ $pasienterdaftar->tgllhr }}</td>
                            <td>{{ $pasienterdaftar->keterangan }}</td>
                            <td>{{ $pasienterdaftar->namaprovinsi }}</td>
                            <td>{{ $pasienterdaftar->namakabupaten }}</td>
                            <td>{{ $pasienterdaftar->alamat }}</td>
                            <td class="text-center">
                                @if ($pasienterdaftar->latitude && $pasienterdaftar->longitude)
                                <a href="https://www.google.com/maps?q={{ $pasienterdaftar->latitude }},{{ $pasienterdaftar->longitude }}" target="_blank" class="btn btn-sm btn-info">
                                    <i class="bi bi-map-fill"></i>
                                </a>
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center">
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
                {{ $pasienterdaftars->links('components.pagination') }}
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