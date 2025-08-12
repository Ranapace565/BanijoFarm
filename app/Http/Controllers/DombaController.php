<?php

namespace App\Http\Controllers;

use App\Models\Domba;
use Illuminate\Http\Request;

class DombaController extends Controller
{
    public function index()
    {
        $dombas = Domba::latest()->get();
        return view('pages.stok', compact('dombas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_domba' => 'required|string|max:255|unique:dombas,kode_domba',
            'jenis_kelamin' => 'required|in:Jantan,Betina',
            'usia' => 'nullable|string|max:100', // <-- VALIDASI BARU
            'tanggal_masuk' => 'required|date',
        ]);
        Domba::create($request->all());
        return redirect('/stok')->with('success', 'Data domba baru berhasil ditambahkan!');
    }

    public function show($id)
    {
        $domba = Domba::findOrFail($id);
        return response()->json($domba);
    }

    public function update(Request $request, $id)
    {
        $domba = Domba::findOrFail($id);
        $request->validate([
            'kode_domba' => 'required|string|max:255|unique:dombas,kode_domba,' . $domba->id,
            'jenis_kelamin' => 'required|in:Jantan,Betina',
            'usia' => 'nullable|string|max:100', // <-- VALIDASI BARU
            'tanggal_masuk' => 'required|date',
        ]);
        $domba->update($request->all());
        return response()->json(['success' => 'Data domba berhasil diperbarui!']);
    }

    public function destroy($id)
    {
        $domba = Domba::findOrFail($id);
        $domba->delete();
        return response()->json(['success' => 'Data domba berhasil dihapus!']);
    }
}
