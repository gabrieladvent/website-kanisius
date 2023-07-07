<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siswaKanisius extends Model
{
    use HasFactory;

    public function sekolah()
    {
        return $this->belongsTo(sekolahKanisus::class, 'nomor_sekolah');
    }
}
