<?php

namespace App\Http\Controllers\Pengampu;

use App\Http\Controllers\Controller;
use App\Http\Resources\Pengampu\PengampuResource;
use App\Models\pengampu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PengampuControllers extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengampu = DB::table('pengampu')->get();


        // return PengampuResource::collection($pengampu);
        return $pengampu;
        // new PengampuResource() untuk nampilin 1 data
    }

    public function show(string $id)
    {
        $pengampu = pengampu::where('id', '=', $id)->first();
        if ($pengampu) {
            return new PengampuResource($pengampu);
        }

        return ['Pengampu tidak ada'];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'dosen_id'              => 'required',
            'matakuliah_id'               => 'required',
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

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
