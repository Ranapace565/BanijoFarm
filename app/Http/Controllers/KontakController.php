<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    /**
     * Menampilkan halaman utama dengan filter pelanggan/supplier.
     */
    public function index(Request $request)
    {
        $query = Kontak::latest();

        if ($request->has('jenis') && in_array($request->jenis, ['pelanggan', 'supplier'])) {
            $query->where('jenis', $request->jenis);
        }

        $kontaks = $query->paginate(10);
        return view('pages.kontak.index', compact('kontaks'));
    }

    /**
     * Menyimpan data kontak baru (via AJAX).
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:200',
            'no_hp' => 'nullable|string|max:50',
            'jenis' => 'required|in:pelanggan,supplier',
            'keterangan' => 'nullable|string',
        ]);

        Kontak::create($request->all());

        return response()->json(['success' => 'Kontak berhasil ditambahkan.']);
    }

    /**
     * Mengambil data kontak untuk modal edit (via AJAX).
     */
    public function edit(Kontak $kontak)
    {
        return response()->json($kontak);
    }

    /**
     * Mengupdate data kontak (via AJAX).
     */
    public function update(Request $request, Kontak $kontak)
    {
        $request->validate([
            'nama' => 'required|string|max:200',
            'no_hp' => 'nullable|string|max:50',
            'jenis' => 'required|in:pelanggan,supplier',
            'keterangan' => 'nullable|string',
        ]);

        $kontak->update($request->all());

        return response()->json(['success' => 'Kontak berhasil diperbarui.']);
    }

    /**
     * Menghapus data kontak.
     */
    public function destroy(Kontak $kontak)
    {
        $kontak->delete();
        return redirect()->back()->with('success', 'Kontak berhasil dihapus.');
    }
}