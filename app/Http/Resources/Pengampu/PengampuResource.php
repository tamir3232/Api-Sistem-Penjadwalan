<?php

namespace App\Http\Resources\Pengampu;

use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Matakuliah;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PengampuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        $dosen = Dosen::where('id', '=', $this->dosen_id)->first();
        $matkul = Matakuliah::where('id', $this->matakuliah_id)->first();
        $kelas = Kelas::where('id', $this->kelas_id)->first();

        return [
            // 'id' => $this->id,
            // 'dosen' => $dosen,
            // 'matakuliah' => $matkul,
            // 'kelas' => $kelas,
            // 'id_matkul' => $this->matakuliah_id,
        ];
    }
}
