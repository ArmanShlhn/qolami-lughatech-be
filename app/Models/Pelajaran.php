<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelajaran extends Model
{
    use HasFactory;

    protected $table = 'pelajaran';
    protected $fillable = ['kategori_id', 'nama'];
    protected $hidden = ['created_at', 'updated_at'];
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function isiPelajaran()
    {
        return $this->hasMany(IsiPelajaran::class, 'pelajaran_id');
    }
}
