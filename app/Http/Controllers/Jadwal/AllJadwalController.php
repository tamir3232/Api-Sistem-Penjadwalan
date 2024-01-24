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
        $excel = Excel::download(new JadwalExport($request->id), "Jadwal Perkuliahan.xlsx");
        if ($excel) {
            return response()->json([
                'code' => 302,
                'message' => 'excel tersedia',
                'data' => $excel
            ]);
        }
        return response()->json([
            'code' => 404,
            'message' => 'excel tidak ditemukan',
        ]);
    }
    public function index(Request $request)
    {
        $hari = Hari::where('nama', $request->hari)->first();
        if (!$hari) {
            return [];
        }
        $jadwal = Jadwal::where('hari_id', $hari->id)->get();
        return JadwalResource::collection($jadwal);
    }
}
