<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
// Model Domba sudah dihapus dari sini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // --- Data Kartu Ringkasan Keuangan ---
        $totalPemasukan = Keuangan::where('jenis', 'pemasukan')->sum('jumlah');
        $totalPengeluaran = Keuangan::where('jenis', 'pengeluaran')->sum('jumlah');
        $saldo = $totalPemasukan - $totalPengeluaran;
        
        // --- Data Grafik Garis (Pemasukan Bulanan) ---
        $chartDataRaw = Keuangan::select(
                DB::raw("DATE_FORMAT(created_at, '%b') as bulan"),
                DB::raw('SUM(jumlah) as total')
            )
            ->where('jenis', 'pemasukan')
            ->where('created_at', '>=', Carbon::now()->subMonths(5))
            ->groupBy('bulan')
            ->orderByRaw('MIN(created_at)')
            ->get();
            
        $chartLabels = $chartDataRaw->pluck('bulan');
        $chartData = $chartDataRaw->pluck('total');

        // --- Aktivitas Terbaru ---
        $recentTransactions = Keuangan::latest()->take(5)->get();

        // --- Data Pie Chart Pemasukan ---
        $incomeStats = Keuangan::select('keterangan', DB::raw('SUM(jumlah) as total'))
            ->where('jenis', 'pemasukan')->whereNotNull('keterangan')->where('keterangan', '!=', '')
            ->groupBy('keterangan')->orderBy('total', 'desc')->take(5)->get();

        // --- Data Pie Chart Pengeluaran ---
        $expenseStats = Keuangan::select('keterangan', DB::raw('SUM(jumlah) as total'))
            ->where('jenis', 'pengeluaran')->whereNotNull('keterangan')->where('keterangan', '!=', '')
            ->groupBy('keterangan')->orderBy('total', 'desc')->take(5)->get();

        // --- Kirim semua variabel ke view ---
        return view('pages.dashboard', compact(
            'totalPemasukan',
            'totalPengeluaran',
            'saldo',
            // 'stokDomba' sudah dihapus
            'recentTransactions',
            'chartLabels',
            'chartData',
            'incomeStats',
            'expenseStats'
        ));
    }
}