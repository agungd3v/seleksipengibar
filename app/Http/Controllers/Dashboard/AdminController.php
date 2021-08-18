<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Materi;
use App\Penilai;
use App\Penilaian;
use Illuminate\Http\Request;
use App\Peserta;
use App\Rekapnilai;
use App\Ruang;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use PDF;

class AdminController extends Controller
{
    public function index() {
        $peserta = Peserta::count();
        $penilaian = Rekapnilai::count();
        $rata_rata = Rekapnilai::where('rata_rata', '>=', 350)->count();
        return view('dashboard.index', compact('peserta', 'penilaian', 'rata_rata'));
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

        if ($request->hasFile('photo')) {
            $photo = $request->photo;
            $jpegFormat = 'image/jpeg';
            $pngFormat = 'image/png';

            if ($photo->getSize() > 1000000) {
                return redirect()->route('admin.peserta')->with('errorMessage', 'Maksimal file 1MB');
            }

            if ($photo->getClientMimeType() == $jpegFormat || $photo->getClientMimeType() == $pngFormat) {
                $path = $request->file('photo')->store('public/photo');
                $sendPath = explode('/', $path);
                $peserta->photo = 'storage/'. $sendPath[1] .'/'. $sendPath[2];
            } else {
                return redirect()->route('admin.peserta')->with('errorMessage', 'Format gambar tidak diterima!');
            }
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

        if ($request->hasFile('photo_edit')) {
            $photo = $request->photo_edit;
            $jpegFormat = 'image/jpeg';
            $pngFormat = 'image/png';

            if ($photo->getSize() > 1000000) {
                return redirect()->route('admin.peserta')->with('errorMessage', 'Maksimal file 1MB');
            }

            if ($photo->getClientMimeType() == $jpegFormat || $photo->getClientMimeType() == $pngFormat) {
                $pathFile = explode('/', $peserta->photo);
                Storage::delete('public/'. $pathFile[1] .'/'. $pathFile[2]);

                $path = $request->file('photo_edit')->store('public/photo');
                $sendPath = explode('/', $path);
                $peserta->photo = 'storage/'. $sendPath[1] .'/'. $sendPath[2];
            } else {
                return redirect()->route('admin.peserta')->with('errorMessage', 'Format gambar tidak diterima!');
            }
        }

        $peserta->save();

        return redirect()->route('admin.peserta')->with('berhasil', 'Berhasil mengubah data peserta '. $peserta->nama);
    }

    public function pesertaDelete(Request $request) {
        $peserta = Peserta::find($request->delete_peserta_id);
        if ($peserta) {
            if (isset($peserta->penilaian) && count($peserta->penilaian) != 0) {
                $checkRekap = Rekapnilai::where('kode_penilaian', $peserta->penilaian[0]->kode_penilaian)->first();
                if ($checkRekap) {
                    $checkRekap->delete();
                } 
            }
            if ($peserta->photo) {
                $pathFile = explode('/', $peserta->photo);
                Storage::delete('public/'. $pathFile[1] .'/'. $pathFile[2]);
            }

            $peserta->delete();

            return redirect()->route('admin.peserta')->with('berhasil', 'Berhasil menghapus peserta');
        } else {
            return redirect()->route('admin.peserta')->with('errorMessage', 'Peserta tidak dikenali!');
        }

        return redirect()->route('admin.peserta')->with('errorMessage', 'Sistem tidak mengetahui akses yang kamu lakukan!');
    }

    public function materi() {
        $materis = Materi::orderBy('id', 'desc')->get();
        return view('dashboard.materi', compact('materis'));
    }

    public function materiPost(Request $request) {
        $request->validate([
            'name' => 'required'
        ]);

        $materi = new Materi();
        $materi->nama_materi = $request->name;

        if ($request->keterangan) {
            $materi->keterangan = $request->keterangan;
        }

        $materi->save();

        return redirect()->route('admin.materi')->with('berhasil', 'Berhasil menambah materi baru');
    }

    public function materiUpdate(Request $request) {
        $request->validate([
            'materi_id' => 'required',
            'name_edit' => 'required'
        ]);

        $materi = Materi::where('id', $request->materi_id)->first();
        if (!$materi) {
            return redirect()->route('admin.materi')->with('errorMessage', 'Materi tidak ditemukan!');
        }

        $materi->nama_materi = $request->name_edit;
        
        if ($request->keterangan_edit) {
            $materi->keterangan = $request->keterangan_edit;
        }

        $materi->save();

        return redirect()->route('admin.materi')->with('berhasil', 'Berhasil mengupdate materi '. $materi->nama_materi);
    }

    public function materiDelete(Request $request) {
        $request->validate([
            'delete_materi_id' => 'required'
        ]);

        $materi = Materi::where('id', $request->delete_materi_id)->first();
        
        if (!$materi) {
            return redirect()->route('admin.materi')->with('errorMessage', 'Materi tidak ditemukan!');
        }

        if (isset($materi->penilaian) && count($materi->penilaian) > 0) {
            foreach ($materi->penilaian as $penilaian) {
                $checkRekap = Rekapnilai::where('kode_penilaian', $penilaian->kode_penilaian)->first();
                if ($checkRekap) {
                    $jumlah = 0;
                    foreach (Penilaian::where('kode_penilaian', $checkRekap->kode_penilaian)->get() as $data) {
                        if ($materi->id == $data->materi_id) {
                            $jumlah -= intval($data->nilai);
                        }
                        $jumlah += intval($data->nilai);
                    }
                    $checkRekap->jumlah = $jumlah;
                    $checkRekap->rata_rata = $jumlah / 2;
                    $checkRekap->save();
                    $jumlah = 0;
                }
            }
        }

        $materi->delete();

        return redirect()->route('admin.materi')->with('berhasil', 'Berhasil menghapus materi');
    }

    public function ruang() {
        $ruangs = Ruang::orderBy('id', 'desc')->get();
        return view('dashboard.ruang', compact('ruangs'));
    }

    public function ruangPost(Request $request) {
        $request->validate([
            'name' => 'required',
            'alamat' => 'required',
        ]);

        $ruang = new Ruang();
        $ruang->nama_lokasi = $request->name;
        $ruang->alamat = $request->alamat;

        if ($request->keterangan) {
            $ruang->keterangan = $request->keterangan;
        }

        $ruang->save();

        return redirect()->route('admin.ruang')->with('berhasil', 'Berhasil menambahkan ruangan baru');
    }

    public function ruangUpdate(Request $request) {
        $request->validate([
            'name_edit' => 'required',
            'alamat_edit' => 'required'
        ]);

        $ruang = Ruang::where('id', $request->ruang_id)->first();
        if (!$ruang) {
            return redirect()->route('admin.ruang')->with('errorMessage', 'Ruangan yang di maksut tidak ditemukan!');
        }

        $ruang->nama_lokasi = $request->name_edit;
        $ruang->alamat = $request->alamat_edit;

        if ($request->keterangan_edit) {
            $ruang->keterangan = $request->keterangan_edit;
        }

        $ruang->save();

        return redirect()->route('admin.ruang')->with('berhasil', 'Berhasil mengupdate ruangan '. $request->nama_lokasi);
    }

    public function ruangDelete(Request $request) {
        $request->validate([
            'delete_ruang_id' => 'required'
        ]);

        $ruang = Ruang::where('id', $request->delete_ruang_id)->first();
        
        if (!$ruang) {
            return redirect()->route('admin.ruang')->with('errorMessage', 'Ruangan tidak ditemukan!');
        }

        if (isset($ruang->penilaian) && count($ruang->penilaian) > 0) {
            foreach ($ruang->penilaian as $penilaian) {
                $checkRekap = Rekapnilai::where('kode_penilaian', $penilaian->kode_penilaian)->first();
                if ($checkRekap) {
                    $jumlah = 0;
                    foreach (Penilaian::where('kode_penilaian', $checkRekap->kode_penilaian)->get() as $data) {
                        if ($ruang->id == $data->materi_id) {
                            $jumlah -= intval($data->nilai);
                        }
                        $jumlah += intval($data->nilai);
                    }
                    $checkRekap->jumlah = $jumlah;
                    $checkRekap->rata_rata = $jumlah / 2;
                    $checkRekap->save();
                    $jumlah = 0;
                }
            }
        }

        $ruang->delete();

        return redirect()->route('admin.ruang')->with('berhasil', 'Berhasil menghapus ruangan');
    }

    public function penilai() {
        $penilais = Penilai::orderBy('id', 'desc')->get();
        return view('dashboard.penilai', compact('penilais'));
    }

    public function penilaiPost(Request $request) {
        $request->validate([
            'name' => 'required',
            'asal_instansi' => 'required',
            'jabatan' => 'required'
        ]);

        $penilai = new Penilai();
        $penilai->nama_penilai = $request->name;
        $penilai->asal_instansi = $request->asal_instansi;
        $penilai->jabatan = $request->jabatan;

        if ($request->keterangan) {
            $penilai->keterangan = $request->keterangan;
        }

        $penilai->save();

        return redirect()->route('admin.penilai')->with('berhasil', 'Berhasil menambahkan penilai');
    }

    public function penilaiUpdate(Request $request) {
        $request->validate([
            'name_edit' => 'required',
            'asal_instansi_edit' => 'required',
            'jabatan_edit' => 'required'
        ]);
        
        $penilai = Penilai::where('id', $request->penilai_id)->first();
        if (!$penilai) {
            return redirect()->route('admin.penilai')->with('errorMessage', 'Penilai tidak ditemukan!');
        }

        $penilai->nama_penilai = $request->name_edit;
        $penilai->asal_instansi = $request->asal_instansi_edit;
        $penilai->jabatan = $request->jabatan_edit;

        if ($request->keterangan_edit) {
            $penilai->keterangan = $request->keterangan_edit;
        }

        $penilai->save();

        return redirect()->route('admin.penilai')->with('berhasil', 'Berhasil mengupdate penilai '. $penilai->nama_penilai);
    }

    public function penilaiDelete(Request $request) {
        $request->validate([
            'delete_penilai_id' => 'required'
        ]);

        $penilai = Penilai::where('id', $request->delete_penilai_id)->first();
        if (!$penilai) {
            return redirect()->route('admin.penilai')->with('errorMessage', 'Penilai tidak ditemukan!');
        }

        $penilai->delete();

        return redirect()->route('admin.penilai')->with('berhasil', 'Berhasil menghapus penilai');
    }

    public function penilaian() {
        $pesertas = Peserta::orderBy('nama', 'asc')->get();
        $materis = Materi::orderBy('nama_materi', 'asc')->get();
        $penilais = Penilai::orderBy('nama_penilai', 'asc')->get();
        $ruangs = Ruang::orderBy('nama_lokasi', 'asc')->get();
        return view('dashboard.penilaian', compact('pesertas', 'materis', 'penilais', 'ruangs'));
    }

    public function penilaianPost(Request $request) {
        $peserta = Peserta::where('id', $request->peserta)->first();
        $materi = Materi::where('id', $request->materi)->first();
        $ruang = Ruang::where('id', $request->ruang)->first();
        $penilai = Penilai::where('id', $request->penilai)->first();

        if (!$peserta || !$materi || !$ruang || !$penilai || !$request->nilai) {
            return redirect()->route('admin.penilaian')->with('errorMessage', 'Mohon untuk mengisi semua kolom yang ada!');
        }

        $uniqueCode = "";

        $checkPenilaian = Penilaian::where('peserta_id', $peserta->id)->first();
        if ($checkPenilaian) {
            $penilaianExist = Penilaian::where('peserta_id', $peserta->id)->where('materi_id', $materi->id)->first();
            if ($penilaianExist) {
                $penilaianExist->ruang_id = $ruang->id;
                $penilaianExist->penilai_id = $penilai->id;
                $penilaianExist->nilai = $request->nilai;
                $penilaianExist->save();

                $checkRekap = Rekapnilai::where('kode_penilaian', $penilaianExist->kode_penilaian)->first();
                $jumlah = 0;
                foreach (Penilaian::where('kode_penilaian', $checkRekap->kode_penilaian)->get() as $data) {
                    $jumlah += intval($data->nilai);
                }

                $checkRekap->jumlah = $jumlah;
                $checkRekap->rata_rata = $jumlah / 2;
                $checkRekap->save();

                return redirect()->route('admin.penilaian')->with('berhasil', 'Berhasil mengupdate data penilaian peserta '. $penilaianExist->peserta->nama .' pada materi '. $penilaianExist->materi->nama_materi);
            }
        }

        while (true) {
            if ($checkPenilaian) {
                $uniqueCode = $checkPenilaian->kode_penilaian;
                break;
            }
            
            $generateCode = Str::random(8);
            $checkCodeExist = Penilaian::where('kode_penilaian', $generateCode)->first();
            if (!$checkCodeExist) {
                $uniqueCode = $generateCode;
                break;
            }
        }

        $penilaian = new Penilaian();
        $penilaian->kode_penilaian = $uniqueCode;
        $penilaian->peserta_id = $peserta->id;
        $penilaian->materi_id = $materi->id;
        $penilaian->ruang_id = $ruang->id;
        $penilaian->penilai_id = $penilai->id;
        $penilaian->nilai = $request->nilai;
        $penilaian->save();

        $checkRekap = Rekapnilai::where('kode_penilaian', $penilaian->kode_penilaian)->first();
        $jumlah = 0;

        if ($checkRekap) {
            foreach (Penilaian::where('kode_penilaian', $checkRekap->kode_penilaian)->get() as $data) {
                $jumlah += intval($data->nilai);
            }

            $checkRekap->jumlah = $jumlah;
            $checkRekap->rata_rata = $jumlah / 2;
            $checkRekap->save();
        } else {
            $rekap = new Rekapnilai();
            $rekap->kode_penilaian = $penilaian->kode_penilaian;
            $rekap->jumlah = intval($penilaian->nilai);
            $rekap->rata_rata = intval($penilaian->nilai) / 2;
            $rekap->save();
        }


        return redirect()->route('admin.penilaian')->with('berhasil', 'Berhasil menambahkan data penilaian peserta '. $penilaian->peserta->nama . ' pada materi '. $penilaian->materi->nama_materi);
    }

    public function rekap() {
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
        return view('dashboard.rekap', compact('newRekaps', 'materis'));
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
                    $pesertas = Peserta::where('created_at', '>=', $request->from)
                                    ->orderBy('nomor_dada', 'asc')
                                    ->get();
                } elseif ($request->to != null && $request->from == null) {
                    $to = date('d/m/Y', strtotime($request->to));
                    $pesertas = Peserta::where('created_at', '<=', $request->to)
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
                                    ->where('created_at', '>=', $request->from)
                                    ->orderBy('nomor_dada', 'asc')
                                    ->get();
                } elseif ($request->to != null && $request->from == null) {
                    $to = date('d/m/Y', strtotime($request->to));
                    $pesertas = Peserta::where('jenis_kelamin', $jenis_kelamin)
                                    ->where('created_at', '<=', $request->to)
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

    public function reportPesertaId($id) {
        $peserta = Peserta::findOrFail($id);
        $pdf = PDF::loadview('report.peserta.id', compact('peserta'))->setPaper('A4', 'potrait');
        return $pdf->stream("Report Peserta");
    }

    public function reportRekap(Request $request) {
        $jenis_kelamin = $request->jenis_kelamin;
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
                    $dumpRekap['jenis_kelamin'] = $code->peserta->jenis_kelamin;
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
        if ($jenis_kelamin) {
            $dumpAnyJk = [];
            foreach ($newRekaps as $key => $data) {
                if ($jenis_kelamin == $data['jenis_kelamin']) {
                    array_push($dumpAnyJk, $data);
                }
                if ($key == count($newRekaps) - 1) {
                    $newRekaps = $dumpAnyJk;
                    $dumpAnyJk = [];
                }
            }
        }
        $pdf = PDF::loadview('report.penilaian', compact('newRekaps', 'materis', 'jenis_kelamin'))->setPaper('A4', 'landscape');
        return $pdf->stream("Report Penilaian");
    }
}
