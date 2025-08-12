<?php
namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'fungsi' => 'required|string|max:255',
            'jumlah_stok' => 'required|numeric|min:0',
            'satuan' => 'required|string|max:50',
        ]);
        Obat::create($request->all());
        return redirect('/stok?tab=obat')->with('success', 'Stok obat berhasil ditambahkan!');
    }
    public function show($id) { return response()->json(Obat::findOrFail($id)); }
    public function update(Request $request, $id) {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'fungsi' => 'required|string|max:255',
            'jumlah_stok' => 'required|numeric|min:0',
            'satuan' => 'required|string|max:50',
        ]);
        Obat::findOrFail($id)->update($request->all());
        return response()->json(['success' => 'Stok obat berhasil diperbarui!']);
    }
    public function destroy($id) {
        Obat::findOrFail($id)->delete();
        return response()->json(['success' => 'Stok obat berhasil dihapus!']);
    }
}