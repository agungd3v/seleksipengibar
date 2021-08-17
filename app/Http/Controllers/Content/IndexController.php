<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Materi;
use App\Penilaian;
use App\Peserta;
use App\Rekapnilai;

class IndexController extends Controller
{
    public function index() {
        return view('welcome');
    }

    public function peserta() {
        $pesertas = Peserta::orderBy('nama', 'asc')->get();
        $materis = Materi::all();
        $rekaps = Rekapnilai::all();
        $newRekaps = [];
        foreach ($rekaps as $data) {
            $getUniqueCode = Penilaian::where('kode_penilaian', $data->kode_penilaian)->get();
            $dumpRekap = null;
            $foundCode = count($getUniqueCode);
            foreach($getUniqueCode as $key => $code) {
                if ($key == 0) {
                    $dumpRekap['nama_peserta'] = $code->peserta->nama;
                    $dumpRekap['jenis_kelamin'] = $code->peserta->jenis_kelamin == 'L' ? 'Laki - Laki' : 'Perempuan';
                    $dumpRekap['asal_sekolah'] = $code->peserta->asal_sekolah;
                }
                $dumpRekap[$code->materi->id] = $code->nilai;
                if ($key == $foundCode - 1) {
                    $dumpRekap['jumlah'] = $data->jumlah;
                    $dumpRekap['rata_rata'] = $data->rata_rata;
                    array_push($newRekaps, $dumpRekap);
                    $dumpRekap = [];
                }
            }
        }
        return view('peserta', compact('newRekaps', 'materis', 'pesertas'));
    }
}
