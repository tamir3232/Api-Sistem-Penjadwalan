<?php

namespace App\Http\Resources\Jam;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JamResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return[
            'id'=>$this->id,
            'range_jam'=>$this->range_jam,
            'awal'=>$this->awal,
            'akhir'=>$this->akhir,

        ];
    }
}
