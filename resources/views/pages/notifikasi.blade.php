@extends('layouts.app')
@section('title', 'Pengingat & Notifikasi')

@section('content')
    <h1 class="h3 mb-4 text-gray-800" style="font-weight: 700;">Pengingat & Notifikasi</h1>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h5 class="card-title">Daftar Notifikasi</h5>
            <ul class="list-group">
                <li class="list-group-item">Stok "Pupuk Kandang" hampir habis.</li>
                <li class="list-group-item">Jatuh tempo pembayaran ke Supplier A dalam 3 hari.</li>
                <li class="list-group-item">Laporan keuangan bulan Juli 2025 berhasil dibuat.</li>
            </ul>
            <p class="card-text mt-3">Halaman ini akan menampilkan semua notifikasi penting dan pengaturan untuk pengingat otomatis (misal: pengingat stok minimum, jatuh tempo hutang/piutang).</p>
        </div>
    </div>
@endsection