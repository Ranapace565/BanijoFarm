@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<style>
    .summary-card {
        border: none;
        border-radius: 0.75rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        padding: 1.5rem;
        transition: transform 0.2s ease;
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

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 style="font-weight: 800;">Dashboard</h3>
    <span class="text-muted">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM YYYY') }}</span>
</div>

<!-- Kartu Ringkasan Dinamis -->
<div class="row g-4">
    <div class="col-lg-4 col-md-6">
        <div class="summary-card bg-white">
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
        <div class="summary-card bg-white">
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
        <div class="summary-card bg-white">
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

<!-- Grafik dan Aktivitas Terbaru -->
<div class="row g-4 mt-3">
    <div class="col-lg-7">
        <div class="card shadow-sm border-0" style="border-radius: 0.75rem;">
            <div class="card-body">
                <h5 class="card-title fw-bold">Grafik Pemasukan Bulanan</h5>
                <canvas id="pemasukanChart" style="max-height: 300px;"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card shadow-sm border-0" style="border-radius: 0.75rem;">
            <div class="card-body">
                <h5 class="card-title fw-bold">Aktivitas Terbaru</h5>
                <ul class="list-group list-group-flush">
                    @forelse ($recentTransactions as $trx)
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <div class="fw-bold">{{ Str::limit($trx->keterangan, 30) }}</div>
                                {{-- Menggunakan created_at untuk waktu yang lebih akurat --}}
                                <div class="small text-muted">{{ \Carbon\Carbon::parse($trx->created_at)->diffForHumans() }}</div>
                            </div>
                            @if ($trx->jenis == 'Pemasukan')
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
@endsection

@push('scripts')
{{-- JavaScript untuk grafik (tidak ada perubahan) --}}
<script>
document.addEventListener("DOMContentLoaded", function() {
    const ctx = document.getElementById('pemasukanChart').getContext('2d');
    const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul'];
    const data = {
        labels: labels,
        datasets: [{
            label: 'Total Pemasukan',
            data: [15000000, 18000000, 25000000, 22000000, 30000000, 28000000, 35000000],
            borderColor: 'rgba(13, 110, 253, 1)',
            backgroundColor: 'rgba(13, 110, 253, 0.1)',
            fill: true,
            tension: 0.4
        }]
    };
    const config = {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            plugins: { legend: { display: false, } },
            scales: { y: { beginAtZero: true, ticks: { callback: function(value) { return 'Rp ' + (value / 1000000) + ' Jt'; } } } }
        }
    };
    new Chart(ctx, config);
});
</script>
@endpush
