<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $guarded = [];
    protected $table = 'pesertas';

    public function penilaian() {
        return $this->hasOne(Penilaian::class, 'peserta_id', 'id');
    }
}
