<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PelajaranController;
use App\Http\Controllers\LatihanController;
use App\Http\Controllers\KuisController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\TodolistController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

#login-register
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

#pelajaran
Route::get('/pelajaran', [PelajaranController::class, 'index']);
Route::get('/pelajaran/{start}/{end}', [PelajaranController::class, 'show']);
Route::get('/isi-pelajaran/{start}/{end}', [PelajaranController::class, 'getIsiPelajaran']);


#reset password
Route::post('/reset-password', [AuthController::class, 'sendResetLinkEmail']);

Route::middleware('auth:sanctum')->group(function () {
    #logout
    Route::post('/logout', [AuthController::class, 'logout']);
    
    #latihan
    Route::get('/latihan/{latihanId}/{jenis}', [LatihanController::class, 'getSoalLatihan']);
    Route::post('/latihan/jawaban', [LatihanController::class, 'submitJawaban']);

    #kuis
    Route::get('/kuis/{kategoriNama}/{kuisId}/{soalKe}', [KuisController::class, 'getSoalKuis']);
    Route::post('/kuis/submit', [KuisController::class, 'submitJawabanKuis']);
});

