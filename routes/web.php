<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\LaboratoriumController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PerpusAuthController;
use App\Http\Controllers\NilaiAkademikController;
use App\Http\Controllers\QaTestingController;
use App\Http\Controllers\EcommerceController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\EcommerceLaporanController;

/*
|--------------------------------------------------------------------------
| Web Routes - Belajar Laravel (Pertemuan 13 - 16)
|--------------------------------------------------------------------------
*/

// Halaman Beranda Utama (Portal Navigasi Lengkap Modul 13 - 16)
Route::get('/', function () {
    return view('welcome');
});

// =========================================================================
// PERTEMUAN 13: MVC PADA LARAVEL
// =========================================================================

// Praktik 13: MVC Mahasiswa (13.1 - 13.3)
Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
Route::get('/mahasiswa/{nim}', [MahasiswaController::class, 'detail']);

// Latihan 13: Sistem Katalog Mata Kuliah
Route::prefix('matakuliah')->group(function () {
    Route::get('/', [MataKuliahController::class, 'index']);
    Route::get('/{kode}', [MataKuliahController::class, 'detail']);
});

// Tugas 13: Sistem Informasi Direktori & Inventaris Laboratorium Komputer
Route::prefix('laboratorium')->group(function () {
    Route::get('/', [LaboratoriumController::class, 'index']);
    Route::get('/detail/{kode}', [LaboratoriumController::class, 'detail']);
    Route::get('/status/{status?}', [LaboratoriumController::class, 'statusLab']);
});

// =========================================================================
// PERTEMUAN 14: AUTENTIKASI DAN OTORISASI (MULTI-ROLE)
// =========================================================================

// Latihan 14: Portal Akademik Multi-Role (Admin & Mahasiswa)
Route::get('/register', [AuthController::class, 'tampilRegister']);
Route::post('/register', [AuthController::class, 'prosesRegister']);
Route::get('/login', [AuthController::class, 'tampilLogin'])->name('login');
Route::post('/login', [AuthController::class, 'prosesLogin']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Otorisasi Role Admin
    Route::get('/panel-admin', function () {
        return view('panel_admin');
    })->middleware('role:admin');

    // Otorisasi Role Mahasiswa
    Route::get('/krs-mahasiswa', function () {
        return view('krs_mahasiswa');
    })->middleware('role:mahasiswa');
});

// Tugas 14: Sistem Autentikasi & Otorisasi E-Perpustakaan (Pustakawan & Anggota)
Route::prefix('perpus')->group(function () {
    Route::get('/register', [PerpusAuthController::class, 'register']);
    Route::post('/register', [PerpusAuthController::class, 'simpanRegister']);
    Route::get('/login', [PerpusAuthController::class, 'login'])->name('perpus.login');
    Route::post('/login', [PerpusAuthController::class, 'cekLogin']);

    // Rute Terproteksi Auth E-Perpustakaan
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [PerpusAuthController::class, 'dashboard']);
        Route::post('/logout', [PerpusAuthController::class, 'logout']);

        // Khusus Role Pustakawan
        Route::get('/kelola-buku', [PerpusAuthController::class, 'kelolaBuku'])->middleware('role:pustakawan');

        // Khusus Role Anggota
        Route::get('/pinjam-buku', [PerpusAuthController::class, 'pinjamBuku'])->middleware('role:anggota');
    });

    // Pertemuan 15 (Tugas): Halaman Web Konsumen API Katalog Buku Perpustakaan
    Route::get('/katalog-api', function () {
        return view('perpus_katalog_api');
    });
});

// =========================================================================
// PERTEMUAN 15: RESTFUL API (CLIENT WEB)
// =========================================================================

// Latihan 15: Halaman Web Konsumen RESTful API Mahasiswa
Route::get('/client-mahasiswa', function () {
    return view('client_mahasiswa');
});

// =========================================================================
// PERTEMUAN 16: DEBUGGING, ERROR HANDLING & TESTING
// =========================================================================

// Latihan 16: Simulasi Debugging & Error Handling Nilai Akademik
Route::prefix('uji-nilai')->group(function () {
    Route::get('/', [NilaiAkademikController::class, 'index']);
    Route::get('/hitung/{nim}', [NilaiAkademikController::class, 'hitungIp']);
});

// Tugas 16: Dashboard Quality Assurance & Automated Testing Report
Route::get('/qa-testing', [QaTestingController::class, 'index']);

// =========================================================================
// PROYEK E-COMMERCE QA, ERROR HANDLING & AUTOMATED TESTING (TUGAS MANDIRI 16)
// =========================================================================
Route::prefix('ecommerce')->group(function () {
    Route::get('/', [EcommerceController::class, 'index']);
    Route::get('/produk/{sku}', [EcommerceController::class, 'detail']);
    Route::post('/order', [EcommerceController::class, 'order']);
    Route::get('/cicilan/{sku}', [EcommerceController::class, 'simulasiCicilan']);
    Route::get('/qa-dashboard', [EcommerceController::class, 'qaDashboard']);
});

// Alias Rute Utama QA Dashboard E-Commerce
Route::get('/qa-dashboard', [EcommerceController::class, 'qaDashboard']);

// =========================================================================
// PERTEMUAN 17: SISTEM PELAPORAN (REPORTING), EXPORT PDF & EXCEL (CSV)
// =========================================================================

// Latihan 17: Modul Laporan Kas & Transaksi Himpunan Mahasiswa
Route::prefix('laporan')->group(function () {
    Route::get('/', [LaporanController::class, 'index']);
    Route::get('/pdf', [LaporanController::class, 'exportPdf']);
    Route::get('/excel', [LaporanController::class, 'exportExcel']);
});

// Tugas Mandiri 17: Laporan Rekapitulasi Penjualan & Transaksi E-Commerce
Route::prefix('ecommerce/laporan')->group(function () {
    Route::get('/', [EcommerceLaporanController::class, 'index']);
    Route::get('/pdf', [EcommerceLaporanController::class, 'exportPdf']);
    Route::get('/excel', [EcommerceLaporanController::class, 'exportExcel']);
});

// =========================================================================
// PERTEMUAN 18: VERSION CONTROL (GIT) & SIMULASI CABANG FITUR
// =========================================================================

// Praktik 18: Fitur Halaman Kontak Kampus (Hasil Merge Cabang 'fitur-kontak')
Route::get('/kontak', function () {
    return view('kontak');
});

// Praktik 2 (Modul 18): Route Halaman Tentang Kampus
Route::get('/tentang', function () {
    return "Portal Akademik & E-Commerce Versi 1.1 - Belajar Laravel";
});
