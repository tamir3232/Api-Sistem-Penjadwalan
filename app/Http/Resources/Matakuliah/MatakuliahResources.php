<?php

namespace App\Http\Resources\Matakuliah;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MatakuliahResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'kode_matkul'  =>$this->kode_matkul,
            'semester' => $this->semester,
            'sks' => $this->sks,
            'status' => $this->status,
        ];
    }
}
