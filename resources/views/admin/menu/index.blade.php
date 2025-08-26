@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <h3>Manajemen Menu</h3>
    </div>


    <div class="page-content">
        <section class="row">
            <section class="section">
                <div class="row" id="table-bordered">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Bordered table</h4>
                            </div>
                            <div class="card-content">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th>Nama Menu</th>
                                            <th>Induk Menu</th>
                                            <th>Route</th>
                                            <th>Ikon</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($menus as $menu)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration + $menus->firstItem() - 1 }}
                                                </td>
                                                <td>{{ $menu->name }}</td>
                                                <td>
                                                    {{-- Tampilkan nama parent jika ada, jika tidak tampilkan strip --}}
                                                    <span
                                                        class="badge bg-light-secondary">{{ $menu->parent ? $menu->parent->name : '-' }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-light-info">{{ $menu->route_name ?? '-' }}</span>
                                                </td>
                                                <td><i class="{{ $menu->icon }}"></i></td>
                                                <td class="text-center">
                                                    {{-- @can('menu.edit') --}}
                                                    <a href="{{ route('menus.edit', $menu) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    {{-- @endcan --}}

                                                    {{-- @can('menu.delete') --}}
                                                    <button type="button" class="btn btn-sm btn-danger">
                                                        <i class="bi bi-trash3-fill"></i>
                                                    </button>
                                                    {{-- @endcan --}}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">
                                                    Data belum tersedia.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3">
                                {{-- Memanggil view pagination kustom kita --}}
                                {{ $menus->links('components.pagination') }}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </div>
@endsection
