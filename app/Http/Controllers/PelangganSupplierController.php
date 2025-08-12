<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PelangganSupplierController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::latest()->get();
        $suppliers = Supplier::latest()->get();
        return view('pages.pelanggan-supplier', compact('pelanggans', 'suppliers'));
    }
}