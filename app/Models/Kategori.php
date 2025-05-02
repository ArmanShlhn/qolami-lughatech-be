<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $fillable = ['nama'];

    protected $hidden = ['created_at', 'updated_at'];

    public function latihan()
    {
        return $this->hasMany(Latihan::class);
    }
    public function kuis()
    {
        return $this->hasMany(Kuis::class);
    }
    
    public function soalVideo()
    {
        return $this->hasMany(SoalVideo::class);
    }

    public function soalAudio()
    {
        return $this->hasMany(SoalAudio::class);
    }
}
