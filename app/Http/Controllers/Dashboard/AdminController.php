<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Peserta;

class AdminController extends Controller
{
    public function index() {
        return view('dashboard.index');
    }

    public function peserta() {
        $pesertas = Peserta::orderBy('id', 'desc')->get();
        return view('dashboard.peserta', compact('pesertas'));
    }

    public function pesertaPost(Request $request) {
        $request->validate([
            'name' => 'required|min:5',
            'nomor' => 'required|numeric',
            'sekolah' => 'required|min:5',
            'tinggi' => 'required|numeric',
            'berat' => 'required|numeric'
        ]);
        
        $peserta = new Peserta();
        $peserta->nama = $request->name;
        $peserta->nomor_dada = $request->nomor;
        $peserta->asal_sekolah = $request->sekolah;
        $peserta->tinggi = $request->tinggi;
        $peserta->berat = $request->berat;

        if ($request->alamat) {
            $peserta->alamat = $request->alamat;
        }

        $peserta->save();

        return redirect()->route('admin.peserta')->with('berhasil', 'Berhasil menambahkan peserta baru');
    }
}
