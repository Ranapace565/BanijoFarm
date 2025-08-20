@extends('layouts.app')
@section('title', 'Manajemen Stok Domba')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 style="font-weight: 800;">Manajemen Stok Domba</h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="bi bi-plus-circle me-2"></i>Tambah Domba Baru
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <div class="card shadow-sm border-0">
        <div class="card-body">
            @include('pages.domba.partials._table')
        </div>
    </div>
</div>

@include('pages.domba.partials._modals')
@endsection

@push('scripts')
    @include('pages.domba.partials._scripts')
@endpush