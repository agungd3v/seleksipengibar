<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    protected $guarded = [];
    protected $table = 'penilaians';

    public function peserta() {
        return $this->belongsTo(Peserta::class, 'peserta_id', 'id');
    }

    public function materi() {
        return $this->belongsTo(Materi::class, 'materi_id', 'id');
    }

    public function ruang() {
        return $this->belongsTo(Ruang::class, 'ruang_id', 'id');
    }

    public function penilai() {
        return $this->belongsTo(Penilai::class, 'penilai_id', 'id');
    }
}
