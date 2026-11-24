<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - {{ $product->name }}</title>
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
            max-width: 900px;
            margin: 0 auto;
        }

        .card {
            background: white;
            border-radius: 12px;
            border: 1px solid var(--border);
            padding: 28px;
            margin-bottom: 25px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        }

        .badge-cat {
            background: #e0f2fe;
            color: #0369a1;
            font-size: 12px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 4px;
            text-transform: uppercase;
        }

        h1 {
            font-size: 24px;
            margin: 12px 0 6px 0;
            color: #1e293b;
        }

        .sku-label {
            font-family: monospace;
            color: var(--muted);
            font-size: 13px;
            margin-bottom: 15px;
        }

        .price-tag {
            font-size: 26px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 15px;
        }

        .stock-box {
            padding: 8px 14px;
            border-radius: 6px;
            display: inline-block;
            font-size: 13.5px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .stock-avail { background: #dcfce7; color: #166534; }
        .stock-low { background: #fef3c7; color: #92400e; }
        .stock-none { background: #fee2e2; color: #991b1b; }

        .desc-text {
            color: #334155;
            font-size: 14.5px;
            line-height: 1.6;
            margin-bottom: 25px;
            border-top: 1px solid var(--border);
            padding-top: 15px;
        }

        /* Two columns */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 20px;
        }

        .box-action {
            background: #f8fafc;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 20px;
        }

        .box-title {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-group {
            margin-bottom: 14px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 5px;
            color: #334155;
        }

        input[type="number"], select {
            width: 100%;
            padding: 9px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .btn-submit {
            display: inline-block;
            width: 100%;
            padding: 10px;
            background: #0284c7;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-submit:hover { background: #0369a1; }
        .btn-danger { background: #dc2626; }
        .btn-danger:hover { background: #b91c1c; }

        .alert-error {
            background: #fee2e2;
            border-left: 4px solid var(--danger);
            color: #991b1b;
            padding: 12px 14px;
            border-radius: 4px;
            margin-bottom: 15px;
            font-size: 13.5px;
        }

        .alert-success {
            background: #dcfce7;
            border-left: 4px solid var(--success);
            color: #166534;
            padding: 12px 14px;
            border-radius: 4px;
            margin-bottom: 15px;
            font-size: 13.5px;
        }

        .result-box {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #065f46;
            padding: 12px;
            border-radius: 6px;
            margin-top: 15px;
            font-size: 14px;
            font-weight: 600;
        }

        .btn-debug {
            display: inline-block;
            margin-top: 15px;
            padding: 6px 12px;
            background: #64748b;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 12px;
            font-family: monospace;
        }
        .btn-debug:hover { background: #475569; }

        .nav-back {
            margin-top: 25px;
            font-size: 14px;
        }
        .nav-back a { color: var(--primary); text-decoration: none; font-weight: 600; }
        .nav-back a:hover { text-decoration: underline; }
    </style>
</head>
<body>
<div class="container">

    <!-- NOTIFIKASI FLASH -->
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

    <!-- KARTU UTAMA PRODUK -->
    <div class="card">
        <span class="badge-cat">{{ $product->category }}</span>
        <h1>{{ $product->name }}</h1>
        <div class="sku-label">Kode SKU: <b>{{ $product->sku }}</b> &bull; ID Database: #{{ $product->id }}</div>

        <div class="price-tag">{{ $product->formatted_price }}</div>

        <div>
            @if ($product->stock > 5)
                <span class="stock-box stock-avail">● Stok Tersedia ({{ $product->stock }} unit)</span>
            @elseif ($product->stock > 0)
                <span class="stock-box stock-low">● Stok Menipis (Tersisa {{ $product->stock }} unit)</span>
            @else
                <span class="stock-box stock-none">✕ Stok Habis (0 unit)</span>
            @endif
        </div>

        <div class="desc-text">
            <b>Deskripsi Produk:</b><br>
            {{ $product->description }}
        </div>

        <!-- FORM INTERAKTIF DAN SIMULASI ERROR -->
        <div class="features-grid">

            <!-- FORM ORDER / CHECKOUT -->
            <div class="box-action">
                <div class="box-title">
                    <span>🛒</span> Form Transaksi Pemesanan
                </div>
                <p style="font-size: 12.5px; color: var(--muted); margin: 0 0 12px 0;">
                    Diuji dengan validasi try-catch: mencegah stok minus, pembelian negatif, dan stok 0.
                </p>

                <form action="{{ url('/ecommerce/order') }}" method="POST">
                    @csrf
                    <input type="hidden" name="sku" value="{{ $product->sku }}">

                    <div class="form-group">
                        <label>Jumlah Beli (Qty):</label>
                        <input type="number" name="qty" value="1" required>
                        <small style="color: #64748b; font-size: 11px;">Tips QA: Coba input <code>-2</code> atau <code>100</code> untuk menguji tangkapan Exception.</small>
                    </div>

                    <div class="form-group">
                        <label>Diskon Promo (%):</label>
                        <input type="number" name="discount_percent" value="0" min="0" max="100">
                    </div>

                    <button type="submit" class="btn-submit">Proses Pesanan Sekarang</button>
                </form>
            </div>

            <!-- SIMULASI CICILAN (PEMBAGIAN DENGAN NOL) -->
            <div class="box-action">
                <div class="box-title">
                    <span>🧮</span> Simulasi Cicilan &amp; Uji Pembagian Nol
                </div>
                <p style="font-size: 12.5px; color: var(--muted); margin: 0 0 12px 0;">
                    Proses menghitung <code>$price / $tenor</code>. Jika tenor = 0, blok try-catch menangkal <code>DivisionByZeroError</code>.
                </p>

                @if (isset($pesan_error_cicilan) && $pesan_error_cicilan)
                    <div class="alert-error">
                        <b>⚠️ Exception Tertangkap:</b> {{ $pesan_error_cicilan }}
                    </div>
                @endif

                @if (isset($hasil_cicilan) && $hasil_cicilan)
                    <div class="result-box">
                        ✓ Cicilan untuk tenor <b>{{ $tenor_terpilih }} bulan</b> adalah:<br>
                        <span style="font-size: 18px; font-weight: 800; color: #047857;">Rp {{ $hasil_cicilan }} / bulan</span>
                    </div>
                @endif

                <form action="{{ url('/ecommerce/cicilan/' . $product->sku) }}" method="GET" style="margin-top: 12px;">
                    <div class="form-group">
                        <label>Pilih Tenor Cicilan (Bulan):</label>
                        <select name="tenor">
                            <option value="3">3 Bulan (Bunga 0%)</option>
                            <option value="6">6 Bulan (Bunga 0%)</option>
                            <option value="12">12 Bulan (Bunga 0%)</option>
                            <option value="0" {{ (isset($tenor_terpilih) && $tenor_terpilih === 0) ? 'selected' : '' }}>⚡ Uji Tenor 0 Bulan (Division By Zero)</option>
                        </select>
                    </div>

                    <button type="submit" class="btn-submit btn-danger">Hitung Cicilan (Uji Error)</button>
                </form>
            </div>

        </div>

        <div style="margin-top: 20px; border-top: 1px dashed var(--border); padding-top: 15px;">
            <a href="{{ url('/ecommerce/produk/' . $product->sku . '?debug=1') }}" target="_blank" class="btn-debug">
                🔍 Cek Inspeksi Data dd() Produk Ini (?debug=1)
            </a>
        </div>
    </div>

    <!-- NAVIGASI -->
    <div class="nav-back">
        <a href="{{ url('/ecommerce') }}">&laquo; Kembali ke Katalog E-Commerce</a> |
        <a href="{{ url('/ecommerce/qa-dashboard') }}">Ke Dashboard QA &amp; Testing E-Commerce &raquo;</a>
    </div>

</div>
</body>
</html>
