<?php

namespace App\Http\Resources\Reservasi;

use App\Http\Resources\Hari\HariResources;
use App\Models\Jam;
use Illuminate\Http\Request;
use App\Http\Resources\Jam\JamResources;
use App\Http\Resources\Ruangan\RuanganResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Pengampu\PengampuResource;
use App\Models\Hari;
use App\Models\pengampu;
use App\Models\Ruangan;

class ReservasiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        $jam  = Jam::where('id','=',$this->jam_id)->first();
        $ruangan  = Ruangan::where('id','=',$this->ruangan_id)->first();
        $pengampu  = pengampu::where('id','=',$this->pengampu_id)->first();
        $hari  = Hari::where('id','=',$this->hari_id)->first();
        
        return[
            'id'=>$this-> id,
            'hari'=> new HariResources($hari),
            'jam' =>new JamResources($jam),
            'ruangan' =>new RuanganResource($ruangan),
            'pengampu'=>new PengampuResource($pengampu),


        ];
    }
}
