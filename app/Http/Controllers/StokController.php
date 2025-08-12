<?php
namespace App\Http\Controllers;
use App\Models\Domba;
use App\Models\Pakan;
use App\Models\Obat;
use App\Models\Peralatan;
class StokController extends Controller {
    public function index() {
        $dombas = Domba::latest()->get();
        $pakans = Pakan::latest()->get();
        $obats = Obat::latest()->get();
        $peralatans = Peralatan::latest()->get();
        return view('pages.stok', compact('dombas', 'pakans', 'obats', 'peralatans'));
    }
}