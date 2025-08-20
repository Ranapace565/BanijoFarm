{{-- resources/views/pages/keuangan/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Kelola Keuangan')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 style="font-weight: 800;">Kelola Pemasukan & Pengeluaran</h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="bi bi-plus-circle me-2"></i>Tambah Transaksi
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    {{-- Navigasi Filter --}}
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item">
            <a class="nav-link {{ !request('jenis') ? 'active' : '' }}" href="{{ route('keuangan.index') }}">Semua Transaksi</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('jenis') == 'pemasukan' ? 'active' : '' }}" href="{{ route('keuangan.index', ['jenis' => 'pemasukan']) }}">Pemasukan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('jenis') == 'pengeluaran' ? 'active' : '' }}" href="{{ route('keuangan.index', ['jenis' => 'pengeluaran']) }}">Pengeluaran</a>
        </li>
    </ul>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            @include('pages.keuangan.partials._table')
        </div>
    </div>
</div>

{{-- Memanggil Modals dan Scripts dari file partial --}}
@include('pages.keuangan.partials._modals')
@endsection

@push('scripts')
    @include('pages.keuangan.partials._scripts')
@endpush