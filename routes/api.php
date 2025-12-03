<?php
// routes/api.php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Biarkan hanya route default Laravel
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// HAPUS SEMUA BARIS YANG BERHUBUNGAN DENGAN get-motor-types atau get-symptoms DI SINI.