@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href=" {{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">
@endpush

@section('content')
<div class="page-heading">
    <h3>Tambah Provinsi Baru</h3>
</div>
<div class="page-content">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('provinsis.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id">Id Provinsi</label>
                            <input type="text" class="form-control @error('id') is-invalid @enderror"
                                id="id" name="id" value="{{ old('id') }}" required>
                            @error('id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="namaprovinsi">Nama Provinsi</label>
                            <input type="text" class="form-control @error('namaprovinsi') is-invalid @enderror"
                                id="namaprovinsi" name="namaprovinsi" value="{{ old('namaprovinsi') }}" required>
                            @error('namaprovinsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('provinsis.index') }}" class="btn btn-light">Kembali</a>
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