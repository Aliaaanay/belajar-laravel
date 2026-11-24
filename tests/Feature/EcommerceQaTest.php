<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Database\Seeders\EcommerceSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EcommerceQaTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Seed data produk dan pesanan awal untuk lingkungan testing
        $this->seed(EcommerceSeeder::class);
    }

    /**
     * 1. Skenario Normal (Positive Test): Memastikan katalog produk termuat 200 OK
     */
    public function test_katalog_ecommerce_berhasil_diakses_positive_test(): void
    {
        $response = $this->get('/ecommerce');

        $response->assertStatus(200);
        $response->assertSee('Katalog Produk E-Commerce');
        $response->assertSee('LAPTOP-PRO-15');
        $response->assertSee('Laptop ASUS ROG');
    }

    /**
     * 2. Skenario Normal (Positive Test): Filter kategori valid
     */
    public function test_filter_kategori_valid_positive_test(): void
    {
        $response = $this->get('/ecommerce?category=elektronik');

        $response->assertStatus(200);
        $response->assertSee('Laptop ASUS ROG');
    }

    /**
     * 3. Skenario Exception Test: Filter kategori ekstrem/tidak terdaftar
     */
    public function test_filter_kategori_ekstrem_menghasilkan_exception_try_catch(): void
    {
        $response = $this->get('/ecommerce?category=KategoriEkstrem999');

        $response->assertStatus(200);
        $response->assertSee('Tangkapan Eksepsi (Try-Catch)');
        $response->assertSee('tidak terdaftar dalam sistem katalog toko kami');
    }

    /**
     * 4. Skenario Normal (Positive Test): Detail produk valid
     */
    public function test_detail_produk_valid_berhasil_diakses(): void
    {
        $response = $this->get('/ecommerce/produk/LAPTOP-PRO-15');

        $response->assertStatus(200);
        $response->assertSee('Laptop ASUS ROG Zephyrus G15 AMD Ryzen 9');
        $response->assertSee('LAPTOP-PRO-15');
    }

    /**
     * 5. Skenario Negative Test: Akses produk dengan SKU palsu menghasilkan 404
     */
    public function test_detail_produk_sku_palsu_mengembalikan_404_negative_test(): void
    {
        $response = $this->get('/ecommerce/produk/SKU-TIDAK-ADA-999');

        $response->assertStatus(404);
        $response->assertSee('404');
        $response->assertSee('tidak ditemukan di dalam inventaris toko');
    }

    /**
     * 6. Skenario Exception Test: Simulasi cicilan dengan tenor 0 bulan menangkal DivisionByZeroError
     */
    public function test_simulasi_cicilan_pembagian_nol_dicegah_try_catch(): void
    {
        $response = $this->get('/ecommerce/cicilan/LAPTOP-PRO-15?tenor=0');

        $response->assertStatus(200);
        $response->assertSee('Exception Tertangkap');
        $response->assertSee('Pembagian dengan nol tidak diperbolehkan dalam kalkulasi cicilan');
    }

    /**
     * 7. Skenario Positive Test: Transaksi pembelian berhasil
     */
    public function test_transaksi_pembelian_berhasil_mengurangi_stok(): void
    {
        $response = $this->post('/ecommerce/order', [
            'sku' => 'MOUSE-WIRELESS-RGB',
            'qty' => 2,
            'discount_percent' => 0
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        // Pastikan stok mouse berkurang dari 25 menjadi 23
        $mouse = Product::where('sku', 'MOUSE-WIRELESS-RGB')->first();
        $this->assertEquals(23, $mouse->stock);
    }

    /**
     * 8. Skenario Exception Test: Transaksi dengan jumlah beli negatif
     */
    public function test_transaksi_pembelian_qty_negatif_menghasilkan_exception(): void
    {
        $response = $this->post('/ecommerce/order', [
            'sku' => 'MOUSE-WIRELESS-RGB',
            'qty' => -5
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error');
    }

    /**
     * 9. Skenario Exception Test: Transaksi pada produk yang stoknya habis (0 unit)
     */
    public function test_transaksi_pembelian_stok_habis_menghasilkan_exception(): void
    {
        $response = $this->post('/ecommerce/order', [
            'sku' => 'HEADSET-71-SURROUND',
            'qty' => 1
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error');
    }

    /**
     * 10. Skenario Positive Test: Akses Halaman Dashboard QA & Testing E-Commerce
     */
    public function test_qa_dashboard_ecommerce_berhasil_diakses(): void
    {
        $response = $this->get('/ecommerce/qa-dashboard');

        $response->assertStatus(200);
        $response->assertSee('E-Commerce QA, Debugging & Automated Testing Dashboard');
        $response->assertSee('Tabel Laporan Hasil Temuan Uji Coba & Debugging E-Commerce');
        $response->assertSee('Konsol Pengujian Langsung di Web Browser');
        $response->assertSee('Bukti Rekam Jejak Log Real-Time');
    }
}
