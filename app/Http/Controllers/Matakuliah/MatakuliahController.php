<?php

namespace App\Http\Controllers\Matakuliah;

use App\Models\Matakuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\matkul\RuanganResource;
use App\Http\Resources\Matakuliah\MatakuliahResources;

class MatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 1)
        {
            $matkul = DB::table('matakuliah')->get();
            return MatakuliahResources::collection($matkul);
            return $matkul;
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
                'nama' => 'required',
                'kode_matkul' => 'required',
                'semester' => 'required',
                'sks' => 'required',
                'status' => 'required'
            ]);
            $add = Matakuliah::create([
                'nama' => $request->nama,
                'kode_matkul' => $request->kode_matkul,
                'semester' => $request->semester,
                'sks' => $request->sks,
                'status' => $request->status

            ]);
            return $add;
        }
        return['Anda tidak memiliki akses'];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Auth::user()->role == 1)
        {
            $matkulExist = Matakuliah::where('id', '=', $id)->first();
            if ($matkulExist) {
                return new MatakuliahResources($matkulExist);
            }
            return ['Matakuliah tidak ditemukan'];
        }
        return['Anda tidak memiliki akses'];
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Auth::user()->role == 1)
        {
            $matkulExist = Matakuliah::where('id', '=', $id)->first();
            if ($matkulExist) {
                $matkulExist->update([
                    'nama' => $request->nama ?? $matkulExist->nama,
                    'kode_matkul' => $request->kode_matkul ?? $matkulExist->kode_matkul,
                    'sks' => $request->sks ?? $matkulExist->sks,
                    'semester' => $request->semester ?? $matkulExist->semester,
                    'status' => $request->status ?? $matkulExist->status,
                ]);
                    return ['success update ', $matkulExist];
                }
                    return ['Matakuliah tidak ditemukan'];
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
            $matkulExist = Matakuliah::where('id', '=', $id)->first();
            if($matkulExist){
            $matkulExist->delete();
            return ['Matakuliah berhasil dihapus'];
            }
            return ['Matakuliah tidak ditemukan'];
        }
        return['Anda tidak memiliki akses'];
    }
}
