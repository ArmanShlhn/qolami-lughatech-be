<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kuis_id',
        'jumlah_benar',
        'jumlah_soal',
        'bintang',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kuis()
    {
        return $this->belongsTo(Kuis::class);
    }
}
