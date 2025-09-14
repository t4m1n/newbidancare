@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href=" {{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">
@endpush

@section('content')
<div class="page-heading">
    <h3>Tambah Layanan Baru</h3>
</div>
<div class="page-content">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('layanans.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id">Id Layanan</label>
                            <input type="text" class="form-control @error('id') is-invalid @enderror"
                                id="id" name="id" value="{{ old('id') }}" disabled>
                            @error('id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="idbidan">Bidan</label>
                            <select class="form-control @error('idbidan') is-invalid @enderror" id="idbidan" name="idbidan" required>
                                <option value="">-- Pilih Bidan --</option>
                                @foreach($bidans as $bidan)
                                <option value="{{ $bidan->id }}" {{ old('idbidan') == $bidan->id ? 'selected' : '' }}>
                                    {{ $bidan->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('idbidan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="idlayanankategori">Kategori Layanan</label>
                            <select class="form-control @error('idlayanankategori') is-invalid @enderror" id="idlayanankategori" name="idlayanankategori" required>
                                <option value="">-- Pilih Kategori Layanan --</option>
                                @foreach($layanankategoris as $layanankategori)
                                <option value="{{ $layanankategori->id }}" {{ old('idlayanankategori') == $layanankategori->id ? 'selected' : '' }}>
                                    {{ $layanankategori->namalayanankategori }}
                                </option>
                                @endforeach
                            </select>
                            @error('idlayanankategori')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="namalayanan">Nama Layanan</label>
                            <input type="text" class="form-control @error('namalayanan') is-invalid @enderror"
                                id="namalayanan" name="namalayanan" value="{{ old('namalayanan') }}" required>
                            @error('namalayanan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="harga">Harga (Rp.)</label>
                            <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                id="harga" name="harga" value="{{ old('harga') }}" required>
                            @error('harga')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" required>{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="gambar">Gambar</label>
                            <input type="file" class="form-control-file @error('gambar') is-invalid @enderror" id="gambar" name="gambar" accept="image/*">
                            @error('gambar')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('layanans.index') }}" class="btn btn-light">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
<script>
    let choices = document.querySelectorAll(".choices")
    let initChoice
    for (let i = 0; i < choices.length; i++) {
        if (choices[i].classList.contains("multiple-remove")) {
            initChoice = new Choices(choices[i], {
                delimiter: ",",
                editItems: true,
                maxItemCount: -1,
                removeItemButton: true,
            })
        } else {
            initChoice = new Choices(choices[i])
        }
    }
</script>
@endpush