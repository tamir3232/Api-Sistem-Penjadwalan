<?php

namespace App\Http\Controllers\Dosen;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Dosen\DosenResource;



class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            $dosen = DB::table('dosens')->get();
            return DosenResource::collection($dosen);
            return $dosen;
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->role == 1)
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
       return['Anda tidak memiliki akses'];
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
            $dosenExist = Dosen::where('id', '=', $id)->first();

            if ($dosenExist){
                    return new DosenResource($dosenExist);
                };
            return['Dosen tidak tersedia',];
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        if (Auth::user()->role == 1)
        {
            $dosenExist = Dosen::where('id', '=', $id)->first();
            if ($dosenExist)
            {
                $dosenExist->update([
                'name' => $request->name ?? $dosenExist->name,
                'nip'  => $request->nip ?? $dosenExist->nip,
                ]);
                return['success update',$dosenExist,];
            }
            return['Dosen tidak tersedia',];
        }
        return['Anda tidak mempunyai akses'];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (Auth::user()->role == 1)
        {
            $dosenExist = Dosen::where('id', '=', $id)->first();
            if ($dosenExist) {
                $dosenExist->delete();
                return ['Dosen berhasil di hapus',];
            }
            return ['Dosen tidak tersedia',];
        }
        return ['Anda tidak memiliki akses',];
    }
}
