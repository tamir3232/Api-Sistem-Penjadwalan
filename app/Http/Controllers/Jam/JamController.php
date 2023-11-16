<?php

namespace App\Http\Controllers\Jam;

use App\Models\Jam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Jam\JamResources;

class JamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // if (Auth::user()->role == 1)
        // {
        $jam =  DB::table('jam')->orderBy('awal')->get();
        return JamResources::collection($jam);
        return $jam;
        // }
        // return['Anda tidak memiliki akses'];
    }



    public function store(Request $request)
    {
        if (Auth::user()->role == 1) {
            $request->validate([
                'range_jam' => 'required',
                'awal' => 'required',
                'akhir' => 'required'
            ]);

            $add = Jam::create([
                'range_jam' => $request->range_jam,
                'awal' => $request->awal,
                'akhir' => $request->akhir,
            ]);
            return $add;
        }
        return ['Anda tidak memiliki akses'];
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if (Auth::user()->role == 1) {
            $jamexist = Jam::where('id', '=', $id)->first();
            if ($jamexist) {
                return new JamResources($jamexist);
            };
            return ['jam tidak tersedia'];
        }
        return ['Anda tidak memiliki akses'];
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->role == 1) {
            $jamexist = Jam::where('id', '=', $id)->first();
            if ($jamexist) {
                $jamexist->update(
                    [
                        'awal' => $request->awal ?? $jamexist->awal,
                        'range_jam' => $request->range_jam ?? $jamexist->range_jam,
                        'akhir' => $request->akhir ?? $jamexist->akhir,
                    ]
                );
                return ['Update success'];
            }
            return ['Jam tidak ditemukan'];
        }
        return ['Anda tidak memiliki akses'];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::user()->role == 1) {
            $jamexist = Jam::where('id', '=', $id)->first();
            if ($jamexist) {
                $jamexist->delete();
                return ['Jam berhasil di hapus'];
            }
            return ['jam tidak ditemukan'];
        }
        return ['Anda tidak memiliki akses'];
    }
}
