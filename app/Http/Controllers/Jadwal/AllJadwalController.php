<?php

namespace App\Http\Controllers\Jadwal;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Jadwal\JadwalResource;
use App\Models\Hari;



class AllJadwalController extends Controller
{
    public function index(Request $request)
    {
        $hari = Hari::where('nama', $request->hari)->first();
        if (!$hari){
            return [];
        }
        $jadwal = Jadwal::where('hari_id', $hari->id)->get();
        return JadwalResource::collection($jadwal);
    }
}
