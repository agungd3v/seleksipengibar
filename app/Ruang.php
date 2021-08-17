<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    protected $guarded = [];
    protected $table = 'ruang';

    public function penilaian() {
        return $this->hasMany(Penilaian::class, 'peserta_id', 'id');
    }
}
