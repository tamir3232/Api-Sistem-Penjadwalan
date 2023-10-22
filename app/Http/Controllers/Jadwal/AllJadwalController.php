<?php

namespace App\Http\Controllers\Jadwal;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Jadwal\JadwalResource;

class AllJadwalController extends Controller
{
    public function index()
    {
        $jadwal = Jadwal::get();
        return JadwalResource::collection($jadwal);
            return $jadwal;
    }
}
