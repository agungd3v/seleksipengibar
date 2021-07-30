<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Peserta;

class IndexController extends Controller
{
    public function selectPeserta(Request $request) {
        $peserta = Peserta::with('penilaian')->where('id', $request->id)->first();
        return response()->json([
            'status' => $peserta ? true : false,
            'message' => $peserta ? $peserta : 'Peserta tidak di temukan'
        ]);
    }
}
