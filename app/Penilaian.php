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
}
