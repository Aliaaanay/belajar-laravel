<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Order;

class EcommerceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Data Awal Produk (Mencakup Produk Normal, Stok Sedikit, dan Stok 0)
        $products = [
            [
                'sku' => 'LAPTOP-PRO-15',
                'name' => 'Laptop ASUS ROG Zephyrus G15 AMD Ryzen 9',
                'category' => 'Elektronik',
                'price' => 18500000,
                'stock' => 8,
                'description' => 'Laptop gaming ultra-slim dengan prosesor AMD Ryzen 9, RAM 16GB, SSD 1TB, dan layar 165Hz QHD.'
            ],
            [
                'sku' => 'MOUSE-WIRELESS-RGB',
                'name' => 'Mouse Gaming Wireless RGB Dual Mode 2.4GHz',
                'category' => 'Aksesoris',
                'price' => 350000,
                'stock' => 25,
                'description' => 'Mouse ergonomis nirkabel dengan sensor optik presisi tinggi hingga 12.000 DPI dan lampu RGB.'
            ],
            [
                'sku' => 'KEYBOARD-MECH-TKL',
                'name' => 'Keyboard Mechanical TKL RGB Blue Switch',
                'category' => 'Aksesoris',
                'price' => 750000,
                'stock' => 2, // Stok sedikit untuk uji batas
                'description' => 'Keyboard mekanik form-factor TKL dengan tactile clicky blue switch dan detachable braided cable.'
            ],
            [
                'sku' => 'HEADSET-71-SURROUND',
                'name' => 'Gaming Headset 7.1 Surround Sound Noise Cancelling',
                'category' => 'Aksesoris',
                'price' => 620000,
                'stock' => 0, // Stok habis untuk uji Exception/Error handling
                'description' => 'Headset over-ear dengan mikrofon noise cancelling dan audio spasial 7.1 surround sound.'
            ],
            [
                'sku' => 'MONITOR-CURVED-144',
                'name' => 'Monitor Ultra Curved Gaming 27 Inch 144Hz FHD',
                'category' => 'Elektronik',
                'price' => 320000,
                'stock' => 0, // Stok habis untuk uji Exception
                'description' => 'Monitor lengkung 1500R dengan refresh rate 144Hz, response time 1ms, dan teknologi FreeSync.'
            ],
            [
                'sku' => 'CHARGER-GAN-65W',
                'name' => 'Fast Charger GaN 65W Dual Port USB-C & USB-A',
                'category' => 'Elektronik',
                'price' => 280000,
                'stock' => 15,
                'description' => 'Kepala adaptor charger berteknologi GaN compact untuk pengisian cepat laptop dan smartphone.'
            ],
        ];

        foreach ($products as $item) {
            Product::updateOrCreate(['sku' => $item['sku']], $item);
        }

        // 2. Data Transaksi / Pesanan Awal
        $laptop = Product::where('sku', 'LAPTOP-PRO-15')->first();
        if ($laptop) {
            Order::updateOrCreate(
                ['invoice_code' => 'INV-20261124-001'],
                [
                    'product_id' => $laptop->id,
                    'qty' => 1,
                    'discount_percent' => 5, // Diskon 5%
                    'shipping_cost' => 25000,
                    'total_price' => (18500000 * 0.95) + 25000, // Rp 17.600.000
                    'status' => 'SUCCESS'
                ]
            );
        }

        $mouse = Product::where('sku', 'MOUSE-WIRELESS-RGB')->first();
        if ($mouse) {
            Order::updateOrCreate(
                ['invoice_code' => 'INV-20261124-002'],
                [
                    'product_id' => $mouse->id,
                    'qty' => 2,
                    'discount_percent' => 0,
                    'shipping_cost' => 15000,
                    'total_price' => (350000 * 2) + 15000, // Rp 715.000
                    'status' => 'SUCCESS'
                ]
            );
        }
    }
}
