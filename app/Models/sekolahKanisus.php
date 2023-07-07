<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sekolahKanisus extends Model
{
    use HasFactory;

    public function siswa()
    {
        return $this->hasMany(siswaKanisius::class, 'NOMOR SEKOLAH');
    }

    public function arsip()
    {
        return $this->hasMany(arsipData::class, 'NOMOR SEKOLAH');
    }
}
