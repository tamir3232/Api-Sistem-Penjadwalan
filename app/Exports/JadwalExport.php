<?php

namespace App\Exports;

use App\Models\Jadwal;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class JadwalExport implements FromCollection,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
   use Exportable;
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

        return Jadwal::orderBy('hari_id')->orderBy('jam_id')->orderBy('ruangan_id')->get();
        // return Jadwal::orderBy('jadwal')->get();

    }

    public function map($jadwal): array
    {
        return[
            'Hari' => $jadwal->hari->nama,
            'Jam' => $jadwal->jam->awal . ' - ' . $jadwal->jam->akhir,
            'Ruangan' => $jadwal->ruangan->nama,
            'Dosen' => $jadwal->pengampu->dosen->name,
            'Mata Kuliah' => $jadwal->pengampu->matakuliah->kode_matkul.'-'.$jadwal->pengampu->matakuliah->nama,
            'Kelas' => $jadwal->pengampu->kelas->nama.' Semester '.$jadwal->pengampu->kelas->semester,
        ];
    }







}
