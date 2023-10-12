<?php

namespace App\Http\Resources\Contraint;

use App\Models\Jam;
use App\Models\Hari;
use App\Models\pengampu;
use Illuminate\Http\Request;
use App\Http\Resources\Jam\JamResources;
use App\Http\Resources\Hari\HariResources;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Pengampu\PengampuResource;

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
        $pengampu  = pengampu::where('id','=',$this->pengampu_id)->first();
        $hari  = Hari::where('id','=',$this->hari_id)->first();
        $jam  = Jam::where('id','=',$this->jam_id)->first();

        return[
            'id'=> $this->id,
            'pengampu'=>new PengampuResource($pengampu),
            'hari'=> new HariResources($hari),
            'jam' =>new JamResources($jam),
        ];
    }
}
