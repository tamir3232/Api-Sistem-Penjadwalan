<?php

namespace App\Http\Controllers\Jadwal;

use App\Exports\JadwalExport;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Jadwal\JadwalResource;
use App\Models\Hari;



class AllJadwalController extends Controller
{

    public function export(Request $request)
    {


        return Excel::download(new JadwalExport, "Jadwal Perkuliahan.xlsx");

    }
    public function index(Request $request)
    {
        $hari = Hari::where('nama', $request->hari)->first();
        if (!$hari) {
            return JadwalResource::collection([]);
        }
        $jadwal = Jadwal::where('hari_id', $hari->id)->get();
        return JadwalResource::collection($jadwal);
    }
}
