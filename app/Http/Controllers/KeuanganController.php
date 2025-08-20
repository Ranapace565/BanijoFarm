<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    /**
     * Menampilkan halaman utama Kelola Keuangan dengan filter.
     */
    public function index(Request $request)
    {
        $query = Keuangan::latest(); // Mengambil data dan urutkan dari terbaru

        // Terapkan filter berdasarkan parameter 'jenis' di URL
        if ($request->has('jenis') && in_array($request->jenis, ['pemasukan', 'pengeluaran'])) {
            $query->where('jenis', $request->jenis);
        }

        // Ambil data dengan paginasi
        $keuangan = $query->paginate(10); 
        
        return view('pages.keuangan.index', compact('keuangan'));
    }

    /**
     * Menyimpan data baru yang dikirim via AJAX dari modal.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'jumlah' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string|max:255',
        ]);

        Keuangan::create($request->all());

        return response()->json(['success' => 'Transaksi berhasil ditambahkan.']);
    }

    /**
     * Mengambil data satu transaksi untuk ditampilkan di modal edit (mengembalikan JSON).
     */
    public function edit(Keuangan $keuangan)
    {
        return response()->json($keuangan);
    }

    /**
     * Mengupdate data yang dikirim via AJAX dari modal edit (mengembalikan JSON).
     */
    public function update(Request $request, Keuangan $keuangan)
    {
        $request->validate([
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'jumlah' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $keuangan->update($request->all());

        return response()->json(['success' => 'Transaksi berhasil diperbarui.']);
    }

    /**
     * Menghapus data transaksi.
     */
    public function destroy(Keuangan $keuangan)
    {
        $keuangan->delete();
        return redirect()->back()->with('success', 'Transaksi berhasil dihapus.');
    }
}