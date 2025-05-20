<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KuisResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'nama'        => $this->nama,
            'kategori_id' => $this->kategori_id,
            'kategori'    => new KategoriResource($this->whenLoaded('kategori')),
        ];
    }
}

