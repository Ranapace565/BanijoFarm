<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasukan;
use App\Models\Pengeluaran; // Pastikan model Pengeluaran sudah di-import

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman utama dashboard dengan data ringkasan yang dinamis.
     */
    public function dashboard()
    {
        // 1. Ambil total pemasukan dari database
        $totalPemasukan = Pemasukan::sum('jumlah');

        // 2. Ambil total pengeluaran dari database secara dinamis
        $totalPengeluaran = Pengeluaran::sum('jumlah');

        // 3. Hitung saldo saat ini secara otomatis
        $saldo = $totalPemasukan - $totalPengeluaran;

        // 4. Menggabungkan data pemasukan dan pengeluaran untuk aktivitas terbaru
        // Tambahkan kolom 'jenis' untuk membedakan di view
        $pemasukans = Pemasukan::latest()->get()->map(function ($item) {
            $item->jenis = 'Pemasukan';
            return $item;
        });

        $pengeluarans = Pengeluaran::latest()->get()->map(function ($item) {
            $item->jenis = 'Pengeluaran';
            return $item;
        });

        // Gabungkan kedua koleksi, urutkan berdasarkan tanggal dibuat, dan ambil 5 yang terbaru
        $recentTransactions = $pemasukans->merge($pengeluarans)
            ->sortByDesc('created_at')
            ->take(5);

        // 5. Kirim semua data yang sudah dinamis ke view
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
