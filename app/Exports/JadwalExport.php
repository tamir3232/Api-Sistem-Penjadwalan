<?php

namespace App\Exports;

use App\Models\Hari;
use App\Models\Jadwal;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Http\Resources\Jadwal\JadwalResource;
use Maatwebsite\Excel\Concerns\FromCollection;

class JadwalExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $id;

 function __construct($id) {
        $this->id = $id;
 }
    public function headings(): array
    {
        return [
            'Hari',
            'jam',
            'ruangan',
            'pengampu',
            'reservasi',
        ];
    }

    public function collection()
    {
        $jadwalData = DB::table('jadwal')
            ->join('hari', 'jadwal.hari_id', '=', 'hari.id')
            ->join('ruangan', 'jadwal.ruangan_id', '=', 'ruangan.id')
            ->join('pengampu', 'jadwal.pengampu_id', '=', 'pengampu.id')
            ->join('jam', 'jadwal.jam_id', '=','jam_id')
            ->join('dosens', 'pengampu.dosen_id', '=', 'dosens.id')

            ->select(
                'hari.nama as hari_nama',
                DB::raw('CONCAT(jam.awal, \' - \', jam.akhir) as jam_range'), // Menggunakan tanda kutip tunggal
                'ruangan.nama as ruangan_nama',
                'dosens.name as dosens_name',
                'jadwal.reservasi_id',
            )
            ->get();

        return $jadwalData;
    }





}
