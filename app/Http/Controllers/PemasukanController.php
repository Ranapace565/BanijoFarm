<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Domba;
use Illuminate\Http\Request;

class PemasukanController extends Controller
{
    public function index()
    {
        $pemasukans = Pemasukan::latest()->get();
        $dombasSiapJual = Domba::where('status', 'Siap Jual')->get();
        return view('pages.pemasukan', compact('pemasukans', 'dombasSiapJual'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
            'domba_id' => 'nullable|exists:dombas,id'
        ]);

        Pemasukan::create($request->all());

        if ($request->filled('domba_id')) {
            $domba = Domba::find($request->domba_id);
            if ($domba) {
                $domba->status = 'Terjual';
                $domba->save();
            }
        }
        return redirect('/pemasukan')->with('success', 'Data pemasukan berhasil ditambahkan!');
    }

    public function show($id)
    {
        $pemasukan = Pemasukan::findOrFail($id);
        return response()->json($pemasukan);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
        ]);
        $pemasukan = Pemasukan::findOrFail($id);
        $pemasukan->update($request->all());
        return response()->json(['success' => 'Data pemasukan berhasil diperbarui!']);
    }

    public function destroy($id)
    {
        $pemasukan = Pemasukan::findOrFail($id);
        $pemasukan->delete();
        return response()->json(['success' => 'Data pemasukan berhasil dihapus!']);
    }
}
