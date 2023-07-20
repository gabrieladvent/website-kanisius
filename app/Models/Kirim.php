<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kirim extends Model
{
    use HasFactory;
    
    protected $table = 'kirim';
    protected $fillable = ['filename'];

    public function getUrl()
    {
        return asset('storage/' . $this->getFilePath());
    }

    public function getFilePath()
    {
        return 'upload/' . $this->filename;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'ID');
    }
}
