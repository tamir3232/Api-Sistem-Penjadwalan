<?php

namespace App\Http\Controllers\Jam;

use App\Models\Jam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\Jam\JamResources;

class JamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jam =  DB::table('jam')->get();
        return JamResources::collection($jam);
        return $jam;
    }



    public function store(Request $request)
    {
        $request->validate([
            'range_jam'=>'required',
            'awal'=>'required',
            'akhir'=>'required'
        ]);

        $add = Jam::create([
        'range_jam'=>$request->range_jam,
        'awal'=>$request->awal,
        'akhir'=>$request->akhir,
        ]);
        return $add;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $jamexist=Jam::where('id','=',$id)->first();
        if ($jamexist)
            {
                return new JamResources($jamexist);
            };
        return ['jam tidak tersedia'];
}



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $jamexist = Jam::where('id','=',$id)->first();
        if ($jamexist)
        {$jamexist -> update(
        [
            'awal' => $request->awal ?? $jamexist ->awal,
            'range_jam' => $request -> range_jam ?? $jamexist -> range_jam,
            'akhir' => $request-> akhir ?? $jamexist ->akhir,
        ]);return['Update success'];
         }
         return['Jam tidak ditemukan'];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jamexist = Jam::where('id','=',$id)->first();
        if ($jamexist)
        {
            $jamexist -> delete();
            return ['Jam berhasil di hapus'];
        }
        return['jam tidak ditemukan'];
    }


}
