<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard dengan ringkasan keuangan dan chart bulanan.
     */
    public function index()
    {
        // Total ringkasan
        $totalPemasukan = Keuangan::where('jenis', 'pemasukan')->sum('jumlah') ?? 0;
        $totalPengeluaran = Keuangan::where('jenis', 'pengeluaran')->sum('jumlah') ?? 0;
        $saldo = $totalPemasukan - $totalPengeluaran;

        // Recent transactions (10 terakhir)
        $recentTransactions = Keuangan::orderBy('created_at', 'desc')->take(10)->get();

        // Rentang 6 bulan terakhir (termasuk bulan sekarang)
        $months = [];
        $now = Carbon::now();
        for ($i = 5; $i >= 0; $i--) {
            $m = $now->copy()->subMonths($i);
            $months[] = $m->format('Y-m'); // label untuk grouping (ex: 2025-09)
        }

        // Ambil data pemasukan & pengeluaran grouped per bulan (SQLite compatible using strftime)
        $startDate = Carbon::now()->startOfMonth()->subMonths(5)->toDateString();

        $incomeRaw = Keuangan::selectRaw("strftime('%Y-%m', created_at) as bulan, SUM(jumlah) as total")
            ->where('jenis', 'pemasukan')
            ->where('created_at', '>=', $startDate)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get()
            ->keyBy('bulan');

        $expenseRaw = Keuangan::selectRaw("strftime('%Y-%m', created_at) as bulan, SUM(jumlah) as total")
            ->where('jenis', 'pengeluaran')
            ->where('created_at', '>=', $startDate)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get()
            ->keyBy('bulan');

        // Siapkan array data untuk chart (sesuai urutan $months)
        $chartLabels = [];
        $chartData = []; // pemasukan per bulan
        $chartExpenseData = [];

        $bulanNama = [
            '01' => 'Jan',
            '02' => 'Feb',
            '03' => 'Mar',
            '04' => 'Apr',
            '05' => 'Mei',
            '06' => 'Jun',
            '07' => 'Jul',
            '08' => 'Agu',
            '09' => 'Sep',
            '10' => 'Okt',
            '11' => 'Nov',
            '12' => 'Des',
        ];

        foreach ($months as $m) {
            $parts = explode('-', $m); // [YYYY, MM]
            $label = $bulanNama[$parts[1]] . ' ' . $parts[0];
            $chartLabels[] = $label;

            $chartData[] = isset($incomeRaw[$m]) ? (float)$incomeRaw[$m]->total : 0;
            $chartExpenseData[] = isset($expenseRaw[$m]) ? (float)$expenseRaw[$m]->total : 0;
        }

        // Statistik ringkas: top sumber pemasukan & pengeluaran (keterangan)
        $incomeStats = Keuangan::selectRaw('keterangan, SUM(jumlah) as total')
            ->where('jenis', 'pemasukan')
            ->groupBy('keterangan')
            ->orderByRaw('SUM(jumlah) DESC')
            ->limit(5)
            ->get();

        $expenseStats = Keuangan::selectRaw('keterangan, SUM(jumlah) as total')
            ->where('jenis', 'pengeluaran')
            ->groupBy('keterangan')
            ->orderByRaw('SUM(jumlah) DESC')
            ->limit(5)
            ->get();

        return view('pages.dashboard', compact(
            'totalPemasukan',
            'totalPengeluaran',
            'saldo',
            'recentTransactions',
            'chartLabels',
            'chartData',
            'chartExpenseData',
            'incomeStats',
            'expenseStats'
        ));
    }
}
