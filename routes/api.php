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

#login-register-reset/change password
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/send-otp', [AuthController::class, 'sendOtp']);
Route::post('/change-password', [AuthController::class, 'changePassword']);

#pelajaran
Route::get('/pelajaran', [PelajaranController::class, 'index']);
Route::get('/pelajaran/{pelajaran_id}/isi', [PelajaranController::class, 'listIsiPelajaran']);
Route::get('/pelajaran/{pelajaran_id}/isi/{id}', [PelajaranController::class, 'isiPelajaran']);

Route::middleware('auth:sanctum')->group(function () {
    #logout
    Route::post('/logout', [AuthController::class, 'logout']);
    
    #Rename
    Route::post('/rename-account', [AuthController::class, 'renameAccount']);

    #latihan
    Route::get('/latihan', [LatihanController::class, 'listLatihan']);
    Route::get('/latihan/{latihanId}/{jenis}', [LatihanController::class, 'getSoalLatihan']);
    Route::post('/latihan/jawaban', [LatihanController::class, 'submitJawaban']);

    #kuis
    Route::get('/list-kuis', [KuisController::class, 'listKuis']);
    Route::get('/kuis/{kategoriNama}/{kuisId}', [KuisController::class, 'getSoalKuis']);
    Route::post('/kuis/submit', [KuisController::class, 'submitJawabanKuis']);
});