<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sekolahKanisus extends Model
{
    use HasFactory;

    public function siswa()
    {
        return $this->hasMany(siswaKanisius::class, 'nomor_sekolah');
    }

    public function arsip()
    {
        return $this->hasMany(arsipData::class, 'nomor_sekolah');
    }
}
