<?php

namespace App\Http\Controllers\Jam;

use App\Models\Jam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class JamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return DB::table('jam')->first();
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
            'range_jam'=>'required',
            'awal'=>'required',
            'akhir'=>'required'
        ]);

        $add = Jam::create();([
        'range_jam'=>$request->range_jam,
        'awal'=>$request->awal,
        'akhir'=>$request->akhir,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        
    }

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
