<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScoreKuisResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'kuis_id'      => $this->kuis_id,
            'user_id'      => $this->user_id,
            'jumlah_benar' => $this->jumlah_benar,
            'jumlah_soal'  => $this->jumlah_soal,
            'bintang'      => $this->bintang,
        ];
    }
}
