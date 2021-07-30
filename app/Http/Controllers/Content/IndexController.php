<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Peserta;

class IndexController extends Controller
{
    public function index() {
        return view('welcome');
    }

    public function peserta() {
        $penilaians = Peserta::orderBy('nama', 'asc')->get();
        return view('peserta', compact('penilaians'));
    }
}
