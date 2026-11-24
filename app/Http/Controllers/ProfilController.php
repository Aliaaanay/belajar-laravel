<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Menampilkan profil mahasiswa (Praktik 3 Modul 18)
     */
    public function index()
    {
        $profil = [
            'nama' => 'Sabrina Luna',
            'nim' => '2410114001',
            'prodi' => 'Teknik Informatika',
            'fakultas' => 'Ilmu Komputer',
            'semester' => 4,
            'github' => 'https://github.com/Aliaaanay',
            'bio' => 'Mahasiswa Teknik Informatika pengembang aplikasi web Laravel modern tersinkronisasi basis data MySQL.'
        ];

        return view('profil', [
            'profil' => $profil
        ]);
    }
}
