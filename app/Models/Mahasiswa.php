<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    // Konfigurasi Eloquent ORM (Pertemuan 13 Bagian B & Pertemuan 15)
    protected $fillable = [
        'nim',
        'nama',
        'jurusan',
        'prodi',
        'ipk',
    ];

    // Data Koleksi Statis (Pertemuan 13 Bagian A)
    private static $data_mahasiswa = [
        [
            'nim' => '2410114001',
            'nama' => 'Rizky Pratama',
            'prodi' => 'Teknik Informatika',
            'jurusan' => 'Teknik Informatika',
            'ipk' => 3.85
        ],
        [
            'nim' => '2410114002',
            'nama' => 'Siti Nabila',
            'prodi' => 'Teknik Informatika',
            'jurusan' => 'Teknik Informatika',
            'ipk' => 3.92
        ],
        [
            'nim' => '2410114003',
            'nama' => 'Dimas Anggara',
            'prodi' => 'Teknik Informatika',
            'jurusan' => 'Teknik Informatika',
            'ipk' => 3.45
        ],
    ];

    // Fungsi untuk mengambil seluruh data mahasiswa (Pertemuan 13)
    public static function ambilSemua()
    {
        try {
            $dataDb = self::all();
            if ($dataDb->isNotEmpty()) {
                return $dataDb->map(function ($item) {
                    return [
                        'nim' => $item->nim,
                        'nama' => $item->nama,
                        'prodi' => $item->jurusan ?? 'Teknik Informatika',
                        'jurusan' => $item->jurusan ?? 'Teknik Informatika',
                        'ipk' => (float)$item->ipk
                    ];
                })->toArray();
            }
        } catch (\Throwable $e) {}

        return self::$data_mahasiswa;
    }

    // Fungsi untuk mencari 1 mahasiswa berdasarkan NIM (Pertemuan 13)
    public static function cariBerdasarkanNim($nim)
    {
        try {
            $itemDb = self::where('nim', $nim)->first();
            if ($itemDb) {
                return [
                    'nim' => $itemDb->nim,
                    'nama' => $itemDb->nama,
                    'prodi' => $itemDb->jurusan ?? 'Teknik Informatika',
                    'jurusan' => $itemDb->jurusan ?? 'Teknik Informatika',
                    'ipk' => (float)$itemDb->ipk
                ];
            }
        } catch (\Throwable $e) {}

        foreach (self::$data_mahasiswa as $mhs) {
            if ($mhs['nim'] === $nim) {
                return $mhs;
            }
        }

        return null; // Jika tidak ditemukan
    }
}
