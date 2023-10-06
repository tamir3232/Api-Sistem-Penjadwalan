<?php

namespace App\Http\Controllers\Contraint;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\Contraint\ContraintResource;
use App\Http\Resources\Reservasi\ReservasiResource;
use App\Models\Contraint;

class ContraintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contraint = DB::table('contraint')->get();
        return ContraintResource::collection($contraint);
        return $contraint;
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate(
            ['pengampu_id' => 'required',
        'hari_id' => 'required',
        'jam_id' => 'required'
        ]);

        $add = Contraint::create(
            ['pengampu_id' => $request -> pengampu_id,
        'hari_id' => $request -> hari_id,
        'jam_id' => $request -> jam_id
        ]);
        return $add;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $contraintexist = Contraint::where('id','=',$id)->first();
            if ($contraintexist)
            {
            return new ContraintResource($contraintexist) ;
        }
        return['Contraint tidak ada'];

    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $contraintexist = Contraint::where('id',$id)->first();
            if($contraintexist)
            {
                $contraintexist -> update([
                'pengampu_id' => $request -> pengampu_id ?? $contraintexist -> pengampu_id,
                'hari_id' => $request -> hari_id ?? $contraintexist -> hari_id,
                'jam_id' => $request -> jam_id ?? $contraintexist -> jam_id
                ]);
                return ['contraint berhasil di update'];
            }
            return ['Contraint tidak ada'];

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $contraintexist = Contraint::where('id',$id)->first();
        if($contraintexist)
        {
            $contraintexist -> delete();
            return['Contraint berhasil dihapus'];
        }
        return['contraint tidak ditemukan'];
    }
}
