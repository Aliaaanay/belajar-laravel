<?php

namespace App\Models;

class Laboratorium
{
    // Minimal 5 data ruang laboratorium komputer
    private static $daftar_lab = [
        [
            'kode_lab' => 'LAB-01',
            'nama_lab' => 'Laboratorium Pemrograman Dasar & Web',
            'penanggung_jawab' => 'Septa, S.Kom., M.Kom.',
            'kapasitas_pc' => 35,
            'status' => 'Tersedia',
            'fasilitas' => '35 Unit PC Core i7, RAM 16GB, LAN Gigabit, Proyektor Full HD, Ruangan Full AC'
        ],
        [
            'kode_lab' => 'LAB-02',
            'nama_lab' => 'Laboratorium Jaringan & Keamanan Siber',
            'penanggung_jawab' => 'Rina Wijaya, S.Kom., M.T.',
            'kapasitas_pc' => 30,
            'status' => 'Tersedia',
            'fasilitas' => '30 Unit PC Core i5, Switch Cisco Catalyst, Router Mikrotik RB450G, Server Rack, Patch Panel'
        ],
        [
            'kode_lab' => 'LAB-03',
            'nama_lab' => 'Laboratorium Multimedia & Game Studio',
            'penanggung_jawab' => 'Dr. Budi Santoso, M.Kom.',
            'kapasitas_pc' => 28,
            'status' => 'Sedang Maintenance',
            'fasilitas' => '28 Unit PC RTX 4070, VR Oculus Quest 3, Huion Drawing Tablets, Soundproofing Studio'
        ],
        [
            'kode_lab' => 'LAB-04',
            'nama_lab' => 'Laboratorium Rekayasa Perangkat Lunak & Basis Data',
            'penanggung_jawab' => 'Dimas Anggara, M.Kom.',
            'kapasitas_pc' => 40,
            'status' => 'Tersedia',
            'fasilitas' => '40 Unit PC Core i5 SSD NVMe, Dual Display Setup, Interactive Smart Board, Gigabit Fiber Backbone'
        ],
        [
            'kode_lab' => 'LAB-05',
            'nama_lab' => 'Laboratorium Sistem Tertanam & Internet of Things (IoT)',
            'penanggung_jawab' => 'Siti Nabila, S.T., M.Kom.',
            'kapasitas_pc' => 25,
            'status' => 'Sedang Maintenance',
            'fasilitas' => '25 Unit PC Workstation, Kit Mikrokontroler Arduino/ESP32, Osiloskop Digital, 3D Printer Ender-3'
        ],
    ];

    // Method Wajib 1: Mengembalikan seluruh data lab
    public static function ambilSemuaLab()
    {
        return self::$daftar_lab;
    }

    // Method Wajib 2: Mengembalikan satu data lab spesifik
    public static function cariKodeLab($kode)
    {
        foreach (self::$daftar_lab as $lab) {
            if (strtoupper($lab['kode_lab']) === strtoupper($kode)) {
                return $lab;
            }
        }
        return null;
    }

    // Method Wajib 3: Mengembalikan daftar lab berdasarkan statusnya
    public static function filterBerdasarkanStatus($status)
    {
        $hasil = [];
        $statusNormalized = strtolower(trim($status));

        foreach (self::$daftar_lab as $lab) {
            $labStatus = strtolower($lab['status']);
            // Cocokkan 'tersedia' atau 'maintenance' (partial/exact)
            if ($statusNormalized === 'maintenance' && str_contains($labStatus, 'maintenance')) {
                $hasil[] = $lab;
            } elseif ($labStatus === $statusNormalized) {
                $hasil[] = $lab;
            }
        }

        return $hasil;
    }
}
