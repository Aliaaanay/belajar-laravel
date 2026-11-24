<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Buku;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Pengguna untuk Pertemuan 14 (Portal Akademik & E-Perpustakaan)
        User::firstOrCreate(
            ['email' => 'admin@kampus.ac.id'],
            [
                'name' => 'Administrator Utama',
                'password' => Hash::make('password123'),
                'role' => 'admin'
            ]
        );

        User::firstOrCreate(
            ['email' => 'mahasiswa@kampus.ac.id'],
            [
                'name' => 'Dimas Anggara (Mahasiswa)',
                'password' => Hash::make('password123'),
                'role' => 'mahasiswa'
            ]
        );

        User::firstOrCreate(
            ['email' => 'pustakawan@perpus.ac.id'],
            [
                'name' => 'Septa Pustakawan',
                'password' => Hash::make('password123'),
                'role' => 'pustakawan'
            ]
        );

        User::firstOrCreate(
            ['email' => 'anggota@perpus.ac.id'],
            [
                'name' => 'Siti Nabila (Anggota Perpus)',
                'password' => Hash::make('password123'),
                'role' => 'anggota'
            ]
        );

        // 2. Data Mahasiswa untuk RESTful API Pertemuan 15
        Mahasiswa::firstOrCreate(
            ['nim' => '2210114001'],
            [
                'nama' => 'Budi Santoso',
                'jurusan' => 'Teknik Informatika',
                'ipk' => 3.85
            ]
        );

        Mahasiswa::firstOrCreate(
            ['nim' => '2210114002'],
            [
                'nama' => 'Siti Aminah',
                'jurusan' => 'Sistem Informasi',
                'ipk' => 3.92
            ]
        );

        Mahasiswa::firstOrCreate(
            ['nim' => '2210114003'],
            [
                'nama' => 'Andi Pratama',
                'jurusan' => 'Teknik Informatika',
                'ipk' => 3.78
            ]
        );

        // 3. Data Buku Perpustakaan untuk RESTful API Pertemuan 15
        Buku::firstOrCreate(
            ['kode_buku' => 'BK-001'],
            [
                'judul_buku' => 'Pemrograman Web Lanjut dengan Framework Laravel',
                'penulis' => 'Septa, S.Kom., M.Kom.',
                'stok' => 15
            ]
        );

        Buku::firstOrCreate(
            ['kode_buku' => 'BK-002'],
            [
                'judul_buku' => 'Fundamental Kecerdasan Buatan & Machine Learning',
                'penulis' => 'Dr. Budi Santoso, M.Kom.',
                'stok' => 10
            ]
        );

        Buku::firstOrCreate(
            ['kode_buku' => 'BK-003'],
            [
                'judul_buku' => 'Arsitektur Jaringan Komputer & Cyber Security Modern',
                'penulis' => 'Rina Wijaya, S.Kom., M.T.',
                'stok' => 8
            ]
        );

        Buku::firstOrCreate(
            ['kode_buku' => 'BK-004'],
            [
                'judul_buku' => 'Rekayasa Perangkat Lunak Berorientasi Objek & Clean Code',
                'penulis' => 'Dimas Anggara, M.Kom.',
                'stok' => 12
            ]
        );

        Buku::firstOrCreate(
            ['kode_buku' => 'BK-005'],
            [
                'judul_buku' => 'Desain Interaksi Manusia Komputer & Prototyping UI/UX',
                'penulis' => 'Siti Nabila, S.T., M.Kom.',
                'stok' => 6
            ]
        );

        // 4. Data E-Commerce Pertemuan 16 Cadangan
        $this->call(EcommerceSeeder::class);
    }
}
