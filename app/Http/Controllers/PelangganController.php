<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function store(Request $request) {
        $request->validate(['nama' => 'required|string|max:255']);
        Pelanggan::create($request->all());
        return redirect('/pelanggan-supplier')->with('success', 'Pelanggan baru berhasil ditambahkan!');
    }
    public function show($id) { return response()->json(Pelanggan::findOrFail($id)); }
    public function update(Request $request, $id) {
        $request->validate(['nama' => 'required|string|max:255']);
        Pelanggan::findOrFail($id)->update($request->all());
        return response()->json(['success' => 'Data pelanggan berhasil diperbarui!']);
    }
    public function destroy($id) {
        Pelanggan::findOrFail($id)->delete();
        return response()->json(['success' => 'Data pelanggan berhasil dihapus!']);
    }
}