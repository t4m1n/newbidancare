@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href=" {{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">
@endpush

@section('content')
<div class="page-heading">
    {{-- Perubahan 1: Judul Halaman --}}
    <h3>Edit Kabupaten: {{ $kabupaten->namakabupaten }}</h3>
</div>
<div class="page-content">
    <div class="card">
        <div class="card-body">
            {{-- Perubahan 2: Form Action --}}
            <form action="{{ route('kabupatens.update', $kabupaten) }}" method="POST">
                @csrf
                @method('PUT') {{-- Perubahan 3: Tambahkan Method PUT --}}

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="idprovinsi">Pilih Provinsi</label>
                            <select class="form-control @error('idprovinsi') is-invalid @enderror" id="idprovinsi" name="idprovinsi" required>
                                <option value="">-- Pilih Provinsi --</option>
                                @foreach($provinsis as $provinsi)
                                <option value="{{ $provinsi->id }}"
                                    {{ old('idprovinsi', $kabupaten->idprovinsi) == $provinsi->id ? 'selected' : '' }}>
                                    {{ $provinsi->namaprovinsi }}
                                </option>
                                @endforeach
                            </select>
                            @error('idprovinsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="namakabupaten">Nama Kabupaten</label>
                            {{-- Perubahan 4: Isi Value dengan data yang ada --}}
                            <input type="text" class="form-control @error('namakabupaten') is-invalid @enderror"
                                id="namakabupaten" name="namakabupaten" value="{{ old('namakabupaten', $kabupaten->namakabupaten) }}" required>
                            @error('namakabupaten')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('kabupatens.index') }}" class="btn btn-light">Kembali</a>
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