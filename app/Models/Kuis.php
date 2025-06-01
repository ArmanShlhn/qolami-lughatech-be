<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuis extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kuis', 'kategori_id'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
    public function scores()
    {
        return $this->hasMany(Score::class, 'kuis_id');
    }


}