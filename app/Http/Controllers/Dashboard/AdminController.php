<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Peserta;
use App\Penilaian;
use PDF;

class AdminController extends Controller
{
    public function index() {
        return view('dashboard.index');
    }

    public function peserta() {
        $pesertas = Peserta::orderBy('nomor_dada', 'asc')->get();
        return view('dashboard.peserta', compact('pesertas'));
    }

    public function pesertaPost(Request $request) {
        $request->validate([
            'name' => 'required|min:5',
            'jenis_kelamin' => 'required|in:L,P',
            'nomor' => 'required|numeric',
            'sekolah' => 'required|min:5',
            'tinggi' => 'required|numeric',
            'berat' => 'required|numeric'
        ]);
        
        $peserta = new Peserta();
        $peserta->nama = $request->name;
        $peserta->jenis_kelamin = $request->jenis_kelamin;
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

    public function pesertaUpdate(Request $request) {
        $request->validate([
            'name_edit' => 'required|min:5',
            'jenis_kelamin_edit' => 'required|in:L,P',
            'nomor_edit' => 'required|numeric',
            'sekolah_edit' => 'required|min:5',
            'tinggi_edit' => 'required|numeric',
            'berat_edit' => 'required|numeric'
        ]);

        $peserta = Peserta::find($request->peserta_id);
        if (!$peserta) {
            return redirect()->route('admin.peserta')->with('errorMessage', 'Peserta tidak dikenali');
        }

        $peserta->nama = $request->name_edit;
        $peserta->nomor_dada = $request->nomor_edit;
        $peserta->jenis_kelamin = $request->jenis_kelamin_edit;
        $peserta->asal_sekolah = $request->sekolah_edit;
        $peserta->tinggi = $request->tinggi_edit;
        $peserta->berat = $request->berat_edit;

        if ($request->alamat_edit) {
            $peserta->alamat = $request->alamat_edit;
        }

        $peserta->save();

        return redirect()->route('admin.peserta')->with('berhasil', 'Berhasil mengubah data peserta '. $peserta->nama);
    }

    public function pesertaDelete(Request $request) {
        $peserta = Peserta::find($request->delete_peserta_id);
        if ($peserta) {
            $peserta->delete();

            return redirect()->route('admin.peserta')->with('berhasil', 'Peserta telah dihapus!');
        }

        return redirect()->route('admin.peserta')->with('errorMessage', 'Sistem tidak mengetahui akses yang kamu lakukan!');
    }

    public function penilaian() {
        $pesertas = Peserta::orderBy('nama', 'asc')->get();
        $penilaians = Peserta::orderBy('nomor_dada', 'asc')->get();
        return view('dashboard.penilaian', compact('pesertas', 'penilaians'));
    }

    public function penilaianPost(Request $request) {
        $request->validate([
            'peserta' => 'required',
            'lari_total' => 'required|numeric',
            'lari_meter' => 'required|numeric',
            'b_inggris_aula' => 'required|numeric',
            'b_inggris_r_bapak' => 'required|numeric',
            'agama_aula' => 'required|numeric',
            'agama_r_bapak' => 'required|numeric',
            'pbb_aula' => 'required|numeric',
            'pbb_r_bapak' => 'required|numeric',
            'senibudaya_aula' => 'required|numeric',
            'senibudaya_r_bapak' => 'required|numeric',
            'pengetahuan_aula' => 'required|numeric',
            'pengetahuan_r_bapak' => 'required|numeric'
        ]);

        $peserta = Peserta::find($request->peserta);
        if (!$peserta) {
            return redirect()->route('admin.penilaian')->with('errorMessage', 'Peserta tidak dikenali');
        }

        $jumlah = ($request->b_inggris_aula + $request->b_inggris_r_bapak) +
                  ($request->agama_aula + $request->agama_r_bapak) +
                  ($request->pbb_aula + $request->pbb_r_bapak) +
                  ($request->senibudaya_aula + $request->senibudaya_r_bapak) +
                  ($request->pengetahuan_aula + $request->pengetahuan_r_bapak);

        $penilaian = new Penilaian();
        $penilaian->peserta_id = $peserta->id;
        $penilaian->lari_total = $request->lari_total;
        $penilaian->lari_meter = $request->lari_meter;
        $penilaian->b_inggris_aula = $request->b_inggris_aula;
        $penilaian->b_inggris_r_bapak = $request->b_inggris_r_bapak;
        $penilaian->agama_aula = $request->agama_aula;
        $penilaian->agama_r_bapak = $request->agama_r_bapak;
        $penilaian->pbb_aula = $request->pbb_aula;
        $penilaian->pbb_r_bapak = $request->pbb_r_bapak;
        $penilaian->seni_budaya_aula = $request->senibudaya_aula;
        $penilaian->seni_budaya_r_bapak = $request->senibudaya_r_bapak;
        $penilaian->pengetahuan_aula = $request->pengetahuan_aula;
        $penilaian->pengetahuan_r_bapak = $request->pengetahuan_r_bapak;
        $penilaian->jumlah = $jumlah;
        $penilaian->rata_rata = $jumlah / 2;

        $penilaian->save();

        return redirect()->route('admin.penilaian')->with('berhasil', 'Selesai melakukan penilaian peserta '. $peserta->nama);
    }

    public function penilaianUpdate(Request $request) {
        $request->validate([
            'lari_total_edit' => 'required|numeric',
            'lari_meter_edit' => 'required|numeric',
            'b_inggris_aula_edit' => 'required|numeric',
            'b_inggris_r_bapak_edit' => 'required|numeric',
            'agama_aula_edit' => 'required|numeric',
            'agama_r_bapak_edit' => 'required|numeric',
            'pbb_aula_edit' => 'required|numeric',
            'pbb_r_bapak_edit' => 'required|numeric',
            'senibudaya_aula_edit' => 'required|numeric',
            'senibudaya_r_bapak_edit' => 'required|numeric',
            'pengetahuan_aula_edit' => 'required|numeric',
            'pengetahuan_r_bapak_edit' => 'required|numeric'
        ]);

        $penilaian = Penilaian::find($request->penilaian_id);
        if (!$penilaian) {
            return redirect()->route('admin.penilaian')->with('errorMessage', 'Sistem tidak mengetahui akses yang kamu lakukan!');
        }

        $jumlah = ($request->b_inggris_aula_edit + $request->b_inggris_r_bapak_edit) +
                  ($request->agama_aula_edit + $request->agama_r_bapak_edit) +
                  ($request->pbb_aula_edit + $request->pbb_r_bapak_edit) +
                  ($request->senibudaya_aula_edit + $request->senibudaya_r_bapak_edit) +
                  ($request->pengetahuan_aula_edit + $request->pengetahuan_r_bapak_edit);

        $penilaian->lari_total = $request->lari_total_edit;
        $penilaian->lari_meter = $request->lari_meter_edit;
        $penilaian->b_inggris_aula = $request->b_inggris_aula_edit;
        $penilaian->b_inggris_r_bapak = $request->b_inggris_r_bapak_edit;
        $penilaian->agama_aula = $request->agama_aula_edit;
        $penilaian->agama_r_bapak = $request->agama_r_bapak_edit;
        $penilaian->pbb_aula = $request->pbb_aula_edit;
        $penilaian->pbb_r_bapak = $request->pbb_r_bapak_edit;
        $penilaian->seni_budaya_aula = $request->senibudaya_aula_edit;
        $penilaian->seni_budaya_r_bapak = $request->senibudaya_r_bapak_edit;
        $penilaian->pengetahuan_aula = $request->pengetahuan_aula_edit;
        $penilaian->pengetahuan_r_bapak = $request->pengetahuan_r_bapak_edit;
        $penilaian->jumlah = $jumlah;
        $penilaian->rata_rata = $jumlah / 2;

        $penilaian->save();

        return redirect()->route('admin.penilaian')->with('berhasil', 'Selesai melakukan penilaian peserta '. $penilaian->peserta->nama);
    }

    public function penilaianDelete(Request $request) {
        $penilaian = Penilaian::find($request->delete_penilaian_id);
        if ($penilaian) {
            $peserta = Peserta::find($penilaian->peserta_id);
            $penilaian->delete();

            return redirect()->route('admin.penilaian')->with('berhasil', 'Penilaian untuk peserta '. $peserta->nama .' telah dihapus');            
        }

        return redirect()->route('admin.penilaian')->with('errorMessage', 'Sistem tidak mengetahui akses yang kamu lakukan!');
    }

    public function reportPeserta(Request $request) {
        $jenis_kelamin = $request->jenis_kelamin;
        $from = null;
        $to = null;
        if ($request->from == null && $request->to == null && !$jenis_kelamin) {
            $pesertas = Peserta::orderBy('nomor_dada', 'asc')->get();
        } else {
            if (!$jenis_kelamin) {
                if ($request->from != null && $request->to == null) {
                    $from = date('d/m/Y', strtotime($request->from));
                    $pesertas = Peserta::where('created_at', '>', $request->from)
                                    ->orderBy('nomor_dada', 'asc')
                                    ->get();
                } elseif ($request->to != null && $request->from == null) {
                    $to = date('d/m/Y', strtotime($request->to));
                    $pesertas = Peserta::where('created_at', '<', $request->to)
                                    ->orderBy('nomor_dada', 'asc')
                                    ->get();
                } else {
                    $from = date('d/m/Y', strtotime($request->from));
                    $to = date('d/m/Y', strtotime($request->to));
                    $pesertas = Peserta::whereBetween('created_at', [$request->from, $request->to])
                                    ->orderBy('nomor_dada', 'asc')
                                    ->get();
                }
            } else {
                if ($jenis_kelamin && $request->from == null && $request->to == null) {

                    $pesertas = Peserta::where('jenis_kelamin', $jenis_kelamin)->orderBy('nomor_dada', 'asc')->get();

                } elseif ($request->from != null && $request->to == null) {
                    $from = date('d/m/Y', strtotime($request->from));
                    $pesertas = Peserta::where('jenis_kelamin', $jenis_kelamin)
                                    ->where('created_at', '>', $request->from)
                                    ->orderBy('nomor_dada', 'asc')
                                    ->get();
                } elseif ($request->to != null && $request->from == null) {
                    $to = date('d/m/Y', strtotime($request->to));
                    $pesertas = Peserta::where('jenis_kelamin', $jenis_kelamin)
                                    ->where('created_at', '<', $request->to)
                                    ->orderBy('nomor_dada', 'asc')
                                    ->get();
                } else {
                    $from = date('d/m/Y', strtotime($request->from));
                    $to = date('d/m/Y', strtotime($request->to));
                    $pesertas = Peserta::where('jenis_kelamin', $jenis_kelamin)
                                    ->whereBetween('created_at', [$request->from, $request->to])
                                    ->orderBy('nomor_dada', 'asc')
                                    ->get();
                }
            }
        }

        $pdf = PDF::loadview('report.peserta', compact('pesertas', 'jenis_kelamin', 'from', 'to'))->setPaper('A4', 'landscape');
        return $pdf->stream(
            "Report Peserta" . ($from || $to ? " - " : "") . ($from && $to ? "($from - " : $from) . ($from && $to ? "$to)" : $to)
        );
    }

    public function reportPenilaian(Request $request) {
        $jenis_kelamin = $request->jenis_kelamin;
        $from = null;
        $to = null;
        if ($request->from == null && $request->to == null  && !$jenis_kelamin) {

            $penilaians = Penilaian::orderBy('rata_rata', 'desc')->get();

        } elseif ($request->from == null && $request->to == null && $jenis_kelamin) {

            $penilaians = Penilaian::orderBy('rata_rata', 'desc')->get();

        } else {
            if ($request->from != null && $request->to == null) {
                $from = date('d/m/Y', strtotime($request->from));
                $penilaians = Penilaian::where('created_at', '>', $request->from)
                                ->orderBy('rata_rata', 'desc')
                                ->get();
            } elseif ($request->to != null && $request->from == null) {
                $to = date('d/m/Y', strtotime($request->to));
                $penilaians = Penilaian::where('created_at', '<', $request->to)
                                ->orderBy('rata_rata', 'desc')
                                ->get();
            } else {
                $from = date('d/m/Y', strtotime($request->from));
                $to = date('d/m/Y', strtotime($request->to));
                $penilaians = Penilaian::whereBetween('created_at', [$request->from, $request->to])
                                ->orderBy('rata_rata', 'desc')
                                ->get();
            }
        }

        $pdf = PDF::loadview('report.penilaian', compact('penilaians', 'jenis_kelamin', 'from', 'to'))->setPaper('A4', 'landscape');
        return $pdf->stream(
            "Report Penilaian" . ($from || $to ? " - " : "") . ($from && $to ? "($from - " : $from) . ($from && $to ? "$to)" : $to)
        );
    }
}
