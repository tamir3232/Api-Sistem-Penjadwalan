<?php

namespace App\Http\Controllers\Ruangan;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return DB::table('ruangan')->first();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        $add = Ruangan::create([
            'nama'=>$request->nama,
        ]);
        return $add;

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $ruanganexist = Ruangan::where('id','=',$id);
        
            if ($ruanganexist=$id)
            {
            return [$ruanganexist,];
        }
        return ('Ruangan tidak ditemukan');
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $ruanganexist = Ruangan::where('id','=',$id);

        if ($ruanganexist=$id)
        {
           $ruanganexist->updata([
            'nama'=> $request -> nama ?? $ruanganexist ->nama
           ]);
        
        }
        return ['ruangan tidak ditemukan'];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ruanganexist = Ruangan::where('id','=',$id);
        if ($ruanganexist = $id);
        {$ruanganexist->delete();
            return ['ruangan telah di hapus'];
        }
        return ['ruangan tidak di temukan'];
    }
}
