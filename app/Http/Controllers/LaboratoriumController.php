<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laboratorium;
use Illuminate\Support\Facades\Log;

class LaboratoriumController extends Controller
{
    // Fungsi 1: Menampilkan seluruh laboratorium
    public function index()
    {
        try {
            $labs = Laboratorium::ambilSemuaLab();

            $total_pc = 0;
            foreach ($labs as $lab) {
                $total_pc += $lab['kapasitas_pc'];
            }

            Log::info("Mengakses direktori laboratorium", ['total_lab' => count($labs), 'total_pc' => $total_pc]);

            return view('lab_index', [
                'judul' => 'Direktori & Inventaris Laboratorium Komputer',
                'daftar_lab' => $labs,
                'total_pc' => $total_pc,
                'filter_aktif' => 'semua'
            ]);
        } catch (\Throwable $e) {
            Log::error("Gagal memuat direktori laboratorium: " . $e->getMessage());
            return response("Terjadi kesalahan sistem saat memuat laboratorium: " . $e->getMessage(), 500);
        }
    }

    // Fungsi 2: Menampilkan detail laboratorium berdasarkan kode
    public function detail($kode)
    {
        try {
            $lab = Laboratorium::cariKodeLab($kode);

            if (!$lab) {
                Log::warning("Pencarian lab tidak ditemukan dengan kode: {$kode}");
                abort(404, "Data Laboratorium dengan kode [{$kode}] tidak ditemukan dalam inventaris.");
            }

            Log::info("Menampilkan detail lab: {$kode}");

            return view('lab_detail', [
                'lab' => $lab
            ]);
        } catch (\Symfony\Component\HttpKernel\Exception\HttpException $e) {
            throw $e;
        } catch (\Throwable $e) {
            Log::error("Error saat membuka detail lab {$kode}: " . $e->getMessage());
            abort(500, "Kesalahan server saat membuka data laboratorium.");
        }
    }

    // Fungsi 3: Memfilter laboratorium berdasarkan status
    public function statusLab($status = 'Tersedia')
    {
        try {
            $status = $status ?? 'Tersedia';
            $labs = Laboratorium::filterBerdasarkanStatus($status);

            // Validasi pengecualian jika filter status aneh
            if (empty($labs) && !in_array(strtolower($status), ['tersedia', 'sedang maintenance', 'maintenance'])) {
                Log::warning("Pencarian filter status lab tidak valid: {$status}");
                throw new \Exception("Status [{$status}] tidak valid dalam sistem klasifikasi laboratorium.");
            }

            $total_pc = 0;
            foreach ($labs as $lab) {
                $total_pc += $lab['kapasitas_pc'];
            }

            return view('lab_index', [
                'judul' => 'Direktori Laboratorium - Filter: ' . ucfirst($status),
                'daftar_lab' => $labs,
                'total_pc' => $total_pc,
                'filter_aktif' => strtolower($status)
            ]);
        } catch (\Throwable $e) {
            Log::error("Error filter status laboratorium: " . $e->getMessage());
            return view('lab_index', [
                'judul' => 'Direktori Laboratorium - Filter Error',
                'daftar_lab' => [],
                'total_pc' => 0,
                'filter_aktif' => strtolower($status ?? ''),
                'pesan_error' => $e->getMessage()
            ]);
        }
    }
}
