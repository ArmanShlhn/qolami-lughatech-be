<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PelajaranResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'keterangan'  => $this->keterangan,
            'huruf'       => $this->huruf,
            'gambar_url'  => $this->gambar_url,
            'video_url'   => $this->video_url,
        ];
    }
}

