<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Tentukan periode default (bulan dan tahun saat ini) jika tidak ada input
        $selectedPeriod = $request->input('periode', Carbon::now()->format('Y-m'));
        $carbonDate = Carbon::createFromFormat('Y-m', $selectedPeriod);
        $year = $carbonDate->year;
        $month = $carbonDate->month;

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

        // 3. Hitung totalnya
        $totalPemasukan = $pemasukans->sum('jumlah');
        $totalPengeluaran = $pengeluarans->sum('jumlah');

        // 4. Hitung Laba / Rugi
        $labaRugi = $totalPemasukan - $totalPengeluaran;

        // 5. Kirim semua data yang sudah diolah ke view
        return view('pages.laporan', [
            'pemasukans' => $pemasukans,
            'pengeluarans' => $pengeluarans,
            'totalPemasukan' => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran,
            'labaRugi' => $labaRugi,
            'selectedPeriod' => $selectedPeriod, // Untuk mengisi kembali value di input filter
        ]);
    }
    public function exportCsv(Request $request)
    {
        $selectedPeriod = $request->input('periode', Carbon::now()->format('Y-m'));
        $carbonDate = Carbon::createFromFormat('Y-m', $selectedPeriod);
        $year = $carbonDate->year;
        $month = $carbonDate->month;
        $periodeFormatted = $carbonDate->isoFormat('MMMM YYYY');

        // Ambil data sama seperti di fungsi index
        $pemasukans = Pemasukan::whereYear('tanggal', $year)->whereMonth('tanggal', $month)->get();
        $pengeluarans = Pengeluaran::whereYear('tanggal', $year)->whereMonth('tanggal', $month)->get();
        $totalPemasukan = $pemasukans->sum('jumlah');
        $totalPengeluaran = $pengeluarans->sum('jumlah');
        $labaRugi = $totalPemasukan - $totalPengeluaran;

        $fileName = 'Laporan Keuangan - ' . $periodeFormatted . '.csv';

        // Header untuk memberitahu browser bahwa ini adalah file CSV yang akan diunduh
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        // Callback untuk menulis data CSV baris per baris
        $callback = function() use($pemasukans, $pengeluarans, $totalPemasukan, $totalPengeluaran, $labaRugi, $periodeFormatted) {
            $file = fopen('php://output', 'w');

            // Judul Laporan
            fputcsv($file, ['Laporan Laba Rugi']);
            fputcsv($file, ['Periode:', $periodeFormatted]);
            fputcsv($file, []); // Baris kosong

            // Ringkasan
            fputcsv($file, ['Total Pemasukan', 'Total Pengeluaran', 'Laba / Rugi']);
            fputcsv($file, [$totalPemasukan, $totalPengeluaran, $labaRugi]);
            fputcsv($file, []); // Baris kosong

            // Rincian Pemasukan
            fputcsv($file, ['Rincian Pemasukan']);
            fputcsv($file, ['Tanggal', 'Keterangan', 'Jumlah']);
            foreach ($pemasukans as $pemasukan) {
                fputcsv($file, [$pemasukan->tanggal, $pemasukan->keterangan, $pemasukan->jumlah]);
            }
            fputcsv($file, []); // Baris kosong

            // Rincian Pengeluaran
            fputcsv($file, ['Rincian Pengeluaran']);
            fputcsv($file, ['Tanggal', 'Keterangan', 'Jumlah']);
            foreach ($pengeluarans as $pengeluaran) {
                fputcsv($file, [$pengeluaran->tanggal, $pengeluaran->keterangan, $pengeluaran->jumlah]);
            }

            fclose($file);
        };

        // Kirim respon ke browser
        return response()->stream($callback, 200, $headers);
    }
}
