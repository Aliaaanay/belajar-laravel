<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class QaTestingController extends Controller
{
    /**
     * Menampilkan Dashboard Quality Assurance, Debugging & Testing (Tugas Mandiri Modul 16)
     */
    public function index()
    {
        // 1. Laporan Temuan Hasil Uji Coba & Debugging (Sesuai Spesifikasi Soal Modul 16 Bagian 4)
        $laporan_qa = [
            [
                'no' => 1,
                'fitur_url' => 'Kalkulator Nilai Akademik (/uji-nilai/hitung/{nim})',
                'jenis_error' => 'Runtime Error (DivisionByZero)',
                'penyebab' => 'Mahasiswa baru memiliki Total SKS = 0. Operasi $total_mutu / $total_sks memicu DivisionByZeroError yang membuat server crash.',
                'solusi' => 'Membungkus logika dalam blok try-catch, melempar Exception jika $total_sks <= 0, mencatat Log::error(), dan mengembalikan pesan peringatan ramah ke tampilan view.',
                'status_uji' => 'PASS'
            ],
            [
                'no' => 2,
                'fitur_url' => 'Direktori Laboratorium Filter Status (/laboratorium/status/{status})',
                'jenis_error' => 'Logical & Validation Error',
                'penyebab' => 'Pengguna menginput parameter status aneh/ekstrem di URL (misal: "StatusNgawurDanEkstrem999") yang tidak ada di daftar kategori laboratorium.',
                'solusi' => 'Validasi kecocokan whitelist status. Jika tidak sesuai, melempar Exception("Status tidak valid"), mencatat jejak Log::error(), dan merender halaman dengan alert tanpa crash.',
                'status_uji' => 'PASS'
            ],
            [
                'no' => 3,
                'fitur_url' => 'Detail Laboratorium & Detail Mahasiswa (/laboratorium/detail/{kode})',
                'jenis_error' => '404 Not Found (Missing Resource)',
                'penyebab' => 'Pengguna mengakses kode lab fiktif (seperti LAB-TIDAK-ADA-999) atau NIM tidak terdaftar. Tanpa penanganan, aplikasi bisa menampilkan error unhandled.',
                'solusi' => 'Mengecek ketersediaan data di Model. Jika null, memanggil abort(404) dan menampilkan custom error view terdesain di resources/views/errors/404.blade.php.',
                'status_uji' => 'PASS'
            ],
            [
                'no' => 4,
                'fitur_url' => 'Otorisasi Role Mahasiswa pada KRS (/krs-mahasiswa)',
                'jenis_error' => '403 Forbidden (Privilege Access Control)',
                'penyebab' => 'Pengguna dengan role admin mencoba mengakses halaman pengisian KRS yang khusus diperuntukkan bagi mahasiswa aktif.',
                'solusi' => 'Menerapkan middleware CekRole (\'role:mahasiswa\'). Akses tanpa wewenang langsung ditolak dengan status HTTP 403 Forbidden dan halaman 403.blade.php.',
                'status_uji' => 'PASS'
            ],
            [
                'no' => 5,
                'fitur_url' => 'RESTful API Simpan Buku (/api/buku POST)',
                'jenis_error' => '422 Unprocessable Content (Validation Error)',
                'penyebab' => 'Client API mengirimkan payload JSON kosong tanpa menyertakan kode_buku, judul_buku, penulis, dan stok.',
                'solusi' => 'Menggunakan Validator::make(), mencatat Log::warning(), dan merespons dengan JSON seragam { status: false, message: "Validasi Gagal", errors: [...] } berstatus HTTP 422.',
                'status_uji' => 'PASS'
            ],
        ];

        // 2. Ambil 20 baris log terbaru dari storage/logs/laravel.log
        $logPath = storage_path('logs/laravel.log');
        $recentLogs = [];
        if (File::exists($logPath)) {
            $lines = file($logPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            if ($lines !== false) {
                $recentLogs = array_slice($lines, -20);
            }
        }

        return view('qa_testing', [
            'laporan_qa' => $laporan_qa,
            'recent_logs' => $recentLogs
        ]);
    }
}
