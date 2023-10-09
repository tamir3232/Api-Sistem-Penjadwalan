<?php

namespace App\Http\Controllers\Jadwal;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\Jadwal\JadwalResource;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwal = DB::table('jadwal')->get();
        return JadwalResource::collection($jadwal);
        return $jadwal;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate([
            'hari_id'=> 'required',
            'jam_id'=> 'required',
            'ruangan_id'=> 'required',
            'pengampu_id'=> 'required',
            'reservasi_id'=> 'required'
        ]);
        $add = Jadwal::create([
        'hari_id'=>$request -> hari_id,
        'jam_id' =>$request -> jam_id,
        'ruangan_id'=> $request -> ruangan_id,
        'pengampu_id'=> $request -> pengampu_id,
        'reservasi_id'=> $request -> reservasi_id
        ]);
        return $add;

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jadwalexist = Jadwal::where('id',$id)->first();
        if ($jadwalexist){
            return new JadwalResource($jadwalexist);
        }
        return['jadwal tidak ditemukan'];
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jadwalexist = Jadwal::where('id',$id)->first();
        if ($jadwalexist)
        {
        $jadwalexist -> update([
            'hari_id'       =>$request -> hari_id ?? $jadwalexist -> hari_id,
            'jam_id'        =>$request -> jam_id ?? $jadwalexist ->jam_id,
            'ruangan_id'    =>$request -> ruangan_id  ?? $jadwalexist -> ruangan_id,
            'pengampu_id'   =>$request -> pengampu_id ?? $jadwalexist -> pengampu_id,
            'reservasi_id'  =>$request -> reservasi_id ?? $jadwalexist -> reservasi_id
            ]);
            return['jadwal berhasil di update',$jadwalexist,];
        }
        return['Jadwal tidak ditemukan'];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jadwalexist = Jadwal::where('id','=',$id)->first();
        if ($jadwalexist){
            $jadwalexist->delete();
                return['Jadwal berhasil di hapus'];
        }
        return ['jadwal tidak ditemukan'];
    }
}
