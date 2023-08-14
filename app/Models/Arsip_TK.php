<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Arsip_TK extends Model
{
    use HasFactory;

    use HasFactory;
    protected $guarded = [];
    protected $table = 'TKK_Arsip';
    
    public function sekolah() {
        return $this->belongsTo(Sekolah::class, 'NOMOR_S');
    }
}
