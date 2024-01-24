<?php

namespace App\Http\Controllers\Reset;

use App\Models\Kelas;
use App\Models\Jadwal;
use App\Models\pengampu;
use App\Models\Contraint;
use App\Models\Reservasi;
use App\Models\Matakuliah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ResetController extends Controller
{
    public function reset()

    {
    // user
    // dosen
    //ruangan
    // hari
    // jam

    if (Auth::user()->role == 1) {
    Jadwal::truncate();
    Contraint::truncate();
    Reservasi::truncate();
    pengampu::truncate();
    // Kelas::truncate();
    // Matakuliah::truncate();

    return response()->json(array(
        'message'   => 'reset berhasil',
        'code'      => 200,
        'status'    => 'success',
    ));
    }
    return response()->json(array(
        'message'   => 'Anda tidak memiliki akses',
        'code'      => 401,
        'status'    => 'does not have access',
    ));






    }

}
