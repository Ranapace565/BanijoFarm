@extends('layouts.app')
@section('title', 'Pelanggan & Supplier')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 style="font-weight: 800;">Pelanggan & Supplier</h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="bi bi-plus-circle me-2"></i>Tambah Kontak Baru
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item">
            <a class="nav-link {{ !request('jenis') ? 'active' : '' }}" href="{{ route('kontak.index') }}">Semua Kontak</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('jenis') == 'pelanggan' ? 'active' : '' }}" href="{{ route('kontak.index', ['jenis' => 'pelanggan']) }}">Pelanggan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('jenis') == 'supplier' ? 'active' : '' }}" href="{{ route('kontak.index', ['jenis' => 'supplier']) }}">Supplier</a>
        </li>
    </ul>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            {{-- Tabel akan kita buat sebagai partial --}}
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>No. HP</th>
                            <th>Jenis</th>
                            <th>Keterangan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kontaks as $kontak)
                        <tr>
                            <td><strong>#{{ $kontak->id }}</strong></td>
                            <td>{{ $kontak->nama }}</td>
                            <td>{{ $kontak->no_hp }}</td>
                            <td>
                                @if($kontak->jenis == 'pelanggan')
                                    <span class="badge bg-primary-subtle text-primary">Pelanggan</span>
                                @else
                                    <span class="badge bg-info-subtle text-info">Supplier</span>
                                @endif
                            </td>
                            <td>{{ $kontak->keterangan }}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-warning edit-btn" data-id="{{ $kontak->id }}" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                                <form action="{{ route('kontak.destroy', $kontak->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Belum ada data kontak.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $kontaks->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>

{{-- Memanggil Modals dan Scripts --}}
@include('pages.kontak.partials._modals')
@endsection

@push('scripts')
    @include('pages.kontak.partials._scripts')
@endpush