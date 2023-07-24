<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Yayasan extends Model
{
    use HasFactory;
    
    protected $table = 'yayasan';
    protected $fillable = [
        'id',
        'nama_foto',
    ];

    protected $hidden = [
        // ... Kolom yang ingin disembunyikan ...
    ];


    // public function getProfilePhotoUrlAttribute()
    // {
    //     return $this->nama_foto
    //         ? asset('storage/' . $this->nama_foto)
    //         : asset('images/default-profile-photo.png'); // Ganti dengan path default foto profil jika belum diatur
    // }
}
