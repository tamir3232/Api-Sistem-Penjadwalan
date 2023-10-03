<?php

namespace App\Http\Resources\Hari;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HariResources extends JsonResource
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
            'nama'=>$this->nama,
        ];
    }
}
