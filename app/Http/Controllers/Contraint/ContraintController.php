<?php

namespace App\Http\Controllers\Contraint;

use App\Models\Contraint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Contraint\ContraintResource;
use App\Http\Resources\Reservasi\ReservasiResource;

class ContraintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 1)
        {
        $contraint = contraint::get();
        return ContraintResource::collection($contraint);
        return $contraint;
        }
        return['Anda tidak memiliki akses'];
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   if (Auth::user()->role == 1)
        {
            $request -> validate(
                ['dosen_id' => 'required',
                    'hari_id' => 'required',
                    'jam_id' => 'required'
            ]);

            $add = Contraint::create(
                ['dosen_id' => $request -> dosen_id,
            'hari_id' => $request -> hari_id,
            'jam_id' => $request -> jam_id
            ]);
            return $add;
        }
        return['Anda tidak memiliki akses'];
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if (Auth::user()->role == 1)
        {
            $contraintexist = Contraint::where('id','=',$id)->first();
                if ($contraintexist)
                {
                return new ContraintResource($contraintexist) ;
            }
            return['Contraint tidak ada'];
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
            $contraintexist = Contraint::where('id',$id)->first();
                if($contraintexist)
                {
                    $contraintexist -> update([
                    'dosen_id' => $request -> dosen_id ?? $contraintexist -> dosen_id,
                    'hari_id' => $request -> hari_id ?? $contraintexist -> hari_id,
                    'jam_id' => $request -> jam_id ?? $contraintexist -> jam_id
                    ]);
                    return ['contraint berhasil di update'];
                }
                return ['Contraint tidak ada'];
        }
        return['Anda tidak memiliki akses'];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        if (Auth::user()->role == 1)
        {
            $contraintexist = Contraint::where('id',$id)->first();
            if($contraintexist)
            {
                $contraintexist -> delete();
                return['Contraint berhasil dihapus'];
            }
            return['contraint tidak ditemukan'];
        }
        return['Anda tidak memiliki akses'];
    }
}
