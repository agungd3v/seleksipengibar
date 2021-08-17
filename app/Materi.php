<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $guarded = [];
    protected $table = 'materi_seleksi';

    public function penilaian() {
        return $this->hasMany(Penilaian::class, 'materi_id', 'id');
    }
}
