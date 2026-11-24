<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class EcommerceController extends Controller
{
    // Whitelist kategori resmi
    private array $kategori_valid = ['elektronik', 'aksesoris'];

    /**
     * 1. Menampilkan Katalog Produk E-Commerce dengan Filter Kategori & Exception Handling
     */
    public function index(Request $request)
    {
        $kategori = $request->query('category');
        $pesan_error = null;
        $products = collect();

        try {
            // Validasi filter kategori jika disediakan
            if ($kategori && $kategori !== 'semua') {
                if (!in_array(strtolower($kategori), $this->kategori_valid)) {
                    Log::warning("Pencarian filter kategori tidak valid terdeteksi: {$kategori}");
                    throw new \Exception("Kategori produk [{$kategori}] tidak terdaftar dalam sistem katalog toko kami.");
                }

                $products = Product::where('category', ucfirst($kategori))->get();
            } else {
                $products = Product::all();
            }

            Log::info("Katalog produk diakses", [
                'total_produk' => $products->count(),
                'filter' => $kategori ?? 'semua'
            ]);
        } catch (\Throwable $e) {
            Log::error("Error pada pemuatan katalog produk: " . $e->getMessage());
            $pesan_error = $e->getMessage();
            $products = collect(); // Kosongkan agar aman dan tidak crash
        }

        return view('ecommerce.katalog', [
            'products' => $products,
            'kategori_aktif' => $kategori ?? 'semua',
            'pesan_error' => $pesan_error
        ]);
    }

    /**
     * 2. Menampilkan Detail Produk dengan abort(404) dan Simulasi Debugging dd()
     */
    public function detail(Request $request, $sku)
    {
        // Cari produk berdasarkan SKU atau ID
        $product = Product::where('sku', $sku)->orWhere('id', $sku)->first();

        // Praktik Debugging menggunakan dd() jika ada parameter ?debug=1
        if ($request->query('debug') == '1') {
            dd([
                'DEBUG_STATUS' => 'Inspeksi data produk mentah melalui dd()',
                'sku_dicari' => $sku,
                'product_model' => $product,
                'memory_usage' => memory_get_usage(),
                'timestamp' => now()->toDateTimeString()
            ]);
        }

        if (!$product) {
            Log::warning("Akses produk tidak ditemukan untuk SKU/ID: {$sku}");
            abort(404, "Produk dengan SKU/ID [{$sku}] tidak ditemukan di dalam inventaris toko.");
        }

        Log::info("Menampilkan detail produk: {$product->name} (SKU: {$product->sku})");

        return view('ecommerce.detail', [
            'product' => $product
        ]);
    }

    /**
     * 3. Pemrosesan Pesanan (Checkout) dengan Validasi Ekstrem & Try-Catch
     */
    public function order(Request $request)
    {
        try {
            $sku = $request->input('sku');
            $qty = (int) $request->input('qty');
            $diskon = (float) $request->input('discount_percent', 0);
            $ongkir = 20000;

            $product = Product::where('sku', $sku)->first();

            if (!$product) {
                Log::warning("Gagal checkout: SKU {$sku} tidak terdaftar.");
                throw new \Exception("Produk dengan SKU [{$sku}] tidak ditemukan.");
            }

            // Pengecualian 1: Jumlah beli tidak wajar (negatif atau nol)
            if ($qty <= 0) {
                Log::warning("Percobaan pembelian jumlah tidak valid: {$qty} unit pada SKU {$sku}");
                throw new \Exception("Jumlah pembelian (qty) tidak valid ({$qty}). Minimal pembelian adalah 1 unit.");
            }

            // Pengecualian 2: Stok habis
            if ($product->stock <= 0) {
                Log::warning("Percobaan pembelian produk dengan stok habis: SKU {$sku}");
                throw new \Exception("Maaf, stok produk [{$product->name}] saat ini habis (0 unit).");
            }

            // Pengecualian 3: Qty melebihi stok yang tersedia
            if ($qty > $product->stock) {
                Log::warning("Jumlah pesanan ({$qty}) melebihi stok ({$product->stock}) untuk SKU {$sku}");
                throw new \Exception("Jumlah pesanan ({$qty} unit) melebihi sisa stok yang tersedia ({$product->stock} unit).");
            }

            // Perhitungan Total
            $subtotal = $product->price * $qty;
            $potonganDiskon = $subtotal * ($diskon / 100);
            $totalHarga = ($subtotal - $potonganDiskon) + $ongkir;

            // Simpan transaksi
            $invoiceCode = 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(5));
            $order = Order::create([
                'invoice_code' => $invoiceCode,
                'product_id' => $product->id,
                'qty' => $qty,
                'discount_percent' => $diskon,
                'shipping_cost' => $ongkir,
                'total_price' => $totalHarga,
                'status' => 'SUCCESS'
            ]);

            // Potong stok produk
            $product->decrement('stock', $qty);

            Log::info("Pesanan baru berhasil diproses", [
                'invoice' => $invoiceCode,
                'sku' => $product->sku,
                'qty' => $qty,
                'total' => $totalHarga
            ]);

            return redirect()->back()->with('success', "Pesanan berhasil dibuat! No. Invoice: {$invoiceCode} (Total: Rp " . number_format($totalHarga, 0, ',', '.') . ")");
        } catch (\Throwable $e) {
            Log::error("Kesalahan transaksi pemesanan: " . $e->getMessage());

            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * 4. Simulasi Cicilan (Demonstrasi Penanganan Pembagian Nol / DivisionByZeroError)
     */
    public function simulasiCicilan(Request $request, $sku)
    {
        $product = Product::where('sku', $sku)->first();

        if (!$product) {
            Log::warning("Simulasi cicilan gagal: SKU {$sku} tidak ada.");
            abort(404, "Produk dengan SKU [{$sku}] tidak ditemukan.");
        }

        $tenor = (int) $request->input('tenor', 0);
        $hasil_cicilan = null;
        $pesan_error = null;

        try {
            // Mencegah dan menangkal pembagian dengan nol (DivisionByZeroError)
            if ($tenor <= 0) {
                Log::error("Percobaan pembagian nol terdeteksi pada kalkulasi cicilan SKU {$sku} dengan tenor {$tenor}");
                throw new \Exception("Tenor cicilan bernilai 0 bulan. Pembagian dengan nol tidak diperbolehkan dalam kalkulasi cicilan.");
            }

            $cicilanPerBulan = $product->price / $tenor;
            $hasil_cicilan = number_format($cicilanPerBulan, 0, ',', '.');

            Log::info("Kalkulasi cicilan berhasil", [
                'sku' => $sku,
                'tenor' => $tenor,
                'cicilan' => $cicilanPerBulan
            ]);
        } catch (\Throwable $e) {
            Log::error("Error kalkulasi cicilan: " . $e->getMessage());
            $pesan_error = $e->getMessage();
        }

        return view('ecommerce.detail', [
            'product' => $product,
            'hasil_cicilan' => $hasil_cicilan,
            'tenor_terpilih' => $tenor,
            'pesan_error_cicilan' => $pesan_error
        ]);
    }

    /**
     * 5. Dashboard QA & Interactive Test Runner E-Commerce (Tugas Mandiri 16)
     */
    public function qaDashboard()
    {
        // Tabel Resmi Hasil Temuan Uji Coba & Debugging Sesuai Soal Tugas 16
        $laporan_qa = [
            [
                'no' => 1,
                'fitur_url' => 'Simulasi Cicilan Produk (/ecommerce/cicilan/{sku})',
                'jenis_error' => 'Runtime Error (DivisionByZero)',
                'penyebab' => 'Pengguna menginput periode tenor cicilan bernilai 0 bulan. Operasi $price / $tenor memicu fatal DivisionByZeroError yang membuat web crash.',
                'solusi' => 'Membungkus proses perhitungan dalam blok try-catch, melempar Exception jika $tenor <= 0, mencatat jejak Log::error(), dan menampilkan alert ramah ke pengguna.',
                'status_uji' => 'PASS'
            ],
            [
                'no' => 2,
                'fitur_url' => 'Filter Kategori Produk (/ecommerce?category={kategori})',
                'jenis_error' => 'Logical & Validation Error',
                'penyebab' => 'Pengguna menginput nilai kategori URL yang tidak wajar (seperti "KategoriEkstrem999"). Tanpa validasi whitelist, query database mengembalikan data kosong tak terdefinisi.',
                'solusi' => 'Memvalidasi kategori terhadap whitelist resmi. Jika tidak cocok, melempar Exception, merekam Log::warning() & Log::error(), serta merender katalog kosong dengan pesan peringatan.',
                'status_uji' => 'PASS'
            ],
            [
                'no' => 3,
                'fitur_url' => 'Detail Produk & SKU (/ecommerce/produk/{sku})',
                'jenis_error' => '404 Not Found (Missing Resource)',
                'penyebab' => 'Pengguna mengakses tautan atau mengetikkan kode SKU fiktif (seperti SKU-TIDAK-ADA-999). Jika model mengembalikan null, akses properti memicu error "Attempt to read property on null".',
                'solusi' => 'Mengecek ketersediaan data produk. Jika null, memanggil abort(404) dan menampilkan halaman responsif kustom di resources/views/errors/404.blade.php.',
                'status_uji' => 'PASS'
            ],
            [
                'no' => 4,
                'fitur_url' => 'Proses Transaksi Checkout (/ecommerce/order POST)',
                'jenis_error' => 'Runtime & Business Logic Error',
                'penyebab' => 'Pembeli memasukkan jumlah beli negatif (qty: -2) atau memesan produk yang stoknya sudah 0 (stok habis). Mengakibatkan stok database menjadi minus.',
                'solusi' => 'Validasi batas $qty <= 0 dan verifikasi $product->stock <= 0 dengan melempar Exception khusus serta mencatat riwayat kegagalan transaksi di Log::error().',
                'status_uji' => 'PASS'
            ],
        ];

        // Membaca 20 baris log terakhir dari storage/logs/laravel.log
        $logPath = storage_path('logs/laravel.log');
        $recentLogs = [];
        if (File::exists($logPath)) {
            $lines = file($logPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            if ($lines !== false) {
                $recentLogs = array_slice($lines, -25);
            }
        }

        return view('ecommerce.qa_dashboard', [
            'laporan_qa' => $laporan_qa,
            'recent_logs' => $recentLogs
        ]);
    }
}
