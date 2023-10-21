<?php

namespace App\Http\Controllers\Reservasi;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfirmReservasiController extends Controller
{
    public function confirm(Request $request)
    {
        if (Auth::user()->role == 1) {
            $Reservasi = Reservasi::where('id', $request->id)->first();
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
