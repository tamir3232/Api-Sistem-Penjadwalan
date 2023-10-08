<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return DB::table('dosens')->get();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required',
            'nip'               => 'required',
        ]);

        // ini cara add
        $add = Dosen::create([
            'name' => $request->name,
            'nip'  => $request->nip,
        ]);

        return $add;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $dosenExist = Dosen::where('id', '=', $id)->first();

        if ($dosenExist) {

            return [
                $dosenExist,
            ];
        }

        return [
            ' Dosen tidak tersedia',
        ];
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $dosenExist = Dosen::where('id', '=', $id)->first();
        if ($request->name) {

            $dosenExist->update([
                'name' => $request->name ?? $dosenExist->name,
                'nip'  => $request->nip ?? $dosenExist->nip,
            ]);
            return [
                'success update',
                $dosenExist,
            ];
        }

        return [
            ' Dosen tidak tersedia',
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dosenExist = Dosen::where('id', '=', $id)->first();

        if ($dosenExist) {
            $dosenExist->delete();
            return [
                'Deleted Dosen',
            ];
        }
        return [
            ' Dosen tidak tersedia',
        ];
    }
}
