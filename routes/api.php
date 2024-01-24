<?php

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dosen\DosenController;
use App\Http\Controllers\Kelas\KelasController;
use App\Http\Controllers\Reset\ResetController;
use App\Http\Controllers\Jadwal\JadwalController;
use App\Http\Controllers\Jadwal\AllJadwalController;
use App\Http\Controllers\HariController\HariController;
use App\Http\Controllers\Reservasi\ReservasiController;

// use Illuminate\Support\Facades\App;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
//tidak butuh token
Route::post('register', [AuthController::class, 'register']);
Route::get('cek-jadwal', [AllJadwalController::class, 'index']);
Route::post('login', [App\Http\Controllers\Auth\AuthController::class, 'login']);

Route::get('export', [AllJadwalController::class, 'export']);




//butuh token
Route::middleware(['auth:api'])->group(function () {
    Route::post('confirm-reservasi', [App\Http\Controllers\Reservasi\ConfirmReservasiController::class, 'confirm']);
    Route::post('logout', [App\Http\Controllers\Auth\AuthController::class, 'logout']);
    Route::post('confirm-user', [App\Http\Controllers\Auth\ConfirmUserController::class, 'confirm']);
    Route::apiResource('dosen', App\Http\Controllers\Dosen\DosenController::class);
    Route::apiResource('kelas', App\Http\Controllers\Kelas\KelasController::class);
    Route::apiResource('ruangan', App\Http\Controllers\Ruangan\RuanganController::class);
    Route::apiResource('jam', App\Http\Controllers\Jam\JamController::class);
    Route::apiResource('hari', App\Http\Controllers\Hari\HariController::class);
    Route::apiResource('matakuliah', App\Http\Controllers\Matakuliah\MatakuliahController::class);
    Route::apiResource('pengampu', App\Http\Controllers\Pengampu\PengampuControllers::class);
    Route::apiResource('reservasi', App\Http\Controllers\Reservasi\ReservasiController::class);
    Route::apiResource('jadwal', App\Http\Controllers\Jadwal\JadwalController::class);
    Route::apiResource('contraint', App\Http\Controllers\Contraint\ContraintController::class);
    Route::get('my-reservasi', [ReservasiController::class, 'MyReservasi']);
    Route::get('get-user', [AuthController::class, 'GetUser']);
    Route::get('reset', [ResetController::class, 'reset']);
});
