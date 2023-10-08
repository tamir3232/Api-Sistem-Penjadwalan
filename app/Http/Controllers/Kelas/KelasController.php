<?php

namespace App\Http\Controllers\Kelas;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\Kelas\KelasResource;
use App\Http\Resources\Jadwal\JadwalResource;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = DB::table('kelas')->get();
        return KelasResource::collection($kelas);
        return $kelas;
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required',
            'semester'  => 'required'

        ]);
        $add = Kelas::create([
            'nama'      => $request->nama,
            'semester'  => $request->semester,

        ]);
        return $add;
    }




    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kelasexist = Kelas::where('id', '=', $id)->first();
        if ($kelasexist)
            {
            return new KelasResource($kelasexist);
            }

            return ['Kelas tidak ditemukan'];
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kelasexist = Kelas::where('id', '=', $id)->first();
        if ($kelasexist) {
            $kelasexist->update([
                'nama' => $request->nama ?? $kelasexist->name,
                'semester' => $request->semester ?? $kelasexist->semester,
            ]);
            return ['berhasil di update', $kelasexist];
        }

            return ['Kelas tidak ditemukan'];
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kelasexist = Kelas::where('id', '=', $id)->first();
        if ($kelasexist) {
            $kelasexist->delete();
            return ['kelas berhasil di hapus'];
        }
        return ['kelas tidak ditemukan'];
    }
}
