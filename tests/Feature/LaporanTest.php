<?php

namespace Tests\Feature;

use Tests\TestCase;
use Database\Seeders\EcommerceSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LaporanTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(EcommerceSeeder::class);
    }

    /**
     * Uji Latihan 17: Akses Halaman Web Laporan Kas Himpunan Mahasiswa
     */
    public function test_halaman_laporan_kas_berhasil_diakses(): void
    {
        $response = $this->get('/laporan');

        $response->assertStatus(200);
        $response->assertSee('Laporan Keuangan Kas Himpunan Mahasiswa');
        $response->assertSee('TRX-001');
        $response->assertSee('Iuran Kas Anggota');
        $response->assertSee('Saldo Akhir Kas:');
    }

    /**
     * Uji Latihan 17: Filter Kategori Pemasukan
     */
    public function test_filter_laporan_kas_kategori_pemasukan(): void
    {
        $response = $this->get('/laporan?kategori=Pemasukan');

        $response->assertStatus(200);
        $response->assertSee('Kategori: Pemasukan');
        $response->assertSee('TRX-001');
    }

    /**
     * Uji Latihan 17: Export PDF Laporan Kas (Stream Preview)
     */
    public function test_export_laporan_kas_pdf(): void
    {
        $response = $this->get('/laporan/pdf?mode=stream');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
    }

    /**
     * Uji Latihan 17: Export Excel (CSV) Laporan Kas
     */
    public function test_export_laporan_kas_excel_csv(): void
    {
        $response = $this->get('/laporan/excel');

        $response->assertStatus(200);
        $this->assertStringContainsString('text/csv', $response->headers->get('Content-Type'));
    }

    /**
     * Uji Tugas 17: Akses Halaman Web Laporan Penjualan E-Commerce
     */
    public function test_halaman_laporan_penjualan_ecommerce_berhasil_diakses(): void
    {
        $response = $this->get('/ecommerce/laporan');

        $response->assertStatus(200);
        $response->assertSee('Laporan Rekapitulasi Penjualan E-Commerce');
        $response->assertSee('Total Omset Pendapatan');
    }

    /**
     * Uji Tugas 17: Export PDF Laporan Penjualan E-Commerce
     */
    public function test_export_laporan_penjualan_ecommerce_pdf(): void
    {
        $response = $this->get('/ecommerce/laporan/pdf?mode=stream');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
    }

    /**
     * Uji Tugas 17: Export Excel (CSV) Laporan Penjualan E-Commerce
     */
    public function test_export_laporan_penjualan_ecommerce_excel(): void
    {
        $response = $this->get('/ecommerce/laporan/excel');

        $response->assertStatus(200);
        $this->assertStringContainsString('text/csv', $response->headers->get('Content-Type'));
    }

    /**
     * Uji Praktik 18: Akses Halaman Kontak Kampus (Hasil Merge Cabang fitur-kontak)
     */
    public function test_halaman_kontak_pertemuan_18_berhasil_diakses(): void
    {
        $response = $this->get('/kontak');

        $response->assertStatus(200);
        $response->assertSee('Kontak Kampus & Layanan Akademik');
        $response->assertSee('fitur-kontak');
    }
}
