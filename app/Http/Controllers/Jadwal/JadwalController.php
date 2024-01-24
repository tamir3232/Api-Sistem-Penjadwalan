<?php

namespace App\Http\Controllers\Jadwal;

use App\Models\Hari;
use App\Models\Jadwal;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use App\Exports\ExportJadwal;
use App\Exports\JadwalExport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Resources\Jadwal\JadwalResource;


class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function export(Request $request)
    {
         $excel = Excel::download(new JadwalExport($request->id),"Jadwal Perkuliahan.xlsx");
         if ($excel){
            return response()->json([
                'code' => 302,
                'message' => 'excel tersedia',
            ]);
         }
         return response()->json([
            'code' => 404,
            'message' => 'excel tidak ditemukan',
         ]);
     }



    public function index(Request $request)
    // {   if (Auth::user()->role == 1)
    {
        if ($request->hari) {
            $hari = Hari::where('nama', $request->hari)->first();
            $reservasi = Reservasi::where('tanggal_reservasi', $request->tanggal_reservasi)->get();
            if (count($reservasi) > 0) {
                $reservasiIds = $reservasi->pluck('id')->toArray();
                $jadwal = Jadwal::where('hari_id', $hari->id)->Where('reservasi_id', null)->orWhereIn('reservasi_id', $reservasiIds)->get();
            } else {
                $jadwal = Jadwal::where('hari_id', $hari->id)->where('reservasi_id', null)->get();
            }
        } else {
            $jadwal = Jadwal::get();
        }

        if (!$hari){
            return[];
        }
        return JadwalResource::collection($jadwal);
        // }
        // return['Anda tidak memiliki akses'];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->role == 1) {
            $request->validate([
                'hari_id' => 'required',
                'jam_id' => 'required',
                'ruangan_id' => 'required',
                'pengampu_id' => 'required',

            ]);
            $add = Jadwal::create([
                'hari_id'       => $request->hari_id,
                'jam_id'        => $request->jam_id,
                'ruangan_id'    => $request->ruangan_id,
                'pengampu_id'   => $request->pengampu_id,
                'reservasi_id'   => $request->reservasi_id ?? NULL,
            ]);
            return $add;
        }
        return ['Anda tidak memiliki akses',];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Auth::user()->role == 1) {
            $jadwalexist = Jadwal::where('id', $id)->first();
            if ($jadwalexist) {
                return new JadwalResource($jadwalexist);
            }
            return ['jadwal tidak ditemukan'];
        }
        return ['Anda tidak memiliki akses',];
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Auth::user()->role == 1) {
            $jadwalexist = Jadwal::where('id', $id)->first();
            if ($jadwalexist) {
                $jadwalexist->update([
                    'hari_id'       => $request->hari_id ?? $jadwalexist->hari_id,
                    'jam_id'        => $request->jam_id ?? $jadwalexist->jam_id,
                    'ruangan_id'    => $request->ruangan_id  ?? $jadwalexist->ruangan_id,
                    'pengampu_id'   => $request->pengampu_id ?? $jadwalexist->pengampu_id,
                    'reservasi_id'  => $request->reservasi_id ?? $jadwalexist->reservasi_id
                ]);
                return ['jadwal berhasil di update', $jadwalexist,];
            }
            return ['Jadwal tidak ditemukan'];
        }
        return ['Anda tidak memiliki akses'];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::user()->role == 1) {
            $jadwalexist = Jadwal::where('id', '=', $id)->first();
            if ($jadwalexist) {
                $jadwalexist->delete();
                return ['Jadwal berhasil di hapus'];
            }
            return ['jadwal tidak ditemukan'];
        }
        return ['Anda tidak memiliki akses'];
    }
}
