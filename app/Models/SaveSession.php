<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaveSession extends Model
{
    use HasFactory;
    protected $fillable = [
        'variabel',
        'id_login',
        'status_kirim',
    ];
}
