<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran; 
use App\Models\Pakan;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function index()
    {
        $pengeluarans = Pengeluaran::latest()->get();
        $pakans = Pakan::all();
        return view('pages.pengeluaran', compact('pengeluarans', 'pakans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
            'pakan_id' => 'nullable|exists:pakans,id', 
            'jumlah_pembelian' => 'nullable|numeric|min:0'
        ]);
        Pengeluaran::create($request->all());
        if ($request->has('pakan_id') && $request->pakan_id != '' && $request->has('jumlah_pembelian')) {
            $pakan = Pakan::find($request->pakan_id);
            if ($pakan) {
                $pakan->jumlah_stok += $request->jumlah_pembelian;
                $pakan->save();
            }
        }
        return redirect('/pengeluaran')->with('success', 'Data pengeluaran berhasil ditambahkan!');
    }

    public function show($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        return response()->json($pengeluaran);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
        ]);
        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->update($request->all());
        return response()->json(['success' => 'Data pengeluaran berhasil diperbarui!']);
    }

    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->delete();
        return response()->json(['success' => 'Data pengeluaran berhasil dihapus!']);
    }
}