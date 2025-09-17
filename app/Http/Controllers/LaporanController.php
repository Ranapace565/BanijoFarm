<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $periode = $request->input('periode', 'semua');
        $query = Keuangan::latest();

<<<<<<< HEAD
        $tanggalMulai = null;
        $tanggalSelesai = Carbon::now()->endOfDay();
=======
        // 1. Ambil semua data pemasukan untuk periode yang dipilih
        $pemasukans = Pemasukan::whereYear('tanggal', $year)
            ->whereMonth('tanggal', $month)
            ->orderBy('tanggal', 'asc')
            ->get();

        // 2. Ambil semua data pengeluaran untuk periode yang dipilih
        $pengeluarans = Pengeluaran::whereYear('tanggal', $year)
            ->whereMonth('tanggal', $month)
            ->orderBy('tanggal', 'asc')
            ->get();
>>>>>>> 39970ab37613c46089147a22a64bdd68eec6d1a2

        switch ($periode) {
            case 'harian':
                $tanggalMulai = Carbon::now()->startOfDay();
                $judul = 'Laporan Harian';
                break;
            case 'mingguan':
                $tanggalMulai = Carbon::now()->subDays(7)->startOfDay();
                $judul = 'Laporan Minggu Ini';
                break;
            case 'bulanan':
                $tanggalMulai = Carbon::now()->startOfMonth();
                $judul = 'Laporan Bulan Ini';
                break;
            default:
                $judul = 'Laporan Keseluruhan';
                break;
        }

        if ($tanggalMulai) {
            $query->whereBetween('created_at', [$tanggalMulai, $tanggalSelesai]);
        }

        // Ambil data transaksi untuk ditampilkan di tabel
        $transaksis = (clone $query)->paginate(15);

        // PERBAIKAN LOGIKA: Gunakan clone query untuk setiap perhitungan agar tidak saling tumpuk
        $totalPemasukan = (clone $query)->where('jenis', 'pemasukan')->sum('jumlah');
        $totalPengeluaran = (clone $query)->where('jenis', 'pengeluaran')->sum('jumlah');
        $saldo = $totalPemasukan - $totalPengeluaran;

        return view('pages.laporan.index', compact(
            'transaksis', 
            'totalPemasukan', 
            'totalPengeluaran', 
            'saldo',
            'judul',
            'periode'
        ));
    }

    /**
     * DIHAPUS: Fungsi duplikat yang lama sudah dihapus.
     * Hanya fungsi di bawah ini yang digunakan.
     */
    public function export(Request $request)
    {
        $periode = $request->input('periode', 'semua');
        $tanggal = Carbon::now()->format('Y-m-d');
        $fileName = "laporan-keuangan-{$periode}-{$tanggal}.csv";

        // Ambil data dari database dengan logika filter yang sama seperti di method index()
        $query = Keuangan::query();
        $tanggalMulai = null;
        $tanggalSelesai = Carbon::now()->endOfDay();

        switch ($periode) {
            case 'harian':
                $tanggalMulai = Carbon::now()->startOfDay();
                break;
            case 'mingguan':
                $tanggalMulai = Carbon::now()->subDays(7)->startOfDay();
                break;
            case 'bulanan':
                $tanggalMulai = Carbon::now()->startOfMonth();
                break;
        }

        if ($tanggalMulai) {
            $query->whereBetween('created_at', [$tanggalMulai, $tanggalSelesai]);
        }
        
        $transaksis = $query->latest()->get(); // Ambil semua data yang terfilter

        // Siapkan header untuk file CSV dan browser
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

<<<<<<< HEAD
        // Buat file CSV di memori
        $callback = function() use($transaksis) {
=======
        // Callback untuk menulis data CSV baris per baris
        $callback = function () use ($pemasukans, $pengeluarans, $totalPemasukan, $totalPengeluaran, $labaRugi, $periodeFormatted) {
>>>>>>> 39970ab37613c46089147a22a64bdd68eec6d1a2
            $file = fopen('php://output', 'w');

            // Tulis baris header
            fputcsv($file, ['ID', 'Tanggal', 'Jenis', 'Jumlah (Rp)', 'Keterangan']);

            // Tulis setiap baris data
            foreach ($transaksis as $trx) {
                fputcsv($file, [
                    $trx->id,
                    $trx->created_at->format('d-m-Y H:i'),
                    ucfirst($trx->jenis),
                    $trx->jumlah,
                    $trx->keterangan
                ]);
            }

            fclose($file);
        };

        // Kirim file CSV ke browser untuk di-download
        return response()->stream($callback, 200, $headers);
    }
}