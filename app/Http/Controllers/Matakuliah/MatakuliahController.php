<?php

namespace App\Http\Controllers\Matakuliah;

use App\Models\Matakuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return DB::table('matakuliah')-> all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'nama' => 'required',
            'kode_matkul' => 'required',
            'semester' => 'required',
            'sks' => 'required',
            'status' => 'required'
        ]);
        $add = Matakuliah::create([
            'nama' => $request -> nama,
            'kode_matkul' => $request -> kode_matkul,
            'semester' => $request -> semester,
            'sks' => $request -> sks,
            'status' => $request -> status

        ]);
        return $add;

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $matkulExist = Matakuliah::where('id','=',$id)->first();
        if($matkulExist){
            return [$matkulExist];
        }
        return ['Matakuliah tidak ditemukan'];
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $matkulExist = Matakuliah::where('id','=',$id)-> first();

        if ($matkulExist){
            $matkulExist-> update ([
                'nama' => $request -> nama ?? $matkulExist -> nama,
                'kode_matkul'=> $request -> kode_matkul ?? $matkulExist -> kode_matkul,
                'sks'=> $request -> sks ?? $matkulExist -> sks,
                'semester'=> $request -> semester ?? $matkulExist -> semester,
                'status'=> $request -> status ?? $matkulExist -> status,
            ]);
            return [
                'success update ',$matkulExist
            ];
        }
        return ['Update gagal'];


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $matkulExist = Matakuliah::where('id','=',$id)->first();
        $matkulExist -> delete();
            return[
             'Matakuliah berhasil dihapus'
            ];
        return ['Matakuliah tidak ditemukan'];

    }
}
