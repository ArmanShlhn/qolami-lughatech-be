<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SoalVideoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'latihan_id' => $this->latihan_id,
            'video_url'  => $this->video_url,
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

