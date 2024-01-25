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





    public function index(Request $request)
    // {   if (Auth::user()->role == 1)
    {
        if ($request->hari) {
            $hari = Hari::where('nama', $request->hari)->first();
            if (!$hari) {
                return JadwalResource::collection([]);
            }
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
            $jadwalExist = Jadwal::where('hari_id', $request->hari_id)->where('jam_id', $request->jam_id)->where('ruangan_id', $request->ruangan_id)->first();
            if ($jadwalExist) {
                return response()->json([
                    'message' => 'Jadwal Dimasukan Tidak Tersedia Lagi, Silahkan Reservasi Jadwal Yang kosong',
                    'status' => 'bad request',
                    'code' => 400,
                ], 400);
            }
            $add = Jadwal::create([
                'hari_id'       => $request->hari_id,
                'jam_id'        => $request->jam_id,
                'ruangan_id'    => $request->ruangan_id,
                'pengampu_id'   => $request->pengampu_id,
                'reservasi_id'   => $request->reservasi_id ?? NULL,
            ]);
            return $add;
        }
        // return response()->json([
        //     'message' => 'Anda Tidak Memiliki Akses',
        //     'status' => 'Unauthorized',
        //     'code' => 401,
        // ]);
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
        DB::beginTransaction();
        if (Auth::user()->role == 1) {
            $jadwalexist = Jadwal::where('id', $id)->first();

            if ($jadwalexist) {
                DB::table('jadwal')->where('id', $id)->update([
                    'hari_id'       => $request->hari_id ?? $jadwalexist->hari_id,
                    'jam_id'        => $request->jam_id ?? $jadwalexist->jam_id,
                    'ruangan_id'    => $request->ruangan_id  ?? $jadwalexist->ruangan_id,
                    'pengampu_id'   => $request->pengampu_id ?? $jadwalexist->pengampu_id,
                    'reservasi_id'  => $request->reservasi_id ?? $jadwalexist->reservasi_id
                ]);
                $jadwalexist = Jadwal::where('id', $id)->first();
                $checkedJadwal = Jadwal::where('hari_id', $jadwalexist->hari_id)->where('jam_id', $jadwalexist->jam_id)->where('ruangan_id', $jadwalexist->ruangan_id)->where('id', '!=', $jadwalexist->id)->first();

                if ($checkedJadwal) {
                    DB::rollBack();
                    return response()->json([
                        'message' => 'Jadwal Dimasukan Tidak Tersedia Lagi, Silahkan Reservasi Jadwal Yang kosong',
                        'status' => 'bad request',
                        'code' => 400,
                    ], 400);
                }
                DB::commit();
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
            return ['Jadwal tidak ditemukan'];
        }
        return ['Anda tidak memiliki akses'];
    }
}
