<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portal extends Model
{
    use HasFactory;
    protected $table = 'portal';

    protected $fillable = [
        'nama_portal',
        'upload_start',
        'upload_end',
    ];
}