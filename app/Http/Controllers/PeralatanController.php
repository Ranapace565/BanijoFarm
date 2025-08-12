<?php
namespace App\Http\Controllers;

use App\Models\Peralatan;
use Illuminate\Http\Request;

class PeralatanController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'jumlah_unit' => 'required|integer|min:0',
            'kondisi' => 'required|in:Baik,Rusak,Perbaikan',
        ]);
        Peralatan::create($request->all());
        return redirect('/stok?tab=peralatan')->with('success', 'Stok peralatan berhasil ditambahkan!');
    }
    public function show($id) { return response()->json(Peralatan::findOrFail($id)); }
    public function update(Request $request, $id) {
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'jumlah_unit' => 'required|integer|min:0',
            'kondisi' => 'required|in:Baik,Rusak,Perbaikan',
        ]);
        Peralatan::findOrFail($id)->update($request->all());
        return response()->json(['success' => 'Stok peralatan berhasil diperbarui!']);
    }
    public function destroy($id) {
        Peralatan::findOrFail($id)->delete();
        return response()->json(['success' => 'Stok peralatan berhasil dihapus!']);
    }
}
