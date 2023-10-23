<?php

namespace App\Http\Resources\Jadwal;

use App\Http\Resources\Hari\HariResources;
use App\Http\Resources\Jam\JamResources;
use App\Http\Resources\Pengampu\PengampuResource;
use App\Http\Resources\Reservasi\ReservasiResource;
use App\Http\Resources\Ruangan\RuanganResource;
use App\Models\Jam;
use App\Models\Hari;
use App\Models\pengampu;
use App\Models\Ruangan;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class JadwalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        $jam  = Jam::where('id', '=', $this->jam_id)->first();
        $ruangan  = Ruangan::where('id', '=', $this->ruangan_id)->first();
        $pengampu  = pengampu::where('id', $this->pengampu_id)->first();
        $hari  = Hari::where('id', '=', $this->hari_id)->first();
        $reservasi = Reservasi::where('id', '=', $this->reservasi_id)->first();

        return
            [
                'id'        => $this->id,
                'jam'       => new JamResources($jam),
                'ruangan'   => new RuanganResource($ruangan),
                'pengampu'  => new PengampuResource($pengampu),
                'hari'      => new HariResources($hari),
                'reservasi' => new ReservasiResource($reservasi)
            ];
    }
}
