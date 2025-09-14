@extends('layouts.app')

@section('content')

<div class="page-heading">
    <h3>Profile Statistics</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                @if ($user->roles->first()->id === 5 || $user->roles->first()->id === 1)
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Bidan Belum Approv</h6>
                                    <h6 class="font-extrabold mb-0">{{$countPengajuan}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if ($user->roles->first()->id === 5 || $user->roles->first()->id === 1)
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Bidan Terdaftar</h6>
                                    <h6 class="font-extrabold mb-0">{{$countTerdaftar}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if ($user->roles->first()->id === 1)
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon green mb-2">
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Pasien Terdaftar</h6>
                                    <h6 class="font-extrabold mb-0">{{$countPasien}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if ($user->roles->first()->id === 6)
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Bidan Disekitar Anda</h6>
                                    <h6 class="font-extrabold mb-0">{{$countBidanTerdekat}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif


                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon red mb-2">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Saved Post</h6>
                                    <h6 class="font-extrabold mb-0">112</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- bidan -->
        @if ($user->roles->first()->id === 5)
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-12 col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon red mb-2">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Anda Terdaftar Sebagai Bidan, Silahkan lengkapi data berikut</h6>
                                    <h6 class="font-extrabold mb-0">
                                        @if (isset($bidan))
                                        * Data Bidan Anda Sudah Lengkap
                                        @else
                                        <div style="color: red;">* Data Bidan Anda Belum Lengkap</div>
                                        @endif
                                    </h6>
                                    <h6 class="font-extrabold mb-0">
                                        @if (isset($bidan) && $bidan->bersedia == 1)
                                        * Status Bersedia Menerima Pasien Sudah Aktif
                                        @else
                                        <div style="color: red;">* Status Bersedia Menerima Pasien Tidak Aktif</div>
                                        @endif
                                    </h6>
                                    <h6 class="font-extrabold mb-0">
                                        @if (isset($bidan) && $bidan->approv == 1)
                                        * Status Approv Admin Sudah Aktif
                                        @else
                                        <div style="color: red;">* Status Approv Admin Belum Aktif</div>
                                        @endif
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ isset($bidan) ? route('bidan.update', $bidan->id) : route('bidan.store') }}" method="POST">
                    @csrf
                    @method(isset($bidan) ? 'PUT' : 'POST') <!-- Atur method menjadi PUT jika update -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama Lengkap</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $user->name) }}" disabled>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group" hidden>
                                <label for="user_id">User Id</label>
                                <input type="text" class="form-control @error('user_id') is-invalid @enderror"
                                    id="user_id" name="user_id" value="{{ old('user_id', $user->id) }}">
                                @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group" hidden>
                                <label for="id">Bidan Id</label>
                                <input type="text" class="form-control @error('id') is-invalid @enderror"
                                    id="id" name="id" value="{{ old('id', isset($bidan) ? $bidan->id : '') }}">
                                @error('id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="idprovinsi">Pilih Provinsi</label>
                                <select class="form-control @error('idprovinsi') is-invalid @enderror" id="idprovinsi" name="idprovinsi" required>
                                    <option value="">-- Pilih Provinsi --</option>
                                    @foreach($provinsis as $provinsi)
                                    <option value="{{ $provinsi->id }}" {{ old('idprovinsi', isset($bidan) ? $bidan->idprovinsi : null) == $provinsi->id ? 'selected' : '' }}>
                                        {{ $provinsi->namaprovinsi }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('idprovinsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="idkabupaten">Pilih Kabupaten</label>
                                <select class="form-control @error('idkabupaten') is-invalid @enderror" id="idkabupaten" name="idkabupaten" required>
                                    <option value="">-- Pilih Kabupaten --</option>
                                    @foreach($kabupatens as $kabupaten)
                                    <option value="{{ $kabupaten->id }}" {{ old('idkabupaten', isset($bidan) ? $bidan->idkabupaten : null) == $kabupaten->id ? 'selected' : '' }}>
                                        {{ $kabupaten->namakabupaten }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('idkabupaten')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" required>{{ old('alamat', isset($bidan) ? $bidan->alamat : null) }}</textarea>
                                @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nohp">No Handphone (WhatsApp)</label>
                                <input type="text" class="form-control @error('nohp') is-invalid @enderror" id="nohp" name="nohp" value="{{ old('nohp', isset($bidan) ? $bidan->nohp : null) }}" placeholder="Masukkan nomor WhatsApp, diawali +62" required>
                                @error('nohp')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="str">No. STR (yang masih berlaku)</label>
                                <input type="text" class="form-control @error('str') is-invalid @enderror" id="str" name="str" value="{{ old('str', isset($bidan) ? $bidan->str : null) }}" placeholder="Masukkan No. STR yang masih berlaku" required>
                                @error('str')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="keterangan">Deskripsikan Tentang Anda</label>
                                <textarea name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" required>{{ old('keterangan', isset($bidan) ? $bidan->keterangan : null) }}</textarea>
                                @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="bersedia">Bersedia Menerima Pasien</label>
                                <select class="form-control @error('bersedia') is-invalid @enderror" id="bersedia" name="bersedia">
                                    <option value="1" {{ old('bersedia', isset($bidan) ? $bidan->bersedia : null) == 1 ? 'selected' : '' }}>Ya</option>
                                    <option value="0" {{ old('bersedia', isset($bidan) ? $bidan->bersedia : null) == 0 ? 'selected' : '' }}>Tidak</option>
                                </select>
                                @error('bersedia')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="col-md-6">
                            <!-- Longitude dan Latitude inputs -->
                            <div class="form-group">
                                <label for="longitude">Longitude</label>
                                <input type="text" class="form-control @error('longitude') is-invalid @enderror" id="longitude" name="longitude" value="{{ old('longitude', isset($pasien) ? $pasien->longitude : '') }}" readonly>
                                @error('longitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="latitude">Latitude</label>
                                <input type="text" class="form-control @error('latitude') is-invalid @enderror" id="latitude" name="latitude" value="{{ old('latitude', isset($pasien) ? $pasien->latitude : '') }}" readonly>
                                @error('latitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Peta OpenStreetMap dengan Leaflet -->
                            <div id="map" style="height: 450px;"></div>
                            <i>pilih lokasi Anda dengan mengklik peta atau menggeser marker.</i>
                        </div>
                    </div>
                    {{-- TIDAK ADA PILIHAN ROLE DI SINI --}}
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Update Bidan</button>
                    </div>
                </form>
            </div>
        </div>
        @endif

        <!-- pasien -->
        @if ($user->roles->first()->id === 6)
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-12 col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon red mb-2">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Anda Terdaftar Sebagai Pasien, Silahkan lengkapi data berikut</h6>
                                    <h6 class="font-extrabold mb-0">
                                        @if (isset($pasien))
                                        * Data Diri Anda Sudah Lengkap
                                        @else
                                        <div style="color: red;">* Data Diri Anda Belum Lengkap</div>
                                        @endif
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ isset($pasien) ? route('pasien.update', $pasien->id) : route('pasien.store') }}" method="POST">
                    @csrf
                    @method(isset($pasien) ? 'PUT' : 'POST') <!-- Atur method menjadi PUT jika update -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama Lengkap</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $user->name) }}" disabled>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group" hidden>
                                <label for="user_id">User Id</label>
                                <input type="text" class="form-control @error('user_id') is-invalid @enderror"
                                    id="user_id" name="user_id" value="{{ old('user_id', $user->id) }}">
                                @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group" hidden>
                                <label for="id">Bidan Id</label>
                                <input type="text" class="form-control @error('id') is-invalid @enderror"
                                    id="id" name="id" value="{{ old('id', isset($pasien) ? $pasien->id : '') }}">
                                @error('id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="idprovinsi">Pilih Provinsi</label>
                                <select class="form-control @error('idprovinsi') is-invalid @enderror" id="idprovinsi" name="idprovinsi" required>
                                    <option value="">-- Pilih Provinsi --</option>
                                    @foreach($provinsis as $provinsi)
                                    <option value="{{ $provinsi->id }}" {{ old('idprovinsi', isset($pasien) ? $pasien->idprovinsi : null) == $provinsi->id ? 'selected' : '' }}>
                                        {{ $provinsi->namaprovinsi }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('idprovinsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="idkabupaten">Pilih Kabupaten</label>
                                <select class="form-control @error('idkabupaten') is-invalid @enderror" id="idkabupaten" name="idkabupaten" required>
                                    <option value="">-- Pilih Kabupaten --</option>
                                    @foreach($kabupatens as $kabupaten)
                                    <option value="{{ $kabupaten->id }}" {{ old('idkabupaten', isset($pasien) ? $pasien->idkabupaten : null) == $kabupaten->id ? 'selected' : '' }}>
                                        {{ $kabupaten->namakabupaten }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('idkabupaten')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" required>{{ old('alamat', isset($pasien) ? $pasien->alamat : null) }}</textarea>
                                @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nohp">No Handphone (WhatsApp)</label>
                                <input type="text" class="form-control @error('nohp') is-invalid @enderror" id="nohp" name="nohp" value="{{ old('nohp', isset($pasien) ? $pasien->nohp : null) }}" placeholder="Masukkan nomor WhatsApp, diawali +62" required>
                                @error('nohp')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tgllhr">Tgl Lahir</label>
                                <input type="date" class="form-control @error('tgllhr') is-invalid @enderror" id="tgllhr" name="tgllhr" value="{{ old('tgllhr', isset($pasien) ? $pasien->tgllhr : null) }}" placeholder="Masukkan nomor WhatsApp, diawali +62" required>
                                @error('tgllhr')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="keterangan">Keluhan Singkat</label>
                                <textarea name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" required>{{ old('keterangan', isset($pasien) ? $pasien->keterangan : null) }}</textarea>
                                @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="col-md-6">
                            <!-- Longitude dan Latitude inputs -->
                            <div class="form-group">
                                <label for="longitude">Longitude</label>
                                <input type="text" class="form-control @error('longitude') is-invalid @enderror" id="longitude" name="longitude" value="{{ old('longitude', isset($pasien) ? $pasien->longitude : '') }}" readonly>
                                @error('longitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="latitude">Latitude</label>
                                <input type="text" class="form-control @error('latitude') is-invalid @enderror" id="latitude" name="latitude" value="{{ old('latitude', isset($pasien) ? $pasien->latitude : '') }}" readonly>
                                @error('latitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Peta OpenStreetMap dengan Leaflet -->
                            <div id="map" style="height: 450px;"></div>
                            <i>pilih lokasi Anda dengan mengklik peta atau menggeser marker.</i>
                        </div>
                    </div>
                    {{-- TIDAK ADA PILIHAN ROLE DI SINI --}}
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
        @endif


    </section>
</div>
@endsection

@push('scripts')
<!-- Memuat jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Memuat Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<script>
    $(document).ready(function() {
        // Ketika provinsi dipilih
        $('#idprovinsi').change(function() {
            var idprovinsi = $(this).val();

            if (idprovinsi) {
                // Ambil kabupaten berdasarkan idprovinsi
                $.ajax({
                    url: '/kabupaten/' + idprovinsi, // Endpoint untuk mengambil kabupaten berdasarkan idprovinsi
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // Kosongkan dropdown kabupaten terlebih dahulu
                        $('#idkabupaten').empty();
                        $('#idkabupaten').append('<option value="">-- Pilih Kabupaten --</option>');

                        // Isi dropdown kabupaten dengan data yang didapat
                        $.each(data, function(key, value) {
                            $('#idkabupaten').append('<option value="' + value.id + '">' + value.namakabupaten + '</option>');
                        });
                    },
                    error: function() {
                        alert('Terjadi kesalahan saat memuat kabupaten.');
                    }
                });
            } else {
                // Jika tidak ada provinsi yang dipilih, kosongkan dropdown kabupaten
                $('#idkabupaten').empty();
                $('#idkabupaten').append('<option value="">-- Pilih Kabupaten --</option>');
            }
        });

        // Map Leaflet.js
        // Cek apakah browser mendukung Geolocation API
        // if (navigator.geolocation) {
        //     navigator.geolocation.getCurrentPosition(function(position) {
        //         // Ambil posisi saat ini dari Geolocation API
        //         var latitude = position.coords.latitude;
        //         var longitude = position.coords.longitude;

        //         // Memastikan nilai latitude dan longitude berupa angka
        //         latitude = Number(latitude) || 0;
        //         longitude = Number(longitude) || 0;

        //         // Membuat peta dan menetapkan posisi pengguna
        //         var map = L.map('map').setView([latitude, longitude], 12);

        //         // Menambahkan layer OpenStreetMap
        //         L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        //             attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        //         }).addTo(map);

        //         // Menambahkan marker di posisi pengguna
        //         var marker = L.marker([latitude, longitude], {
        //             draggable: true
        //         }).addTo(map);

        //         // Update input latitude dan longitude ketika marker digeser
        //         marker.on('dragend', function(e) {
        //             var position = marker.getLatLng();
        //             document.getElementById('latitude').value = position.lat;
        //             document.getElementById('longitude').value = position.lng;
        //         });

        //         // Update input latitude dan longitude ketika peta diklik
        //         map.on('click', function(e) {
        //             var clickedLocation = e.latlng;
        //             marker.setLatLng(clickedLocation);
        //             document.getElementById('latitude').value = clickedLocation.lat;
        //             document.getElementById('longitude').value = clickedLocation.lng;
        //         });

        //         // Update input latitude dan longitude sesuai posisi awal
        //         document.getElementById('latitude').value = latitude;
        //         document.getElementById('longitude').value = longitude;

        //     }, function(error) {
        //         // Jika geolocation gagal
        //         alert("Lokasi Anda tidak dapat diakses.");
        //     });
        // } else {
        //     alert("Geolocation tidak didukung oleh browser ini.");
        // }

        // Ambil data dari Blade atau old input (jika tersedia)
        let bladeLatitude = "{{ old('latitude', isset($bidan) && $bidan->latitude !== null ? $bidan->latitude : (isset($pasien) && $pasien->latitude !== null ? $pasien->latitude : '')) }}";
        let bladeLongitude = "{{ old('longitude', isset($bidan) && $bidan->longitude !== null ? $bidan->longitude : (isset($pasien) && $pasien->longitude !== null ? $pasien->longitude : '')) }}";


        bladeLatitude = bladeLatitude !== "" ? Number(bladeLatitude) : null;
        bladeLongitude = bladeLongitude !== "" ? Number(bladeLongitude) : null;

        if (bladeLatitude !== null && bladeLongitude !== null) {
            // ✅ Gunakan data dari Blade
            initMap(bladeLatitude, bladeLongitude);
        } else if (navigator.geolocation) {
            // 🛰️ Gunakan geolocation dari browser jika data Blade tidak ada
            navigator.geolocation.getCurrentPosition(function(position) {
                const latitude = Number(position.coords.latitude) || 0;
                const longitude = Number(position.coords.longitude) || 0;
                initMap(latitude, longitude);
            }, function(error) {
                alert("Lokasi Anda tidak dapat diakses.");
            });
        } else {
            alert("Geolocation tidak didukung oleh browser ini.");
        }

        // 🔁 Fungsi untuk menginisialisasi peta
        function initMap(latitude, longitude) {
            var map = L.map('map').setView([latitude, longitude], 12);

            // Tambahkan layer OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Tambahkan marker yang bisa digeser
            var marker = L.marker([latitude, longitude], {
                draggable: true
            }).addTo(map);

            // Isi input dengan nilai awal
            document.getElementById('latitude').value = latitude;
            document.getElementById('longitude').value = longitude;

            // Update input saat marker digeser
            marker.on('dragend', function(e) {
                var pos = marker.getLatLng();
                document.getElementById('latitude').value = pos.lat;
                document.getElementById('longitude').value = pos.lng;
            });

            // Update marker dan input saat peta diklik
            map.on('click', function(e) {
                var pos = e.latlng;
                marker.setLatLng(pos);
                document.getElementById('latitude').value = pos.lat;
                document.getElementById('longitude').value = pos.lng;
            });
        }
    });
</script>