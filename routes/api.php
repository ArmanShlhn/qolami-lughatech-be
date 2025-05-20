<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PelajaranController;
use App\Http\Controllers\LatihanController;
use App\Http\Controllers\KuisController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

#login-register
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

#pelajaran
Route::get('/pelajaran', [PelajaranController::class, 'index']);
Route::get('/pelajaran/{pelajaran_id}/{id}', [PelajaranController::class, 'isiPelajaran']);

#reset password
Route::post('/reset-password', [AuthController::class, 'sendResetLinkEmail']);

Route::middleware('auth:sanctum')->group(function () {
    #logout
    Route::post('/logout', [AuthController::class, 'logout']);
    
    #latihan
    Route::get('/latihan', [LatihanController::class, 'listLatihan']);
    Route::get('/latihan/{latihanId}/{jenis}', [LatihanController::class, 'getSoalLatihan']);
    Route::post('/latihan/jawaban', [LatihanController::class, 'submitJawaban']);

    #kuis
    Route::get('/kuis', [kuisController::class, 'listkuis']);
    Route::get('/kuis/{kategoriNama}/{kuisId}/{soalKe}', [KuisController::class, 'getSoalKuis']);
    Route::post('/kuis/submit', [KuisController::class, 'submitJawabanKuis']);
});

