<?php

namespace App\Http\Resources\Contraint;

use App\Models\Jam;
use App\Models\Hari;
use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Http\Resources\Jam\JamResources;
use App\Http\Resources\Hari\HariResources;
use App\Http\Resources\Dosen\DosenResource;
use Illuminate\Http\Resources\Json\JsonResource;


class ContraintResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        $dosen  = Dosen::where('id','=',$this->dosen_id)->first();
        $hari  = Hari::where('id','=',$this->hari_id)->first();
        $jam  = Jam::where('id','=',$this->jam_id)->first();

        return[
            'id'=> $this->id,
            'dosen'=>new DosenResource($dosen),
            'hari'=> new HariResources($hari),
            'jam' =>new JamResources($jam),
        ];
    }
}
