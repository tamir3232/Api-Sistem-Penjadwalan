<?php

namespace App\Exports;

use App\Models\Hari;
use App\Models\Jadwal;
use App\Models\Jam;
use App\Models\Ruangan;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class JadwalExport implements FromCollection, WithHeadings, WithMapping
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
        $jadwals = Jadwal::with(['hari', 'jam', 'ruangan'])->get();

        // Lakukan pengurutan berdasarkan nama hari, ruangan, dan jam
        $sortedJadwals = $jadwals->sort(function ($a, $b) {
            // Urutkan berdasarkan hari
            $daysOrder = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
            $aDayIndex = array_search($a->hari->nama, $daysOrder);
            $bDayIndex = array_search($b->hari->nama, $daysOrder);

            // Jika hari berbeda, kembalikan perbandingan berdasarkan urutan hari
            if ($aDayIndex !== $bDayIndex) {
                return $aDayIndex - $bDayIndex;
            }

            // Jika hari sama, lanjutkan dengan pengurutan berdasarkan ruangan
            $roomsOrder = ['101', '102', '103', '104', '105', '106'];
            $aRoomIndex = array_search($a->ruangan->nama, $roomsOrder);
            $bRoomIndex = array_search($b->ruangan->nama, $roomsOrder);

            // Jika ruangan berbeda, kembalikan perbandingan berdasarkan urutan ruangan
            if ($aRoomIndex !== $bRoomIndex) {
                return $aRoomIndex - $bRoomIndex;
            }

            // Jika ruangan sama, lanjutkan dengan pengurutan berdasarkan jam

            // Jika ruangan sama, lanjutkan dengan pengurutan berdasarkan jam
            $timesOrder = [
                '08:00', '08:50', '09:40', '10:30', '11:20', '12:10',
                '13:00', '13:50', '14:40', '15:30', '16:20'
            ];
            $aTimeIndex = array_search($a->jam->awal, $timesOrder);
            $bTimeIndex = array_search($b->jam->awal, $timesOrder);

            // Kembalikan perbandingan berdasarkan urutan jam
            return $aTimeIndex - $bTimeIndex;
        });

        // Ambil hasil pengurutan
        $sortedJadwals->values()->all();
        return $sortedJadwals;
    }

    public function map($jadwal): array
    {
        return [
            'Hari' => $jadwal->hari->nama,
            'Jam' => $jadwal->jam->awal . ' - ' . $jadwal->jam->akhir,
            'Ruangan' => $jadwal->ruangan->nama,
            'Dosen' => $jadwal->pengampu->dosen->name,
            'Mata Kuliah' => $jadwal->pengampu->matakuliah->kode_matkul . '-' . $jadwal->pengampu->matakuliah->nama,
            'Kelas' => $jadwal->pengampu->kelas->nama . ' Semester ' . $jadwal->pengampu->kelas->semester,
        ];
    }
}
