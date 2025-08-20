@extends('layouts.app')
@section('title', 'Dashboard Keuangan')

@section('content')
{{-- Style khusus untuk kartu ringkasan --}}
<style>
    .summary-card {
        border: none;
        border-radius: 0.75rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease;
    }
    .summary-card:hover {
        transform: translateY(-5px);
    }
    .summary-card-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    .summary-card-title {
        font-size: 0.9rem;
        font-weight: 600;
        color: #6c757d;
        margin-bottom: 0.25rem;
    }
    .summary-card-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: #343a40;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 style="font-weight: 800;">Dashboard Keuangan</h3>
    <span class="text-muted">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM YYYY') }}</span>
</div>

<div class="row g-4">
    <div class="col-lg-4 col-md-6">
        <div class="summary-card bg-white p-3">
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
        <div class="summary-card bg-white p-3">
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
        <div class="summary-card bg-white p-3">
            <div class="d-flex align-items-center">
                <div class="summary-card-icon bg-primary-subtle text-primary me-3"><i class="bi bi-wallet2"></i></div>
                <div>
                    <div class="summary-card-title">Saldo Saat Ini</div>
                    <div class="summary-card-value">Rp {{ number_format($saldo, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mt-3">
    <div class="col-lg-7">
        <div class="card shadow-sm border-0 h-100" style="border-radius: 0.75rem;">
            <div class="card-body">
                <h5 class="card-title fw-bold">Grafik Pemasukan Bulanan</h5>
                <canvas id="pemasukanLineChart" style="max-height: 350px;"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card shadow-sm border-0 h-100" style="border-radius: 0.75rem;">
            <div class="card-body">
                <h5 class="card-title fw-bold">Aktivitas Terbaru</h5>
                <ul class="list-group list-group-flush">
                    @forelse ($recentTransactions as $trx)
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <div class="fw-bold">{{ Str::limit($trx->keterangan, 30) }}</div>
                                <div class="small text-muted">{{ \Carbon\Carbon::parse($trx->created_at)->diffForHumans() }}</div>
                            </div>
                            @if ($trx->jenis == 'pemasukan')
                                <span class="badge bg-success-subtle text-success rounded-pill">+ Rp {{ number_format($trx->jumlah, 0, ',', '.') }}</span>
                            @else
                                <span class="badge bg-danger-subtle text-danger rounded-pill">- Rp {{ number_format($trx->jumlah, 0, ',', '.') }}</span>
                            @endif
                        </li>
                    @empty
                        <li class="list-group-item px-0 text-muted">Belum ada aktivitas.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mt-3">
     <div class="col-lg-6">
        <div class="card shadow-sm border-0 h-100" style="border-radius: 0.75rem;">
            <div class="card-body">
                <h5 class="card-title fw-bold">Sumber Pemasukan</h5>
                <canvas id="pemasukanPieChart" style="max-height: 300px;"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card shadow-sm border-0 h-100" style="border-radius: 0.75rem;">
            <div class="card-body">
                <h5 class="card-title fw-bold">Kategori Pengeluaran</h5>
                <canvas id="pengeluaranPieChart" style="max-height: 300px;"></canvas>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {

    // --- 1. GRAFIK GARIS PEMASUKAN BULANAN ---
    const lineCtx = document.getElementById('pemasukanLineChart').getContext('2d');
    const lineLabels = @json($chartLabels);
    const lineData = @json($chartData);
    new Chart(lineCtx, {
        type: 'line',
        data: {
            labels: lineLabels,
            datasets: [{
                label: 'Total Pemasukan',
                data: lineData,
                borderColor: 'rgba(25, 135, 84, 1)',
                backgroundColor: 'rgba(25, 135, 84, 0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, ticks: { callback: function(value) { return 'Rp ' + (value / 1000000) + ' Jt'; } } } }
        }
    });

    // --- 2. GRAFIK PIE SUMBER PEMASUKAN ---
    const pemasukanPieCtx = document.getElementById('pemasukanPieChart').getContext('2d');
    const incomeStatsData = @json($incomeStats);
    new Chart(pemasukanPieCtx, {
        type: 'pie',
        data: {
            labels: incomeStatsData.map(d => d.keterangan),
            datasets: [{
                label: 'Pemasukan',
                data: incomeStatsData.map(d => d.total),
                backgroundColor: ['#198754', '#17a2b8', '#ffc107', '#6f42c1', '#fd7e14'],
            }]
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'top' } } }
    });
    
    // --- 3. GRAFIK PIE KATEGORI PENGELUARAN ---
    const pengeluaranPieCtx = document.getElementById('pengeluaranPieChart').getContext('2d');
    const expenseStatsData = @json($expenseStats);
    new Chart(pengeluaranPieCtx, {
        type: 'pie',
        data: {
            labels: expenseStatsData.map(d => d.keterangan),
            datasets: [{
                label: 'Pengeluaran',
                data: expenseStatsData.map(d => d.total),
                backgroundColor: ['#dc3545', '#6c757d', '#fd7e14', '#ffc107', '#0dcaf0'],
            }]
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'top' } } }
    });

});
</script>
@endpush