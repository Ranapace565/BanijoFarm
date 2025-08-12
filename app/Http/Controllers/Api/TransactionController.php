<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Carbon\Carbon;

class TransactionController extends Controller
{
    /**
     * Menerima dan menyimpan data pemasukan dari bot Telegram.
     */
    public function storePemasukan(Request $request)
    {
        $validated = $request->validate([
            'jumlah' => 'required|numeric|min:0',
            'keterangan' => 'required|string|max:255',
        ]);

        Pemasukan::create([
            'tanggal' => Carbon::now(),
            'keterangan' => $validated['keterangan'],
            'jumlah' => $validated['jumlah'],
        ]);

        return response()->json([
            'message' => 'Pemasukan berhasil dicatat!'
        ], 201); // 201 = Created
    }

    /**
     * Menerima dan menyimpan data pengeluaran dari bot Telegram.
     */
    public function storePengeluaran(Request $request)
    {
        $validated = $request->validate([
            'jumlah' => 'required|numeric|min:0',
            'keterangan' => 'required|string|max:255',
        ]);

        Pengeluaran::create([
            'tanggal' => Carbon::now(),
            'keterangan' => $validated['keterangan'],
            'jumlah' => $validated['jumlah'],
        ]);

        return response()->json([
            'message' => 'Pengeluaran berhasil dicatat!'
        ], 201);
    }
}
