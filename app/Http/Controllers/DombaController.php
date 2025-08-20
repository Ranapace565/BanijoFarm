<?php

namespace App\Http\Controllers;

use App\Models\Domba;
use App\Models\Keuangan; // <-- Tambahkan ini untuk mengakses tabel keuangan
use Illuminate\Http\Request;

class DombaController extends Controller
{
    /**
     * Menampilkan daftar semua domba (halaman utama stok).
     */
    public function index()
    {
        $dombas = Domba::latest()->paginate(10);
        return view('pages.domba.index', compact('dombas'));
    }

    /**
     * Menampilkan form untuk menambah domba baru.
     */
    public function create()
    {
        return view('pages.domba.create');
    }

    /**
     * Menyimpan data domba baru ke database.
     */
    public function store(Request $request)
    {
        // 'harga' di sini adalah harga beli
        $request->validate([
            'jenis' => 'required|string|max:100',
            'umur' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'status' => 'required|in:tersedia,terjual,mati',
            'keterangan' => 'nullable|string',
        ]);

        Domba::create($request->all());

        return redirect()->route('domba.index')
                         ->with('success', 'Data domba baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data domba.
     */
    public function edit(Domba $domba)
    {
        return view('pages.domba.edit', compact('domba'));
    }

    /**
     * PERBAIKAN UTAMA: Mengupdate data domba dan otomatis mencatat pemasukan.
     */
    public function update(Request $request, Domba $domba)
    {
        $request->validate([
            'jenis' => 'required|string|max:100',
            'umur' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0', // Ini harga beli
            'status' => 'required|in:tersedia,terjual,mati',
            'keterangan' => 'nullable|string',
            // Tambahkan validasi untuk harga jual jika statusnya 'terjual'
            'harga_jual' => 'required_if:status,terjual|nullable|numeric|min:0',
        ]);

        $statusLama = $domba->status; // Simpan status lama sebelum diupdate

        // Update data domba dengan data dari form (jenis, umur, harga beli, dll)
        $domba->update($request->except('harga_jual'));

        // Logika Otomatis: Cek apakah status berubah menjadi 'terjual'
        if ($statusLama != 'terjual' && $request->status == 'terjual') {
            
            // Buat catatan pemasukan baru dari harga jual
            Keuangan::create([
                'jenis' => 'pemasukan',
                'jumlah' => $request->harga_jual, // Ambil dari input harga jual
                'keterangan' => "Penjualan domba ID #{$domba->id} - {$domba->jenis}",
            ]);

            // Set pesan sukses yang lebih informatif
            $pesanSukses = 'Data domba berhasil diperbarui DAN pemasukan otomatis dicatat.';
        } else {
            $pesanSukses = 'Data domba berhasil diperbarui.';
        }

        return redirect()->route('domba.index')->with('success', $pesanSukses);
    }

    /**
     * Menghapus data domba dari database.
     */
    public function destroy(Domba $domba)
    {
        $domba->delete();

        return redirect()->route('domba.index')
                         ->with('success', 'Data domba berhasil dihapus.');
    }
}