<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalLatihan extends Model
{
    use HasFactory;

    protected $table = 'soal_latihan';
    protected $fillable = ['latihan_id', 'jenis', 'soal', 'jawaban', 'media_url'];

    public function latihan()
    {
        return $this->belongsTo(Latihan::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
