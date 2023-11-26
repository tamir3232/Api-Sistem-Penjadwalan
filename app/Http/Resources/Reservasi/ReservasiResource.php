<?php

namespace App\Http\Resources\Reservasi;

use App\Models\Jam;
use App\Models\Hari;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Ruangan;
use App\Models\pengampu;
use Illuminate\Http\Request;
use App\Http\Resources\Jam\JamResources;
use App\Http\Resources\Hari\HariResources;
use App\Http\Resources\Dosen\DosenResource;
use App\Http\Resources\Ruangan\RuanganResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Pengampu\PengampuResource;
use App\Http\Resources\User\UserResource;

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
        $jam        = Jam::where('id', '=', $this->jam_id)->first();
        $ruangan    = Ruangan::where('id', '=', $this->ruangan_id)->first();
        $pengampu   = pengampu::where('id', '=', $this->pengampu_id)->first();
        $hari       = Hari::where('id', '=', $this->hari_id)->first();
        $user       = User::where('id', '=', $this->reservasiby_id)->first();

        return [
            'id' => $this->id,
            'hari' => new HariResources($hari),
            'jam' => new JamResources($jam),
            'ruangan' => new RuanganResource($ruangan),
            'dosens' => new DosenResource($pengampu),
            'pengampu' => new PengampuResource($pengampu),
            'reservasiby_id' => new UserResource($user) ?? null,
            'status' => $this->status,
            'tanggal' => $this->tanggal_reservasi




        ];
    }
}
