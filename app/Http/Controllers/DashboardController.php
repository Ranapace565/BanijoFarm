<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman utama dashboard dengan data ringkasan dari Firestore.
     */
    public function dashboard()
    {
        // 3. Inisialisasi Firestore
        $firestore = Firebase::firestore();
        $transaksiCollection = $firestore->database()->collection('transaksi');

        // 4. Hitung total pemasukan dari koleksi 'transaksi'
        $pemasukanQuery = $transaksiCollection->where('tipe', '==', 'pemasukan');
        $pemasukanDocs = $pemasukanQuery->documents();
        $totalPemasukan = 0;
        foreach ($pemasukanDocs as $doc) {
            $totalPemasukan += $doc->data()['jumlah'] ?? 0;
        }

        // 5. Hitung total pengeluaran dari koleksi 'transaksi'
        $pengeluaranQuery = $transaksiCollection->where('tipe', '==', 'pengeluaran');
        $pengeluaranDocs = $pengeluaranQuery->documents();
        $totalPengeluaran = 0;
        foreach ($pengeluaranDocs as $doc) {
            $totalPengeluaran += $doc->data()['jumlah'] ?? 0;
        }

        // 6. Hitung saldo saat ini (logika ini tetap sama)
        $saldo = $totalPemasukan - $totalPengeluaran;

        // 7. Ambil 5 transaksi terbaru (query ini menjadi lebih simpel di Firestore)
        $recentQuery = $transaksiCollection->orderBy('tanggal', 'DESC')->limit(5);
        $recentDocuments = $recentQuery->documents();

        $recentTransactions = [];
        foreach ($recentDocuments as $document) {
            if ($document->exists()) {
                $data = $document->data();

                // Menyesuaikan format agar kompatibel dengan view yang ada
                $data['jenis'] = ucfirst($data['tipe'] ?? 'transaksi');

                // Format tanggal agar bisa dibaca di view
                $timestamp = $data['tanggal'] ?? null;
                $data['created_at'] = $timestamp ? Carbon::parse($timestamp->formatAsString()) : now();

                // Kita ubah array menjadi objek agar di view bisa dipanggil seperti $item->jenis
                $recentTransactions[] = (object)$data;
            }
        }

        // 8. Kirim semua data ke view
        return view('pages.dashboard', [
            'totalPemasukan' => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran,
            'saldo' => $saldo,
            'recentTransactions' => $recentTransactions
        ]);
    }

    // --- Fungsi untuk halaman lain (tidak perlu diubah) ---
    public function pemasukan()
    {
        return view('pages.pemasukan');
    }
    public function pengeluaran()
    {
        return view('pages.pengeluaran');
    }
    public function stok()
    {
        return view('pages.stok');
    }
    public function pelangganSupplier()
    {
        return view('pages.pelanggan-supplier');
    }
    public function laporan()
    {
        return view('pages.laporan');
    }
    public function notifikasi()
    {
        return view('pages.notifikasi');
    }
}
