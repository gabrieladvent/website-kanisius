<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa_TK extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $primaryKey = 'NOMOR_S'; 
    protected $table = 'TK_Siswa';

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y/m/d');
    }

    public function sekolah(){
        return $this->belongsTo(Sekolah::class, 'NOMOR_S', 'NOMOR_S');
    }
}
