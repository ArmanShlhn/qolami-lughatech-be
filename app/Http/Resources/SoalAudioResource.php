<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SoalAudioResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'latihan_id' => $this->latihan_id,
            'audio_url'  => $this->audio_url,
            'jawaban'    => $this->jawaban,
            'opsi'       => [
                'a' => $this->opsi_a,
                'b' => $this->opsi_b,
                'c' => $this->opsi_c,
                'd' => $this->opsi_d,
            ],
        ];
    }
}

