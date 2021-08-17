<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Peserta;
use App\Materi;
use App\Rekapnilai;
use App\Penilaian;

class IndexController extends Controller
{
    public function selectPeserta(Request $request) {
        $peserta = Peserta::where('id', $request->id)->first();
        $materis = Materi::all();
        $rekaps = Rekapnilai::all();
        $newRekaps = [];
        foreach ($rekaps as $data) {
            $getUniqueCode = Penilaian::where('kode_penilaian', $data->kode_penilaian)->get();
            $dumpRekap = null;
            $foundCode = count($getUniqueCode);
            foreach($getUniqueCode as $key => $code) {
                if ($code->peserta_id == $peserta->id) {
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
        }
        return response()->json([
            'status' => $peserta ? true : false,
            'message' => [
                'pesertas' => $newRekaps,
                'materis' => $materis
            ]
        ]);
    }
}
