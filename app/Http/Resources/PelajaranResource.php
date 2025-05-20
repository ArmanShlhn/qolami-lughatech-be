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
            'judul'       => $this->judul,
            'tipe'        => $this->tipe, 
            'sub_pelajaran'=> $this->sub_pelajaran, 
            'huruf'       => $this->huruf,
            'keterangan'  => $this->keterangan,
            'gambar_url'  => $this->gambar_url,
            'video_url'   => $this->video_url,
        ];
    }
}

