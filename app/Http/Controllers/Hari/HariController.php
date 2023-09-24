<?php

namespace App\Http\Controllers\Hari;

use App\Models\Hari;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HariController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return DB::table('hari')->all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'=> 'required',
        ]);
        $add = Hari::create
        ([
            'nama'=> $request ->nama,

        ]);
        return $add;

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $hariexisted = Hari::where('id','=',$id)->first();
        if ($hariexisted){
            return[$hariexisted];

        };
        return ['Hari tidak di temukan'];

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $hariexisted = Hari::where('id','=',$id)->first();
        if ($hariexisted){
            $hariexisted->update([
                'nama'=>$request -> nama ?? $hariexisted -> nama,
            ]);
            return ['Update success'];
        }
        return ['Hari tidak ditemukan'];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hariexisted = Hari::where('id','=',$id)->first();
        if ($hariexisted){
            $hariexisted->delete();
            {
                return['Hari berhasil di hapus'];
            }
        }
        return ['Hari tidak di temukan'];
    }
}
