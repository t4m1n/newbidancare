@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.css') }}">
@endpush

<style>
    body {
        background-color: #2d3748;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        padding: 20px;
    }

    /* Custom styles untuk memperbaiki tampilan */
    .comment {
        background-color: #1e1e2d;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
        /* KUNCI: Mencegah overflow */
        overflow: hidden;
        word-wrap: break-word;
    }

    .comment-header {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        /* PENTING: Mencegah flex items keluar */
        min-width: 0;
    }

    /* Fix untuk pr-50 - gunakan padding Bootstrap */
    .pr-50 {
        padding-right: 15px !important;
    }

    /* Fix untuk avatar */
    .avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        overflow: hidden;
        flex-shrink: 0;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Jika gambar tidak ada, tampilkan inisial */
    .avatar-fallback {
        color: white;
        font-size: 24px;
        font-weight: bold;
    }

    .comment-body {
        /* KUNCI: flex: 1 dan min-width: 0 untuk text wrapping */
        flex: 1;
        min-width: 0;
        color: #e2e8f0;
        /* Pastikan content tidak keluar */
        overflow-wrap: break-word;
        word-wrap: break-word;
    }

    .comment-profileName {
        font-size: 18px;
        font-weight: 600;
        color: #f7fafc;
        margin-bottom: 5px;
        /* Mencegah nama panjang keluar */
        word-break: break-word;
        line-height: 1.3;
    }

    .comment-time {
        font-size: 14px;
        color: #81c5f4;
        margin-bottom: 10px;
        /* Mencegah alamat panjang keluar */
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    .comment-message {
        margin-bottom: 15px;
        /* Pastikan message tidak overflow */
        overflow-wrap: break-word;
        word-wrap: break-word;
    }

    .comment-message p {
        color: #cbd5e0;
        font-size: 16px;
        line-height: 1.5;
        margin-bottom: 0;
        /* PENTING: Text wrapping untuk keterangan panjang */
        word-wrap: break-word;
        overflow-wrap: break-word;
        hyphens: auto;
    }

    .comment-message a {
        color: #81c5f4;
        text-decoration: none;
        /* Mencegah link panjang overflow */
        word-break: break-all;
    }

    .comment-message a:hover {
        color: #60a5fa;
        text-decoration: underline;
    }

    /* Fix untuk mb-20 - gunakan margin Bootstrap */
    .mb-20 {
        margin-bottom: 1.25rem !important;
    }

    /* Fix untuk truncate - tapi biarkan wrap di mobile */
    .truncate {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        /* Override untuk memastikan tidak keluar container */
        max-width: 100%;
    }

    .comment-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    /* Override button styles untuk dark theme */
    .comment-actions .btn {
        border-radius: 6px;
        font-size: 14px;
        padding: 8px 16px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        /* Mencegah tombol terlalu lebar */
        max-width: 100%;
        flex-shrink: 0;
    }

    /* Fix untuk icon styles */
    .btn.icon i {
        font-size: 14px;
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .comment-header {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .pr-50 {
            padding-right: 0 !important;
            margin-bottom: 15px;
        }

        .comment-actions {
            flex-direction: column;
            width: 100%;
        }

        .comment-actions .btn {
            width: 100%;
            justify-content: center;
            max-width: none;
        }

        /* PENTING: Di mobile, matikan truncate dan biarkan text wrap */
        .truncate {
            white-space: normal;
            overflow: visible;
            text-overflow: clip;
        }

        .comment-body {
            text-align: left;
        }
    }

    @media (max-width: 576px) {
        .comment {
            padding: 15px;
            margin: 10px;
        }

        .avatar {
            width: 80px;
            height: 80px;
        }

        .avatar-fallback {
            font-size: 20px;
        }
    }

    /* Loading state untuk gambar */
    .avatar img[src="./assets/compiled/jpg/2.jpg"] {
        display: none;
    }

    .avatar:has(img[src="./assets/compiled/jpg/2.jpg"]) .avatar-fallback {
        display: flex;
    }

    /* Utility untuk text yang sangat panjang */
    .force-wrap {
        word-break: break-word;
        overflow-wrap: break-word;
        hyphens: auto;
        white-space: normal !important;
    }

    /* Demo containers */
    .demo-section {
        margin-bottom: 30px;
    }

    .demo-title {
        color: #81c5f4;
        font-size: 16px;
        margin-bottom: 15px;
        padding: 8px 12px;
        background-color: rgba(129, 197, 244, 0.1);
        border-radius: 6px;
    }
</style>

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

    <section class="row">
        @forelse ($bidandisekitars as $bidandisekitar)
        <div class="col-12 col-lg-6 col-md-12">
            <div class="comment">
                <div class="comment-header">
                    <div class="pr-50">
                        <div class="avatar avatar-2xl">
                            <img src="./assets/compiled/jpg/2.jpg" alt="Avatar">
                        </div>
                    </div>
                    <div class="comment-body">
                        <div class="comment-profileName"><u>{{ $bidandisekitar->name }}</u></div>
                        <div class="comment-message">{{ $bidandisekitar->str }}</div>
                        <div class="comment-time">{{ $bidandisekitar->alamat }}, {{ $bidandisekitar->namakabupaten }}, {{ $bidandisekitar->namaprovinsi }} </div>
                        <div class="comment-message">
                            <p class="list-group-item-text truncate mb-20">{{ $bidandisekitar->keterangan }}</p>
                        </div>
                        <div class="comment-actions">
                            <a href="https://www.google.com/maps?q={{ $bidandisekitar->latitude }},{{ $bidandisekitar->longitude }}" target="_blank" class="btn icon icon-left btn-primary me-2 text-nowrap">
                                <i class="bi bi-map-fill"></i> View Map
                            </a>
                            <span class="btn icon icon-left me-2 text-nowrap {{ $bidandisekitar->bersedia == 1 ? 'btn-success' : 'btn-danger' }}">
                                {{ $bidandisekitar->bersedia == 1 ? 'Buka' : 'Tutup' }}
                            </span>
                            @if($bidandisekitar->approv == 1)
                            <a href="{{ route('bidan.profile', $bidandisekitar->id) }}" class="btn icon icon-left btn-warning me-2 text-nowrap">
                                <i class="bi bi-eye-fill"></i> Pilih Bidan
                            </a>
                            @else
                            <button class="btn icon icon-left btn-secondary me-2 text-nowrap" disabled>
                                <i class="bi bi-clock-fill"></i> Menunggu Persetujuan
                            </button>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        @endforelse
    </section>
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