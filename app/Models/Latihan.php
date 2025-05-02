<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Latihan extends Model
{
    use HasFactory;
    
    protected $table = 'latihan';
    protected $fillable = ['nama', 'kategori_id'];

    protected $hidden = ['created_at', 'updated_at'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
    
    public function soalVideo()
    {
        return $this->hasMany(SoalVideo::class, 'latihan_id');
    }

    public function soalAudio()
    {
        return $this->hasMany(SoalAudio::class, 'latihan_id');
    }
}