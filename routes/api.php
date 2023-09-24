<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HariController\HariController;


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

Route::post('register', [App\Http\Controllers\Auth\AuthController::class, 'register']);

Route::post('login', [App\Http\Controllers\Auth\AuthController::class, 'login']);

Route::apiResource('dosen', App\Http\Controllers\Dosen\DosenController::class);
Route::apiResource('kelas', App\Http\Controllers\Kelas\KelasController::class);
Route::apiResource('ruangan', App\Http\Controllers\Ruangan\RuanganController::class);
Route::apiResource('jam', App\Http\Controllers\Jam\JamController::class);
Route::apiResource('hari', App\Http\Controllers\Hari\HariController::class);
Route::apiResource('matkul', App\Http\Controllers\Matkul\MatkulController::class);






Route::middleware(['auth:api'])->group(function () {

    Route::post('logout', [App\Http\Controllers\Auth\AuthController::class, 'logout']);
});
