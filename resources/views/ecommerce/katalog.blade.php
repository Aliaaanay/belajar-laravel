<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog E-Commerce - QA & Error Handling</title>
    <style>
        :root {
            --primary: #0284c7;
            --primary-dark: #0369a1;
            --success: #16a34a;
            --danger: #dc2626;
            --warning: #d97706;
            --bg: #f8fafc;
            --card: #ffffff;
            --text: #0f172a;
            --muted: #64748b;
            --border: #e2e8f0;
        }

        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: var(--bg);
            color: var(--text);
            margin: 0;
            padding: 30px 20px;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: white;
            padding: 24px 28px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .header h1 {
            margin: 0 0 6px 0;
            font-size: 24px;
        }

        .header p {
            margin: 0;
            color: #94a3b8;
            font-size: 14px;
        }

        .btn-qa {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
        }

        .btn-qa:hover { background: #1d4ed8; }

        /* Filter bar */
        .filter-bar {
            display: flex;
            gap: 10px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        .filter-link {
            padding: 8px 16px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 20px;
            text-decoration: none;
            color: var(--text);
            font-size: 13.5px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .filter-link:hover, .filter-link.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .alert-error {
            background: #fee2e2;
            border-left: 4px solid var(--danger);
            color: #991b1b;
            padding: 14px 18px;
            border-radius: 6px;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .alert-success {
            background: #dcfce7;
            border-left: 4px solid var(--success);
            color: #166534;
            padding: 14px 18px;
            border-radius: 6px;
            margin-bottom: 25px;
            font-size: 14px;
        }

        /* Products Grid */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(310px, 1fr));
            gap: 20px;
        }

        .product-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 2px 4px rgba(0,0,0,0.04);
            transition: transform 0.2s;
        }

        .product-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.08);
        }

        .badge-cat {
            display: inline-block;
            background: #e0f2fe;
            color: #0369a1;
            font-size: 11.5px;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 4px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .product-title {
            font-size: 16px;
            font-weight: 700;
            color: #1e293b;
            margin: 0 0 8px 0;
        }

        .product-sku {
            font-size: 12px;
            color: var(--muted);
            margin-bottom: 12px;
            font-family: monospace;
        }

        .product-desc {
            font-size: 13px;
            color: #475569;
            margin-bottom: 15px;
            line-height: 1.5;
            flex-grow: 1;
        }

        .product-price {
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 6px;
        }

        .stock-tag {
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .stock-available { color: var(--success); }
        .stock-low { color: var(--warning); }
        .stock-empty { color: var(--danger); font-weight: bold; }

        .btn-detail {
            display: block;
            text-align: center;
            background: #0284c7;
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            font-size: 13px;
            transition: background 0.2s;
        }

        .btn-detail:hover { background: #0369a1; }

        .nav-back {
            margin-top: 35px;
            font-size: 14px;
        }
        .nav-back a { color: var(--primary); text-decoration: none; font-weight: 600; }
        .nav-back a:hover { text-decoration: underline; }
    </style>
</head>
<body>
<div class="container">

    <!-- HEADER -->
    <div class="header">
        <div>
            <h1>Katalog Produk E-Commerce</h1>
            <p>Implementasi MVC, Validasi Ekstrem, Penanganan Error Try-Catch, dan Uji 404 Kustom.</p>
        </div>
        <div>
            <a href="{{ url('/ecommerce/qa-dashboard') }}" class="btn-qa">
                <span>🛡️</span> Buka Dashboard QA &amp; Testing &rarr;
            </a>
        </div>
    </div>

    <!-- NOTIFIKASI HASIL UJI COBA -->
    @if (session('success'))
        <div class="alert-success">
            <b>✓ Sukses:</b> {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert-error">
            <b>⚠️ Peringatan Error Handling (Try-Catch):</b> {{ session('error') }}
        </div>
    @endif

    @if ($pesan_error)
        <div class="alert-error">
            <b>⚠️ Tangkapan Eksepsi (Try-Catch):</b> {{ $pesan_error }}
            <div style="font-size: 12.5px; margin-top: 4px; color: #7f1d1d;">
                Error telah dicatat ke <code>storage/logs/laravel.log</code> dan aplikasi tetap berjalan normal tanpa crash!
            </div>
        </div>
    @endif

    <!-- FILTER KATEGORI -->
    <div class="filter-bar">
        <a href="{{ url('/ecommerce') }}" class="filter-link {{ $kategori_aktif == 'semua' ? 'active' : '' }}">Semua Produk</a>
        <a href="{{ url('/ecommerce?category=elektronik') }}" class="filter-link {{ strtolower($kategori_aktif) == 'elektronik' ? 'active' : '' }}">Elektronik</a>
        <a href="{{ url('/ecommerce?category=aksesoris') }}" class="filter-link {{ strtolower($kategori_aktif) == 'aksesoris' ? 'active' : '' }}">Aksesoris</a>
        <a href="{{ url('/ecommerce?category=KategoriEkstrem999') }}" class="filter-link" style="color: #dc2626; border-color: #fca5a5;">⚡ Uji Kategori Ekstrem (Try-Catch)</a>
    </div>

    <!-- GRID PRODUK -->
    <div class="grid">
        @forelse ($products as $item)
            <div class="product-card">
                <div>
                    <span class="badge-cat">{{ $item->category }}</span>
                    <h3 class="product-title">{{ $item->name }}</h3>
                    <div class="product-sku">SKU: {{ $item->sku }}</div>
                    <p class="product-desc">{{ $item->description }}</p>
                </div>

                <div>
                    <div class="product-price">{{ $item->formatted_price }}</div>
                    <div class="stock-tag">
                        @if ($item->stock > 5)
                            <span class="stock-available">● Stok Tersedia: {{ $item->stock }} unit</span>
                        @elseif ($item->stock > 0)
                            <span class="stock-low">● Stok Menipis: sisa {{ $item->stock }} unit</span>
                        @else
                            <span class="stock-empty">✕ Stok Habis (0 unit)</span>
                        @endif
                    </div>

                    <a href="{{ url('/ecommerce/produk/' . $item->sku) }}" class="btn-detail">
                        Lihat Detail &amp; Simulasi &rarr;
                    </a>
                </div>
            </div>
        @empty
            <div style="grid-column: 1 / -1; background: white; padding: 40px; text-align: center; border-radius: 10px; border: 1px dashed var(--border);">
                <div style="font-size: 40px; margin-bottom: 10px;">📦</div>
                <h4 style="margin: 0 0 6px 0; color: #475569;">Tidak Ada Produk yang Ditampilkan</h4>
                <p style="margin: 0; color: #94a3b8; font-size: 13.5px;">Filter tidak cocok atau terjadi penanganan eksepsi kategori tidak valid.</p>
            </div>
        @endforelse
    </div>

    <div class="nav-back">
        <a href="{{ url('/') }}">&laquo; Kembali ke Portal Utama Aplikasi</a> |
        <a href="{{ url('/ecommerce/qa-dashboard') }}">Ke Dashboard QA &amp; Testing E-Commerce &raquo;</a>
    </div>

</div>
</body>
</html>
