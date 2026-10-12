<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\SiswaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', function () {
    return response()->json(['message' => 'Test Route berhasil!']);
});

Route::apiResource('/siswa', SiswaController::class);

Route::apiResource('/buku', BukuController::class);