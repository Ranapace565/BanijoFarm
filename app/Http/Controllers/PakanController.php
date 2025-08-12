<?php
namespace App\Http\Controllers;
use App\Models\Pakan;
use Illuminate\Http\Request;
class PakanController extends Controller {
    public function store(Request $request) {
        $request->validate(['nama_pakan' => 'required', 'jumlah_stok' => 'required|numeric', 'satuan' => 'required', 'tanggal_masuk' => 'required|date']);
        Pakan::create($request->all());
        return redirect('/stok?tab=pakan')->with('success', 'Stok pakan berhasil ditambahkan!');
    }
    public function show($id) { return response()->json(Pakan::findOrFail($id)); }
    public function update(Request $request, $id) {
        $request->validate(['nama_pakan' => 'required', 'jumlah_stok' => 'required|numeric', 'satuan' => 'required', 'tanggal_masuk' => 'required|date']);
        Pakan::findOrFail($id)->update($request->all());
        return response()->json(['success' => 'Stok pakan diperbarui!']);
    }
    public function destroy($id) {
        Pakan::findOrFail($id)->delete();
        return response()->json(['success' => 'Stok pakan dihapus!']);
    }
}
