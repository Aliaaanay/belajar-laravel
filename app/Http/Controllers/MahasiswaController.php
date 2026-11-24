<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    // Fungsi untuk menampilkan daftar seluruh mahasiswa (Pertemuan 13)
    public function index()
    {
        // 1. Meminta data dari Model Mahasiswa
        $daftar_mhs = Mahasiswa::ambilSemua();

        // 2. Mengirim data ke View 'mahasiswa.blade.php'
        return view('mahasiswa', [
            'daftar_mhs' => $daftar_mhs
        ]);
    }

    // Fungsi untuk menampilkan detail satu mahasiswa berdasarkan NIM
    public function detail($nim)
    {
        // 1. Meminta Model mencari data berdasarkan parameter NIM
        $mhs = Mahasiswa::cariBerdasarkanNim($nim);

        // 2. Jika data tidak ditemukan, lemparkan error 404
        if (!$mhs) {
            abort(404, "Data Mahasiswa dengan NIM {$nim} tidak ditemukan.");
        }

        // 3. Jika ditemukan, tampilkan View 'mahasiswa_detail.blade.php'
        return view('mahasiswa_detail', [
            'mhs' => $mhs
        ]);
    }

    // Fungsi simulasi debugging dd() dari materi 13.2.2 / 16.2.2
    public function cekDataMahasiswa()
    {
        $data = [
            'nim' => '2410114001',
            'nama' => 'Dimas Anggara',
            'nilai_tugas' => 85,
            'nilai_uas' => 90
        ];

        dd($data);

        return view('mahasiswa', ['daftar_mhs' => [$data]]);
    }
}
