<?php

namespace App\Http\Controllers\Kelas;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Kelas\KelasResource;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         if (Auth::user()->role == 1)
        {
            $kelas = DB::table('kelas')->get();
            return KelasResource::collection($kelas);
            return $kelas;
        }
        return['Anda tidak memiliki akses'];
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->role == 1)
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
        return['Anda tidak memiliki akses'];
    }




    /**
     * Display the specified resource.
     */
    public function show($id)
    {   if (Auth::user()->role == 1)
        {
            $kelasexist = Kelas::where('id', '=', $id)->first();
            if ($kelasexist)
            {
                return new KelasResource($kelasexist);
            }
                return ['Kelas tidak ditemukan'];
        }
        return['Anda tidak memiliki akses'];
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->role == 1)
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
        return['Anda tidak memiliki akses'];
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::user()->role == 1)
        {
            $kelasexist = Kelas::where('id', '=', $id)->first();
            if ($kelasexist) {
                $kelasexist->delete();
                return ['kelas berhasil di hapus'];
            }
            return ['kelas tidak ditemukan'];
        }
        return['Anda tidak memiliki akses'];
    }
}
