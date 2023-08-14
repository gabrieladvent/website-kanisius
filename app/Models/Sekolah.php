<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    use HasFactory;

    protected $table = 'sekolah';

    public function siswa(){
        return $this->hasMany(Siswa::class, 'NOMOR_S');
    }

    public function arship (){
        return $this->hasMany(Arship::class, 'NOMOR_S');
    }

    public function TK_Siswa(){
        return $this->hasMany(Siswa_TK::class, 'NOMOR_S');
    }

    public function TKK_Arsip (){
        return $this->hasMany(Arsip_TK::class, 'NOMOR_S');
    }
}
