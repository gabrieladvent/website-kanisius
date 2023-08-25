<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Arsip_TK extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'tkk_siswa';
    public function sekolah() {
        return $this->belongsTo(Sekolah::class, 'NOMOR_S');
    }
}