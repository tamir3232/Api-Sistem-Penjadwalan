<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ConfirmUserController extends Controller
{
    public function confirm(Request $request)
    {
        try {
            if (Auth::user()->role == 1) {
                $user = User::where('id', $request->id)->first();
                if ($request->status == 'Active' || $request->status == "Not Active") {
                    $user->update([
                        'status' => $request->status ?? $user->status,
                    ]);
                    return response()->json(array(
                        'message' => 'Status Berhasil Di Update',
                        'status' => 'Succes',
                        'code' => 200,
                    ));
                } else {
                    throw new Exception('STATUS TIDAK TERSEDIA');
                }
            } else {
                throw new Exception('ANDA TIDAK MEMILIKI AKSES');
            }
        } catch (Exception $e) {
            return response()->json(array(
                'error' => array(
                    'msg' => $e->getMessage(),
                    'status' => 'Failed'

                ),
            ), 500);
        }
    }
}
