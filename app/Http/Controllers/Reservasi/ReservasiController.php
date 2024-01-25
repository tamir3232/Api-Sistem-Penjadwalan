<?php

namespace App\Http\Controllers\Reservasi;

use Exception;
use App\Models\User;
use App\Models\Jadwal;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Reservasi\ReservasiResource;

class ReservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservasi = Reservasi::orderBy('created_at', 'desc')->get();
        if ($reservasi) {
            return ReservasiResource::collection($reservasi);
        }
        return response()->json(array(
            'message' => 'Reservasi tidak ditemukan',
            'status' => 'not found',
            'code' => 500,
        ));
        // var_dump($reservasi);
        // exit;



    }

    public function MyReservasi()
    {

        $reservasi = Reservasi::where('reservasiby_id', Auth::user()->id)->get();
        if ($reservasi) {
            return ReservasiResource::collection($reservasi);
        }
        return response()->json(array(
            'message' => 'Reservasi tidak ditemukan',
            'status' => 'not found',
            'code' => 500,
        ));
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reservasiexist = Reservasi::where('id', $id)->first();
        if ($reservasiexist) {
            return new ReservasiResource($reservasiexist);
        }
        return ['Reservasi tidak ditemukan'];
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $reservasiexist = Reservasi::where('reservasiby_id', $request->resevasiby_id);
        //  if (Auth::user()-> id ==  $reservasiexist)
        //  {
        $request->validate([
            'hari_id'           => 'required',
            'jam_id'            => 'required',
            'ruangan_id'        => 'required',
            'pengampu_id'       => 'required',
            'tanggal_reservasi' => 'required'

        ]);


        $jadwalExist = Jadwal::where('hari_id', $request->hari_id)->where('jam_id', $request->jam_id)->where('ruangan_id', $request->ruangan_id)->first();

        if ($jadwalExist) {
            throw new Exception('Jadwal Dimasukan Oleh Admin Tidak Tersedia Lagi, Silahkan Reservasi Jadwal Yang kosong');
        }

        $add = Reservasi::create([
            'hari_id'           => $request->hari_id ?? null,
            'jam_id'            => $request->jam_id ?? null,
            'ruangan_id'        => $request->ruangan_id ?? null,
            'pengampu_id'       => $request->pengampu_id ?? null,
            'tanggal_reservasi' => $request->tanggal_reservasi ?? null,
            'reservasiby_id'    => Auth::user()->id,
            'status'            => NULL,

        ]);
        return $add;
        //  }
        //  return['Anda tidak bisa mengakses'];
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $reservasiexist = Reservasi::where('id', $id)->first();

        if ($request->status == 'Diterima') {

            $jadwalExist = Jadwal::where('hari_id', $reservasiexist->hari_id)->where('jam_id', $reservasiexist->jam_id)->where('ruangan_id', $reservasiexist->ruangan_id)->first();

            if ($jadwalExist) {
                throw new Exception('JADWAL YANG DIINPUTKAN TIDAK TERSEDIA LAGI');
            }
        }

        if ($reservasiexist) {
            $reservasiexist->update([
                'hari_id'           => $request->hari_id ?? $reservasiexist->hari_id,
                'jam_id'            => $request->jam_id ?? $reservasiexist->jam_id,
                'ruangan_id'        => $request->ruangan_id ?? $reservasiexist->ruangan_id,
                // 'dosen_id'       => $request->dosen_id ?? $reservasiexist->dosen_id,
                'pengampu_id'       => $request->pengampu_id ?? $reservasiexist->pengampu_id,
                'tanggal_reservasi' => $request->tanggal_reservasi ?? $reservasiexist->tanggal_reservasi,
                // 'status'            => $request->status ?? $reservasiexist->status,
            ]);
            return ['Pengampu berhasil di update'];
        }
        return ['Pengampu tidak ditemukan'];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $reservasiexist = Reservasi::where('id', '=', $id)->first();
        if ($reservasiexist) {
            $reservasiexist->delete();
            return ['Reservasi berhasil dihapus'];
        }
        return ['Reservasi tidak ditemukan'];
    }
}
