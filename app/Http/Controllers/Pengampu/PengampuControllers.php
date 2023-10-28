<?php

namespace App\Http\Controllers\Pengampu;

use App\Models\pengampu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Pengampu\PengampuResource;


class PengampuControllers extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { {
            $pengampu = Pengampu::get();
            return PengampuResource::collection($pengampu);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->role == 1) {
            $request->validate([
                'dosen_id'              => 'required',
                'matakuliah_id'         => 'required',
                'kelas_id'              => 'required'
            ]);

            // ini cara add
            $add = pengampu::create([
                'dosen_id' => $request->dosen_id,
                'matakuliah_id'  => $request->matakuliah_id,
                'kelas_id'  => $request->kelas_id,
            ]);
            return $add;
        }
        return ['Anda tidak memiliki akses'];
    }

    public function show(string $id)
    {
        if (Auth::user()->role == 1) {
            $pengampu = pengampu::where('id', '=', $id)->first();
            if ($pengampu) {
                return new PengampuResource($pengampu);
            }
            return ['Pengampu tidak ada'];
        }
        return ['Anda tidak memiliki akses'];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->role == 1) {
            $pengampuexist = Pengampu::where('id', $id)->first();
            if ($pengampuexist) {
                $pengampuexist->update([
                    'dosen_id' => $request->dosen_id ?? $pengampuexist->dosen_id,
                    'matakuliah_id'  => $request->matakuliah_id ?? $pengampuexist->matakuliah_id,
                    'kelas_id'  => $request->kelas_id ?? $pengampuexist->kelas_id
                ]);
                return ['Pengampu berhasil di update'];
            }
            return ['Pengampu tidak ditemukan'];
        }
        return ['Anda tidak memiliki akses'];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (Auth::user()->role == 1) {
            $pengampuexist = Pengampu::where('id', '=', $id)->first();
            if ($pengampuexist) {
                $pengampuexist->delete();
                return ['Pengampu berhasil dihapus',];
            }
            return ['Pengampu tidak ditemukan'];
        }
        return ['Anda tidak memiliki akses'];
    }
}
