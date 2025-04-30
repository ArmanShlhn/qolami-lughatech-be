<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IsiPelajaran extends Model
{
    use HasFactory;

    protected $table = 'isi_pelajaran';
    protected $fillable = ['pelajaran_id', 'huruf_kata_rangkaian', 'keterangan', 'video_url', 'gambar_url'];
    protected $hidden = ['created_at', 'updated_at'];
    public function pelajaran()
    {
        return $this->belongsTo(Pelajaran::class, 'pelajaran_id');
    }
}
