@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href=" {{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">
@endpush

@section('css')
<style>
    .bg-light-secondary {
        background-color: #f8f9fa !important;
        color: #6c757d;
    }

    .bg-light-success {
        background-color: #d1e7dd !important;
        color: #0f5132;
    }

    .keranjang-sidebar {
        position: fixed;
        top: 0;
        right: -400px;
        width: 400px;
        height: 100vh;
        background: white;
        box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
        z-index: 1050;
        transition: right 0.3s ease;
        overflow-y: auto;
    }

    .keranjang-sidebar.show {
        right: 0;
    }

    .keranjang-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1040;
        display: none;
    }

    .keranjang-overlay.show {
        display: block;
    }
</style>
@endsection

@section('content')
<div class="page-heading">
    {{-- Perubahan 1: Judul Halaman --}}
    <h3>Profile Bidan: {{ $bidanprofile->name }}</h3>
</div>
<div class="page-content">
    <div class="card">
        <div class="card-body">
            {{-- Perubahan 2: Form Action --}}
            <form action="" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div id="layanans-data" data-layanans='@json($layanans->items())'></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name', $bidanprofile->name) }}" disabled>
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="str">No. STR (yang masih berlaku)</label>
                                    <input type="text" class="form-control @error('str') is-invalid @enderror" id="str" name="str" value="{{ old('str', isset($bidanprofile) ? $bidanprofile->str : null) }}" placeholder="Masukkan No. STR yang masih berlaku" required disabled>
                                    @error('str')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nohp">No Handphone (WhatsApp)</label>
                                    <input type="text" class="form-control @error('nohp') is-invalid @enderror" id="nohp" name="nohp" value="{{ old('nohp', isset($bidanprofile) ? $bidanprofile->nohp : null) }}" placeholder="Masukkan nomor WhatsApp, diawali +62" required disabled>
                                    @error('nohp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bersedia">Bersedia Menerima Pasien</label>
                                    <input type="text" class="form-control @error('bersedia') is-invalid @enderror"
                                        id="bersedia" name="bersedia"
                                        value="{{ old('bersedia', $bidanprofile->bersedia == 1 ? 'Bersedia' : 'Tidak Bersedia') }}" disabled>
                                    @error('bersedia')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group" hidden>
                            <label for="pasien_id">Pasien Id</label>
                            <input type="text" class="form-control @error('pasien_id') is-invalid @enderror"
                                id="pasien_id" name="pasien_id" value="{{ old('pasien_id', $pasien->id) }}">
                            @error('pasien_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group" hidden>
                            <label for="user_id">User Id</label>
                            <input type="text" class="form-control @error('user_id') is-invalid @enderror"
                                id="user_id" name="user_id" value="{{ old('user_id', $bidanprofile->user_id) }}">
                            @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group" hidden>
                            <label for="id">Bidan Id</label>
                            <input type="text" class="form-control @error('id') is-invalid @enderror"
                                id="id" name="id" value="{{ old('id', isset($bidanprofile) ? $bidanprofile->id : '') }}">
                            @error('id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" required disabled>{{ old('alamat', isset($bidanprofile) ? $bidanprofile->alamat.', '.$bidanprofile->namakabupaten.', '.$bidanprofile->namaprovinsi : null) }}</textarea>
                            @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Deskripsikan Tentang Anda</label>
                            <textarea name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" required disabled>{{ old('keterangan', isset($bidanprofile) ? $bidanprofile->keterangan : null) }}</textarea>
                            @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- Longitude dan Latitude inputs -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="longitude">Longitude</label>
                                    <input type="text" class="form-control @error('longitude') is-invalid @enderror" id="longitude" name="longitude" value="{{ old('longitude', isset($bidanprofile) ? $bidanprofile->longitude : '') }}" readonly disabled>
                                    @error('longitude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="latitude">Latitude</label>
                                    <input type="text" class="form-control @error('latitude') is-invalid @enderror" id="latitude" name="latitude" value="{{ old('latitude', isset($bidanprofile) ? $bidanprofile->latitude : '') }}" readonly disabled>
                                    @error('latitude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Peta OpenStreetMap dengan Leaflet -->
                        <div id="map" style="height: 210px;"></div>
                        <a href="https://www.google.com/maps?q={{ $bidanprofile->latitude }},{{ $bidanprofile->longitude }}" target="_blank" class="btn btn-sm btn-info w-100 mt-2">
                            Lihat di Google Maps
                            <i class="bi bi-map-fill"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">
                    Pelayanan
                </h5>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Daftar Layanan</h2>
                <button type="button" class="btn btn-primary" onclick="toggleKeranjang()">
                    Keranjang <span id="keranjang-badge" class="badge bg-transparent">0</span>
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tbody id="layanan-table">
                        <!-- Data akan dimuat dengan JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Keranjang Sidebar -->
<div class="keranjang-overlay" onclick="toggleKeranjang()"></div>
<div class="keranjang-sidebar" id="keranjang-sidebar">
    <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Keranjang Layanan</h5>
        <button class="btn-close" onclick="toggleKeranjang()"></button>
    </div>

    <div class="p-3">
        <div id="keranjang-items">
            <div class="text-center text-muted" id="keranjang-kosong">
                <i class="bi bi-shopping-cart fa-2x mb-2"></i>
                <p>Keranjang masih kosong</p>
            </div>
        </div>

        <div id="keranjang-total" style="display: none;">
            <hr>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <strong>Total: <span id="total-harga">Rp. 0,-</span></strong>
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-success" onclick="prosesCheckout()">
                    <i class="bi bi-credit-card"></i> Proses Checkout
                </button>
                <button class="btn btn-outline-danger" onclick="clearKeranjang()">
                    <i class="bi bi-trash"></i> Kosongkan Keranjang
                </button>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
<!-- Memuat Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
    // Ambil data dari Blade
    let bladeLatitude = "{{ isset($bidanprofile) && $bidanprofile->latitude !== null ? $bidanprofile->latitude : '0' }}";
    let bladeLongitude = "{{ isset($bidanprofile) && $bidanprofile->longitude !== null ? $bidanprofile->longitude : '0' }}";

    // Konversi ke angka
    const latitude = Number(bladeLatitude) || 0;
    const longitude = Number(bladeLongitude) || 0;

    // Inisialisasi peta dengan posisi dari $bidanprofile
    var map = L.map('map').setView([latitude, longitude], 12);

    // Tambahkan layer OSM
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Tambahkan marker yang tidak draggable
    L.marker([latitude, longitude]).addTo(map)
        .bindPopup("Lokasi Bidan: {{$bidanprofile->name}}")
        .openPopup();

    // Jika ingin mengisi input readonly, aktifkan ini:
    document.getElementById('latitude').value = latitude;
    document.getElementById('longitude').value = longitude;

    // keranjang pilihan
    const el = document.getElementById('layanans-data');
    const layanans = JSON.parse(el.dataset.layanans);

    console.log(layanans);

    let keranjang = [];

    function formatRupiah(angka) {
        return 'Rp. ' + angka.toLocaleString('id-ID') + ',-';
    }

    function loadLayanan() {
        const tbody = document.getElementById('layanan-table');

        if (layanans.length === 0) {
            tbody.innerHTML = `
                    <tr>
                        <td colspan="8" class="text-center">Data belum tersedia.</td>
                    </tr>
                `;
            return;
        }

        tbody.innerHTML = layanans.map((layanan, index) => `
                <tr>
                    <td class="text-center">${index + 1}</td>
                    <td>
                        <span class="badge bg-light-success">${layanan.name}</span><br>
                        ${layanan.namalayanan}
                    </td>
                    <td>${formatRupiah(layanan.harga)}</td>
                    <td>${layanan.keterangan}</td>
                    <td>
                        ${layanan.gambar ? 
                            `<img src="/storage/${layanan.gambar}" alt="Gambar Layanan" width="100" class="rounded">` : 
                            '<span class="text-muted">No Image</span>'
                        }
                    </td>
                    <td class="text-center">
                        ${layanan.statusenabled == 1 ? 
                            `<button class="btn btn-sm btn-primary" onclick="tambahKeKeranjang('${layanan.id}')">
                                <i class="bi bi-cart-plus"></i> Tambah
                            </button>` : 
                            '<button class="btn btn-sm btn-secondary" disabled>Tidak Tersedia</button>'
                        }
                    </td>
                </tr>
            `).join('');
    }

    function updateKeranjang() {
        console.log("Memperbarui tampilan keranjang...");
        const keranjangItems = document.getElementById('keranjang-items');
        const keranjangTotal = document.getElementById('keranjang-total');
        const keranjangBadge = document.getElementById('keranjang-badge');

        if (keranjang.length === 0) {
            keranjangTotal.style.display = 'none';
            keranjangBadge.style.display = 'none';
            keranjangItems.innerHTML = `
            <div class="text-center text-muted" id="keranjang-kosong">
                <i class="bi bi-shopping-cart fa-2x mb-2"></i>
                <p>Keranjang masih kosong</p>
            </div>
        `;
            return;
        }

        keranjangTotal.style.display = 'block';

        const totalItems = keranjang.reduce((sum, item) => sum + item.quantity, 0);
        const totalHarga = keranjang.reduce((sum, item) => sum + (item.harga * item.quantity), 0);

        keranjangBadge.textContent = totalItems;
        keranjangBadge.style.display = 'flex';

        keranjangItems.innerHTML = keranjang.map(item => `
        <div class="card mb-2">
            <div class="card-body p-2">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="flex-grow-1">
                        <h6 class="card-title mb-1">${item.namalayanan}</h6>
                        <small class="text-muted">${formatRupiah(item.harga)} x ${item.quantity}</small>
                        <div class="mt-1">
                            <strong>${formatRupiah(item.harga * item.quantity)}</strong>
                        </div>
                    </div>
                    <button class="btn btn-sm btn-outline-danger" onclick="hapusDariKeranjang('${item.id}')">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
                <div class="d-flex align-items-center mt-2">
                    <button class="btn btn-sm btn-outline-secondary" onclick="updateQuantity('${item.id}', -1)">
                        <i class="bi bi-dash"></i>
                    </button>
                    <span class="mx-2">${item.quantity}</span>
                    <button class="btn btn-sm btn-outline-secondary" onclick="updateQuantity('${item.id}', 1)">
                        <i class="bi bi-plus"></i>
                    </button>
                </div>
            </div>
        </div>
    `).join('');

        document.getElementById('total-harga').textContent = formatRupiah(totalHarga);
    }

    function tambahKeKeranjang(layananId) {
        console.log("Tombol 'Tambah' diklik, ID layanan: ", layananId);
        const layanan = layanans.find(l => l.id === layananId.toString());
        if (!layanan) {
            console.error("Layanan tidak ditemukan dengan ID:", layananId);
            return;
        }

        const existingItem = keranjang.find(item => item.id === layananId.toString());
        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            keranjang.push({
                ...layanan,
                quantity: 1
            });
        }

        updateKeranjang();

        // Tampilkan notifikasi
        showNotification(`${layanan.namalayanan} ditambahkan ke keranjang!`);
    }

    function hapusDariKeranjang(layananId) {
        keranjang = keranjang.filter(item => item.id !== layananId.toString());
        updateKeranjang();
        showNotification('Item berhasil dihapus dari keranjang!');
    }

    function updateQuantity(layananId, change) {
        const item = keranjang.find(item => item.id === layananId.toString());
        if (item) {
            item.quantity += change;
            if (item.quantity <= 0) {
                hapusDariKeranjang(layananId);
            } else {
                updateKeranjang();
            }
        }
    }

    function toggleKeranjang() {
        const sidebar = document.getElementById('keranjang-sidebar');
        const overlay = document.querySelector('.keranjang-overlay');

        sidebar.classList.toggle('show');
        overlay.classList.toggle('show');
    }

    function clearKeranjang() {
        if (confirm('Apakah Anda yakin ingin mengosongkan keranjang?')) {
            keranjang = [];
            updateKeranjang();
            showNotification('Keranjang berhasil dikosongkan!');
        }
    }

    // function prosesCheckout() {
    //     if (keranjang.length === 0) {
    //         alert('Keranjang masih kosong!');
    //         return;
    //     }

    //     const totalHarga = keranjang.reduce((sum, item) => sum + (item.harga * item.quantity), 0);
    //     const itemList = keranjang.map(item => `- ${item.namalayanan} (${item.quantity}x)`).join('\n');

    //     alert(`Checkout berhasil!\n\nItem yang dipesan:\n${itemList}\n\nTotal: ${formatRupiah(totalHarga)}`);

    //     keranjang = [];
    //     updateKeranjang();
    //     toggleKeranjang();
    // }

    async function prosesCheckout() {
        if (keranjang.length === 0) {
            alert('Keranjang masih kosong!');
            return;
        }

        const totalHarga = keranjang.reduce((sum, item) => sum + (item.harga * item.quantity), 0);
        const pasienid = document.getElementById('pasien_id').value;;
        const bidanid = document.getElementById('id').value;;

        // Kirim ke server (AJAX/fetch)
        try {
            const response = await fetch('/checkout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({
                    items: keranjang,
                    pasienid: pasienid,
                    bidanid: bidanid,
                    total: totalHarga
                }),
            });

            const result = await response.json();

            if (response.ok) {
                const itemList = keranjang.map(item => `- ${item.namalayanan} (${item.quantity}x)`).join('\n');
                alert(`Checkout berhasil!\n\nItem yang dipesan:\n${itemList}\n\nTotal: ${formatRupiah(totalHarga)}`);

                keranjang = [];
                updateKeranjang();
                toggleKeranjang();
            } else {
                alert(`Checkout gagal: ${result.message}`);
            }

        } catch (error) {
            console.error('Error saat checkout:', error);
            alert('Terjadi kesalahan saat proses checkout.');
        }
    }


    function showNotification(message) {
        console.log("Notifikasi: ", message);
        // Buat elemen notifikasi
        const notification = document.createElement('div');
        notification.className = 'alert alert-success position-fixed';
        notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
        notification.innerHTML = `
            <i class="bi bi-check-circle"></i> ${message}
            <button type="button" class="btn-close ms-2" onclick="this.parentElement.remove()"></button>
        `;

        document.body.appendChild(notification);

        // Hapus notifikasi setelah 3 detik
        setTimeout(() => {
            if (notification.parentElement) {
                notification.remove();
            }
        }, 3000);
    }

    // Inisialisasi
    document.addEventListener('DOMContentLoaded', function() {
        loadLayanan();
        updateKeranjang();
    });

    // Tutup keranjang dengan ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const sidebar = document.getElementById('keranjang-sidebar');
            if (sidebar.classList.contains('show')) {
                toggleKeranjang();
            }
        }
    });
</script>

@endpush