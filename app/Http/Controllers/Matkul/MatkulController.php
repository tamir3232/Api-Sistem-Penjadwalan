<?php

namespace App\Http\Controllers\Matkul;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Matkul;

class MatkulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return DB::table('matkuls')->get();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode'            =>'required',
            'semester'              =>'required',
            'sks'                   =>'required',
            'nama'            =>'required',
            'status'                =>'required'
        ]);


        $add = Matkul::create([
            'kode'    =>$request ->kode,
            'semester'      =>$request ->semester,
            'sks'           =>$request ->sks,
            'nama'    =>$request ->nama,
            'status'        =>$request ->status,

        ]);

        return $add;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $matkulExist = Matkul::where('id','=',$id)->first();
        if($matkulExist){
            return [$matkulExist];
        };
        return['Mata kuliah tidak tersedia'];
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $matkulExist = Matkul::where('id','=',$id)->first();
        if($matkulExist=$id)
        {
            $matkulExist->update([
            'kode'          =>$request->kode_matkul ?? $matkulExist -> kode,
            'semester'      =>$request->semester ?? $matkulExist -> semester,
            'sks'           =>$request->sks ?? $matkulExist -> sks,
            'nama'          =>$request->nama ?? $matkulExist -> nama,
            'status'        =>$request->status ?? $matkulExist -> status
            ]);
            return['Mata Kuliah berhasil diubah', $matkulExist];
        }
        return['Mata kuliah tidak ditemukan'];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $matkulExist = Matkul::where('id','=',$id)->first();
        {
            $matkulExist->delete();
            return ['Mata kuliah berhasil di hapus'];
        }
        return ['Mata kuliah tidak ditemukan'];
    }
}
