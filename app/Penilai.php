<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penilai extends Model
{
    protected $guarded = [];
    protected $table = 'penilai';

    public function penilaian() {
        return $this->hasMany(Penilaian::class, 'peserta_id', 'id');
    }
}
