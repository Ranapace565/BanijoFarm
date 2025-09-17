<?php

namespace App\Http\Controllers;

use App\Models\Domba;
use App\Models\DombaPertumbuhan;
use App\Models\Keuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DombaController extends Controller
{
    public function index()
    {
        $dombas = Domba::with('pertumbuhan')->latest()->paginate(10);
        return view('pages.domba.index', compact('dombas'));
    }

    public function create()
    {
        return view('pages.domba.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // Data kelahiran
            'jenis' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'jam_lahir' => 'nullable|date_format:H:i',
            'induk' => 'nullable|string|max:100',
            'jantan' => 'nullable|string|max:100',
            'gender' => 'nullable|in:jantan,betina',
            'nama' => 'nullable|string|max:100',
            'bb_lahir' => 'nullable|numeric|min:0',

            // Status domba
            'status' => 'required|in:tersedia,terjual,mati',
            'keterangan' => 'nullable|string',

            // Data kematian
            'tanggal_kematian' => 'nullable|date',
            'no_tag' => 'nullable|string|max:50|unique:domba,no_tag',
            'penyebab_kematian' => 'nullable|string|max:255',
        ]);

        $domba = Domba::create($validated);

        return redirect()->route('domba.index')->with('success', 'Data domba berhasil ditambahkan.');
    }

    public function edit(Domba $domba)
    {
        $domba->load('pertumbuhan');

        // Kalau request dari AJAX, kembalikan JSON
        if (request()->ajax()) {
            return response()->json($domba);
        }

        return response()->json($domba);
    }


    public function update(Request $request, Domba $domba)
    {
        // dd();
        $validated = $request->validate([
            'jenis' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'jam_lahir' => 'nullable|date_format:H:i',
            'induk' => 'nullable|string|max:100',
            'jantan' => 'nullable|string|max:100',
            'gender' => 'nullable|in:jantan,betina',
            'nama' => 'nullable|string|max:100',
            'bb_lahir' => 'nullable|numeric|min:0',

            'status' => 'nullable|in:tersedia,terjual,mati',
            'keterangan' => 'nullable|string',

            'tanggal_kematian' => 'nullable|date',
            'no_tag' => 'nullable|string|max:50|unique:domba,no_tag,' . $domba->id,
            'penyebab_kematian' => 'nullable|string|max:255',

            // 'harga_jual' => 'nullable_if:status,terjual|nullable|numeric|min:0',
        ]);

        $statusLama = $domba->status;
        $domba->update(collect($validated)->except('harga_jual')->toArray());

        // if ($statusLama != 'terjual' && $validated['status'] === 'terjual' && $request->filled('harga_jual')) {
        //     Keuangan::create([
        //         'jenis' => 'pemasukan',
        //         'jumlah' => $request->harga_jual,
        //         'keterangan' => "Penjualan domba ID #{$domba->id} - {$domba->jenis}",
        //     ]);
        // }

        return redirect()->route('domba.index')->with('success', 'Data domba berhasil diperbarui.');
    }


    public function destroy(Domba $domba)
    {
        $domba->delete();
        return redirect()->route('domba.index')->with('success', 'Data domba berhasil dihapus.');
    }
}
