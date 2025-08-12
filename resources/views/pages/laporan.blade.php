@extends('layouts.app')
@section('title', 'Laporan Keuangan')

@section('content')
<style>
    /* Mengadopsi style kartu dari dashboard */
    .summary-card {
        border: none;
        border-radius: 0.75rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        padding: 1.5rem;
        transition: transform 0.2s ease;
        background-color: #fff;
    }
    .summary-card:hover {
        transform: translateY(-5px);
    }
    .summary-card-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
    }
    .summary-card-title {
        font-size: 0.9rem;
        font-weight: 600;
        color: #6c757d;
        margin-bottom: 0.25rem;
    }
    .summary-card-value {
        font-size: 1.75rem;
        font-weight: 800;
        color: #343a40;
    }
</style>

    <h1 class="h3 mb-4 text-gray-800" style="font-weight: 700;">Laporan Keuangan</h1>

    <!-- Filter Periode -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('laporan.index') }}" method="GET" class="d-flex align-items-end">
                <div class="me-3">
                    <label for="periode" class="form-label fw-bold">Pilih Periode (Bulan & Tahun)</label>
                    <input type="month" class="form-control" id="periode" name="periode" value="{{ $selectedPeriod }}">
                </div>
                <button type="submit" class="btn btn-primary me-3">Tampilkan Laporan</button>
                <a href="{{ route('laporan.exportCsv', ['periode' => $selectedPeriod]) }}" class="btn btn-success">
                    <i class="bi bi-file-earmark-excel-fill me-2"></i>Ekspor ke Excel (CSV)
                </a>
            </form>
        </div>
    </div>

    <!-- Hasil Laporan -->
    <div class="card shadow-sm border-0">
        <div class="card-header py-3" style="background-color: #f8f9fa;">
            <h6 class="m-0 font-weight-bold text-primary">
                Laporan Laba Rugi untuk Periode: {{ \Carbon\Carbon::createFromFormat('Y-m', $selectedPeriod)->isoFormat('MMMM YYYY') }}
            </h6>
        </div>
        <div class="card-body">
            <div class="row g-4 mb-4">
                <div class="col-lg-4 col-md-6">
                    <div class="summary-card">
                        <div class="d-flex align-items-center">
                            <div class="summary-card-icon bg-success-subtle text-success me-3"><i class="bi bi-arrow-down-circle"></i></div>
                            <div>
                                <div class="summary-card-title">Total Pemasukan</div>
                                <div class="summary-card-value">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="summary-card">
                        <div class="d-flex align-items-center">
                            <div class="summary-card-icon bg-danger-subtle text-danger me-3"><i class="bi bi-arrow-up-circle"></i></div>
                            <div>
                                <div class="summary-card-title">Total Pengeluaran</div>
                                <div class="summary-card-value">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="summary-card">
                        <div class="d-flex align-items-center">
                            <div class="summary-card-icon bg-primary-subtle text-primary me-3"><i class="bi bi-graph-up-arrow"></i></div>
                            <div>
                                <div class="summary-card-title">Laba / Rugi</div>
                                <div class="summary-card-value">Rp {{ number_format($labaRugi, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <!-- Rincian Pemasukan & Pengeluaran -->
            <div class="row">
                <div class="col-lg-6">
                    <h5 class="mb-3 fw-bold">Rincian Pemasukan</h5>
                    <div class="table-responsive">
                        <table class="table table-sm table-striped">
                            <thead><tr><th>Tanggal</th><th>Keterangan</th><th class="text-end">Jumlah</th></tr></thead>
                            <tbody>
                                @forelse ($pemasukans as $pemasukan)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($pemasukan->tanggal)->isoFormat('D MMM') }}</td>
                                        <td>{{ $pemasukan->keterangan }}</td>
                                        <td class="text-end">Rp {{ number_format($pemasukan->jumlah, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="text-center text-muted">Tidak ada pemasukan pada periode ini.</td></tr>
                                @endforelse
                            </tbody>
                            <tfoot class="table-dark">
                                <tr>
                                    <th colspan="2">TOTAL PEMASUKAN</th>
                                    <th class="text-end">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h5 class="mb-3 fw-bold">Rincian Pengeluaran</h5>
                    <div class="table-responsive">
                        <table class="table table-sm table-striped">
                            <thead><tr><th>Tanggal</th><th>Keterangan</th><th class="text-end">Jumlah</th></tr></thead>
                            <tbody>
                                @forelse ($pengeluarans as $pengeluaran)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($pengeluaran->tanggal)->isoFormat('D MMM') }}</td>
                                        <td>{{ $pengeluaran->keterangan }}</td>
                                        <td class="text-end">Rp {{ number_format($pengeluaran->jumlah, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="text-center text-muted">Tidak ada pengeluaran pada periode ini.</td></tr>
                                @endforelse
                            </tbody>
                            <tfoot class="table-dark">
                                <tr>
                                    <th colspan="2">TOTAL PENGELUARAN</th>
                                    <th class="text-end">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
