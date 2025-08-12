<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function store(Request $request) {
        $request->validate(['nama' => 'required|string|max:255']);
        Supplier::create($request->all());
        return redirect('/pelanggan-supplier')->with('success', 'Supplier baru berhasil ditambahkan!');
    }
    public function show($id) { return response()->json(Supplier::findOrFail($id)); }
    public function update(Request $request, $id) {
        $request->validate(['nama' => 'required|string|max:255']);
        Supplier::findOrFail($id)->update($request->all());
        return response()->json(['success' => 'Data supplier berhasil diperbarui!']);
    }
    public function destroy($id) {
        Supplier::findOrFail($id)->delete();
        return response()->json(['success' => 'Data supplier berhasil dihapus!']);
    }
}