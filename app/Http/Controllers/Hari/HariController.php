<?php

namespace App\Http\Controllers\Hari;

use App\Models\Hari;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Hari\HariResources;

class HariController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 1)
        {
            $hari = DB::table('hari')->get();
            return HariResources::collection($hari);
            return $hari;
        }
        return['Anda tidak memiliki akses'];
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {  if (Auth::user()->role == 1)
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
        return['Anda tidak memiliki akses'];
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {   if (Auth::user()->role == 1)
        {
            $hariexisted = Hari::where('id','=',$id)->first();
            if ($hariexisted)
        {
             return new HariResources($hariexisted);
        };
            return ['Hari tidak di temukan',];
        }
        return['Anda tidak memiliki akses',];
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   if (Auth::user()->role == 1)
            {
            $hariexisted = Hari::where('id','=',$id)->first();
            if ($hariexisted){
                $hariexisted->update([
                    'nama'=>$request -> nama ?? $hariexisted -> nama,
                ]);
                return ['Update success',];
            }
            return ['Hari tidak ditemukan',];
            }
        return['Anda tidak memiliki akses'];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {   if (Auth::user()->role == 1)
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
        return['Anda tidak memiliki akses',];
    }
}
