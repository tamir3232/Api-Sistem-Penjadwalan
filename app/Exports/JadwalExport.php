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
            'Jam',
            'Ruangan',
            'Dosen',
            'Matakuliah',
            'Kelas',
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
            ->join('matakuliah', 'pengampu.matakuliah_id', '=', 'matakuliah.id')
            ->join('kelas', 'pengampu.kelas_id', '=', 'kelas.id')
            // ->join('dosens', 'pengampu.dosen_id', '=', 'dosens.id')

            ->select(
                'hari.nama as hari_nama',
                DB::raw('CONCAT(jam.awal, \' - \', jam.akhir) as jam_range'), // Menggunakan tanda kutip tunggal
                'ruangan.nama as ruangan_nama',
                'dosens.name as dosens_name',
                DB::raw('CONCAT(matakuliah.kode_matkul, \' - \' ,matakuliah.nama) as matakuliah_range'),
                DB::raw('CONCAT(kelas.nama, \'  Semester \', kelas.semester) as kelas_range'),


                
            )
            ->get();

        return $jadwalData;
    }





}
