<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kirimData extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(users::class, 'ID');
    }
}

//TEMPT