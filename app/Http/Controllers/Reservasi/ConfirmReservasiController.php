<?php

namespace App\Http\Controllers\Reservasi;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Reservasi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfirmReservasiController extends Controller
{
    public function confirm(Request $request)
    {
        if (Auth::user()->role == 1) {
            $Reservasi = Reservasi::where('id', $request->id)->first();
            // var_dump($Reservasi)
            if ($request->status == 'Diterima') {

                $jadwalExist = Jadwal::where('hari_id', $Reservasi->hari_id)->where('jam_id', $Reservasi->jam_id)->where('ruangan_id', $Reservasi->ruangan_id)->first();

                if ($jadwalExist) {
                    throw new Exception('Jadwal Dimasukan Tidak Tersedia Lagi, Silahkan Reservasi Jadwal Yang kosong');
                } else {
                    $addJadwal = Jadwal::create([
                        'hari_id'       => $Reservasi->hari_id,
                        'jam_id'        => $Reservasi->jam_id,
                        'ruangan_id' => $Reservasi->ruangan_id,
                        'pengampu_id' => $Reservasi->pengampu_id,
                        'reservasi_id' => $Reservasi->id,
                    ]);
                }
            }
            if ($Reservasi) {
                $Reservasi->update([
                    'status' => $request->status ?? $Reservasi->status,
                ]);
                return ['Reservasi berhasil di update'];
            }
            return ['Reservasi tidak ditemukan'];
        }
        return ["anda tidak mempunyai hak"];
    }
}
