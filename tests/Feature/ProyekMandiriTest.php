<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Buku;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProyekMandiriTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Skenario Pertemuan 13: Uji MVC Mahasiswa
     */
    public function test_mvc_mahasiswa_daftar_dan_detail_berhasil_diakses(): void
    {
        $response = $this->get('/mahasiswa');
        $response->assertStatus(200);
        $response->assertSee('Daftar Mahasiswa (Implementasi MVC - Pertemuan 13)');
        $response->assertSee('2410114001');

        $resDetail = $this->get('/mahasiswa/2410114001');
        $resDetail->assertStatus(200);
        $resDetail->assertSee('Rizky Pratama');
    }

    /**
     * Skenario Pertemuan 13: Uji MVC Mata Kuliah
     */
    public function test_mvc_matakuliah_katalog_dan_detail_berhasil_diakses(): void
    {
        $resKat = $this->get('/matakuliah');
        $resKat->assertStatus(200);
        $resKat->assertSee('Katalog Mata Kuliah Teknik Informatika');
        $resKat->assertSee('IF201');

        $resDetail = $this->get('/matakuliah/IF201');
        $resDetail->assertStatus(200);
        $resDetail->assertSee('Pemrograman Web Lanjut');
    }

    /**
     * Skenario Pertemuan 14: Uji Akses KRS Mahasiswa & Otorisasi Role
     */
    public function test_mahasiswa_dapat_mengakses_halaman_krs(): void
    {
        $mhs = User::create([
            'name' => 'Dimas Anggara',
            'email' => 'mhs_test@kampus.ac.id',
            'password' => bcrypt('password123'),
            'role' => 'mahasiswa'
        ]);

        $response = $this->actingAs($mhs)->get('/krs-mahasiswa');
        $response->assertStatus(200);
        $response->assertSee('Halaman Pengisian KRS Mahasiswa');
        $response->assertSee('Silakan pilih mata kuliah sesuai peminatan kamu semester ini.');
    }

    public function test_admin_ditolak_mengakses_halaman_krs_mahasiswa_403(): void
    {
        $admin = User::create([
            'name' => 'Admin Kampus',
            'email' => 'admin_test@kampus.ac.id',
            'password' => bcrypt('password123'),
            'role' => 'admin'
        ]);

        $response = $this->actingAs($admin)->get('/krs-mahasiswa');
        $response->assertStatus(403);
    }

    public function test_guest_di_redirect_ke_login_saat_akses_krs_mahasiswa(): void
    {
        $response = $this->get('/krs-mahasiswa');
        $response->assertRedirect('/login');
    }

    /**
     * Skenario 1: Uji Skenario Normal (Positive Test)
     * Memastikan halaman utama direktori laboratorium berhasil diakses (200 OK)
     * dan menampilkan judul serta data laboratorium utama.
     */
    public function test_halaman_utama_laboratorium_berhasil_diakses_positive_test(): void
    {
        $response = $this->get('/laboratorium');

        $response->assertStatus(200);
        $response->assertSee('Direktori & Inventaris Laboratorium');
        $response->assertSee('LAB-01');
        $response->assertSee('Laboratorium Pemrograman Dasar & Web');
    }

    /**
     * Skenario 1b: Uji Skenario Normal Filter Status (Positive Test)
     */
    public function test_filter_status_laboratorium_berhasil_ditampilkan(): void
    {
        $response = $this->get('/laboratorium/status/Tersedia');

        $response->assertStatus(200);
        $response->assertSee('Filter: Tersedia');
        $response->assertSee('LAB-01');
    }

    /**
     * Skenario 1c: Uji Skenario Normal Detail Laboratorium (Positive Test)
     */
    public function test_detail_laboratorium_valid_dapat_dibuka(): void
    {
        $response = $this->get('/laboratorium/detail/LAB-01');

        $response->assertStatus(200);
        $response->assertSee('Detail Inventaris Laboratorium Komputer');
        $response->assertSee('Septa, S.Kom., M.Kom.');
    }

    /**
     * Skenario 2: Uji Skenario Penanganan Error (Exception / Error Handling Test)
     * Memastikan aplikasi tidak crash saat menerima parameter status filter tidak wajar/ekstrem,
     * serta berhasil menangkap Exception di blok try-catch dan menampilkan pesan peringatan dengan sopan.
     */
    public function test_error_handling_saat_filter_status_laboratorium_tidak_valid(): void
    {
        $response = $this->get('/laboratorium/status/StatusNgawurDanEkstrem999');

        $response->assertStatus(200);
        $response->assertSee('Peringatan:');
        $response->assertSee('tidak valid dalam sistem klasifikasi laboratorium');
    }

    /**
     * Skenario 3: Uji Skenario Data Tidak Ditemukan (Negative Test)
     * Memastikan akses ke kode laboratorium yang tidak terdaftar mengembalikan status HTTP 404 Not Found.
     */
    public function test_akses_laboratorium_kode_palsu_mengembalikan_status_404(): void
    {
        $response = $this->get('/laboratorium/detail/LAB-TIDAK-ADA-999');

        $response->assertStatus(404);
    }

    /**
     * Skenario 4: Uji Skenario RESTful API Buku - Positive Test
     */
    public function test_api_buku_berhasil_mengembalikan_json(): void
    {
        $response = $this->getJson('/api/buku');

        $response->assertStatus(200);
        $response->assertJson([
            'status' => true
        ]);
    }

    /**
     * Skenario 5: Uji Skenario RESTful API Buku - Negative Test (404)
     */
    public function test_api_buku_id_tidak_ditemukan_mengembalikan_404(): void
    {
        $response = $this->getJson('/api/buku/9999999');

        $response->assertStatus(404);
        $response->assertJson([
            'status' => false
        ]);
    }

    /**
     * Skenario 6: Uji Skenario RESTful API Buku - Exception / Validation Test (422)
     */
    public function test_api_buku_validasi_input_kosong_mengembalikan_422(): void
    {
        $response = $this->postJson('/api/buku', []);

        $response->assertStatus(422);
        $response->assertJson([
            'status' => false
        ]);
    }

    /**
     * Skenario 7: Uji Akses Halaman Dashboard QA & Testing (Tugas Mandiri Modul 16)
     */
    public function test_halaman_qa_testing_dashboard_berhasil_diakses(): void
    {
        $response = $this->get('/qa-testing');

        $response->assertStatus(200);
        $response->assertSee('Dashboard Quality Assurance, Debugging & Testing');
        $response->assertSee('Tabel Laporan Hasil Temuan Uji Coba & Debugging');
        $response->assertSee('Konsol Pengujian Langsung di Web Browser');
        $response->assertSee('Bukti Rekam Jejak Log Real-Time');
    }
}
