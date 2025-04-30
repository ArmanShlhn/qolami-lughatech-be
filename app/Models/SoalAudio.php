<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalAudio extends Model
{
    use HasFactory;

    protected $table = 'soal_audio';

    protected $fillable = [
        'latihan_id', 
        'kategori_id', 
        'soal', 
        'jawaban', 
        'audio_url',
        'opsi_a', 
        'opsi_b', 
        'opsi_c', 
        'opsi_d',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function latihan()
    {
        return $this->belongsTo(Latihan::class, 'latihan_id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function opsiJawaban()
    {
        return collect([
            $this->opsi_a,
            $this->opsi_b,
            $this->opsi_c,
            $this->opsi_d,
        ]);
    }
}
