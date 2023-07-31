<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Siswa extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'siswa';
    protected $primaryKey = 'NOMOR_S'; 

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y/m/d');
    }

    public function sekolah(){
        return $this->belongsTo(Sekolah::class, 'NOMOR_S', 'NOMOR_S');
    }
}
