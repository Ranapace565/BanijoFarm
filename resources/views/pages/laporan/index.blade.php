@extends('layouts.app')
@section('title', 'Laporan Keuangan')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 style="font-weight: 800;">Laporan Keuangan</h3>
        <div>
            <a href="{{ route('laporan.export', ['periode' => $periode]) }}" class="btn btn-outline-success">
                <i class="bi bi-file-earmark-excel me-2"></i>Ekspor
            </a>
            <button onclick="window.print()" class="btn btn-outline-secondary">
                <i class="bi bi-printer me-2"></i>Cetak
            </button>
        </div>
    </div>

    {{-- Filter Periode --}}
    <div class="mb-3">
        <a href="{{ route('laporan.index', ['periode' => 'harian']) }}" class="btn btn-sm {{ $periode == 'harian' ? 'btn-primary' : 'btn-light' }}">Hari Ini</a>
        <a href="{{ route('laporan.index', ['periode' => 'mingguan']) }}" class="btn btn-sm {{ $periode == 'mingguan' ? 'btn-primary' : 'btn-light' }}">Minggu Ini</a>
        <a href="{{ route('laporan.index', ['periode' => 'bulanan']) }}" class="btn btn-sm {{ $periode == 'bulanan' ? 'btn-primary' : 'btn-light' }}">Bulan Ini</a>
        <a href="{{ route('laporan.index', ['periode' => 'semua']) }}" class="btn btn-sm {{ $periode == 'semua' ? 'btn-primary' : 'btn-light' }}">Semua</a>
    </div>

    {{-- Kartu Ringkasan Sesuai Periode --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white border-0">
            <h5 class="mb-0 fw-bold">{{ $judul }}</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <h6 class="text-muted">Total Pemasukan</h6>
                    <h4 class="fw-bold text-success">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</h4>
                </div>
                <div class="col-md-4">
                    <h6 class="text-muted">Total Pengeluaran</h6>
                    <h4 class="fw-bold text-danger">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h4>
                </div>
                <div class="col-md-4">
                    <h6 class="text-muted">Saldo Periode Ini</h6>
                    <h4 class="fw-bold text-primary">Rp {{ number_format($saldo, 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Tabel Detail Transaksi --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h5 class="card-title fw-bold mb-3">Detail Transaksi</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Tanggal</th>
                            <th>Jenis</th>
                            <th>Keterangan</th>
                            <th class="text-end">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transaksis as $trx)
                        <tr>
                            <td><strong>#{{ $trx->id }}</strong></td>
                            <td>{{ $trx->created_at->format('d M Y, H:i') }}</td>
                            <td>
                                @if($trx->jenis == 'pemasukan')
                                    <span class="badge bg-success-subtle text-success">Pemasukan</span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger">Pengeluaran</span>
                                @endif
                            </td>
                            <td>{{ $trx->keterangan }}</td>
                            <td class="text-end fw-bold {{ $trx->jenis == 'pemasukan' ? 'text-success' : 'text-danger' }}">
                                Rp {{ number_format($trx->jumlah, 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">Tidak ada transaksi pada periode ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $transaksis->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
@endsection