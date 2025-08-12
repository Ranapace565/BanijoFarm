@extends('layouts.app')
@section('title', 'Pelanggan & Supplier')

@section('content')
    <h1 class="h3 mb-4 text-gray-800" style="font-weight: 700;">Pelanggan & Supplier</h1>

    @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

    <!-- Navigasi Tabs -->
    <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pelanggan-tab" data-bs-toggle="tab" data-bs-target="#pelanggan-tab-pane" type="button" role="tab">Pelanggan</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="supplier-tab" data-bs-toggle="tab" data-bs-target="#supplier-tab-pane" type="button" role="tab">Supplier</button>
        </li>
    </ul>

    <!-- Konten Tabs -->
    <div class="tab-content" id="myTabContent">
        <!-- ================== TAB PELANGGAN ================== -->
        <div class="tab-pane fade show active" id="pelanggan-tab-pane" role="tabpanel">
            <div class="card shadow-sm border-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Pelanggan</h6>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addPelangganModal">Tambah Pelanggan</button>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead><tr><th>Nama</th><th>Telepon</th><th>Alamat</th><th class="text-center">Aksi</th></tr></thead>
                        <tbody>
                            @forelse ($pelanggans as $pelanggan)
                            <tr>
                                <td>{{ $pelanggan->nama }}</td>
                                <td>{{ $pelanggan->nomor_telepon }}</td>
                                <td>{{ $pelanggan->alamat }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-warning edit-pelanggan-btn" data-id="{{ $pelanggan->id }}"><i class="bi bi-pencil-square"></i></button>
                                    <button class="btn btn-sm btn-danger delete-pelanggan-btn" data-id="{{ $pelanggan->id }}"><i class="bi bi-trash-fill"></i></button>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center">Belum ada data pelanggan.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ================== TAB SUPPLIER ================== -->
        <div class="tab-pane fade" id="supplier-tab-pane" role="tabpanel">
            <div class="card shadow-sm border-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Supplier</h6>
                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#addSupplierModal">Tambah Supplier</button>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead><tr><th>Nama</th><th>Telepon</th><th>Alamat</th><th>Produk</th><th class="text-center">Aksi</th></tr></thead>
                        <tbody>
                            @forelse ($suppliers as $supplier)
                            <tr>
                                <td>{{ $supplier->nama }}</td>
                                <td>{{ $supplier->nomor_telepon }}</td>
                                <td>{{ $supplier->alamat }}</td>
                                <td>{{ $supplier->produk_disediakan }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-warning edit-supplier-btn" data-id="{{ $supplier->id }}"><i class="bi bi-pencil-square"></i></button>
                                    <button class="btn btn-sm btn-danger delete-supplier-btn" data-id="{{ $supplier->id }}"><i class="bi bi-trash-fill"></i></button>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="text-center">Belum ada data supplier.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals Pelanggan -->
    @include('pages.modals.pelanggan')
    <!-- Modals Supplier -->
    @include('pages.modals.supplier')
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

    // === LOGIKA CRUD PELANGGAN ===
    $('.edit-pelanggan-btn').on('click', function() {
        let id = $(this).data('id');
        $.get(`/pelanggan/${id}`, function(data) {
            $('#edit_pelanggan_nama').val(data.nama);
            $('#edit_pelanggan_nomor_telepon').val(data.nomor_telepon);
            $('#edit_pelanggan_alamat').val(data.alamat);
            $('#editPelangganForm').attr('action', `/pelanggan/${id}`);
            $('#editPelangganModal').modal('show');
        });
    });
    $('#editPelangganForm').on('submit', function(e) { e.preventDefault(); $.ajax({ url: $(this).attr('action'), method: 'POST', data: $(this).serialize(), success: function() { location.reload(); } }); });
    $('.delete-pelanggan-btn').on('click', function() { let id = $(this).data('id'); $('#deletePelangganForm').attr('action', `/pelanggan/${id}`); $('#deletePelangganModal').modal('show'); });
    $('#deletePelangganForm').on('submit', function(e) { e.preventDefault(); $.ajax({ url: $(this).attr('action'), method: 'POST', data: $(this).serialize(), success: function() { location.reload(); } }); });

    // === LOGIKA CRUD SUPPLIER ===
    $('.edit-supplier-btn').on('click', function() {
        let id = $(this).data('id');
        $.get(`/supplier/${id}`, function(data) {
            $('#edit_supplier_nama').val(data.nama);
            $('#edit_supplier_nomor_telepon').val(data.nomor_telepon);
            $('#edit_supplier_alamat').val(data.alamat);
            $('#edit_supplier_produk').val(data.produk_disediakan);
            $('#editSupplierForm').attr('action', `/supplier/${id}`);
            $('#editSupplierModal').modal('show');
        });
    });
    $('#editSupplierForm').on('submit', function(e) { e.preventDefault(); $.ajax({ url: $(this).attr('action'), method: 'POST', data: $(this).serialize(), success: function() { location.reload(); } }); });
    $('.delete-supplier-btn').on('click', function() { let id = $(this).data('id'); $('#deleteSupplierForm').attr('action', `/supplier/${id}`); $('#deleteSupplierModal').modal('show'); });
    $('#deleteSupplierForm').on('submit', function(e) { e.preventDefault(); $.ajax({ url: $(this).attr('action'), method: 'POST', data: $(this).serialize(), success: function() { location.reload(); } }); });
});
</script>
@endpush