<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arship extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'arship';

    public function sekolah() {
        return $this->belongsTo(Sekolah::class, 'NOMOR_S');
    }
}
