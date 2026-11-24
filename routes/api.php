<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MahasiswaApiController;
use App\Http\Controllers\Api\BukuApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Di sini tempat mendaftarkan rute RESTful API untuk aplikasi Anda.
|
*/

// Pertemuan 15 - Latihan: RESTful API Mahasiswa
Route::apiResource('mahasiswa', MahasiswaApiController::class);

// Pertemuan 15 - Tugas: RESTful API Katalog Buku E-Perpustakaan
Route::apiResource('buku', BukuApiController::class);
