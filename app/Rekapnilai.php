<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rekapnilai extends Model
{
    protected $guarded = [];
    protected $table = 'rekap_nilai';

    public function peserta() {
        return $this->belongsTo(Peserta::class, 'peserta_id', 'id');
    }
}
