<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce QA & Automated Testing Dashboard - Pertemuan 16</title>
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --success: #16a34a;
            --warning: #d97706;
            --danger: #dc2626;
            --bg: #f8fafc;
            --card-bg: #ffffff;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border: #e2e8f0;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background-color: var(--bg);
            color: var(--text-main);
            margin: 0;
            padding: 40px 20px;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);
            color: white;
            padding: 35px 30px;
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.3);
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0 0 10px 0;
            font-size: 28px;
            font-weight: 700;
        }

        .header p {
            margin: 0;
            color: #cbd5e1;
            font-size: 15px;
            max-width: 850px;
        }

        .badges-top {
            display: flex;
            gap: 10px;
            margin-top: 15px;
            flex-wrap: wrap;
        }

        .badge-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(8px);
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            color: #f8fafc;
        }

        .card {
            background: var(--card-bg);
            border-radius: 14px;
            padding: 28px;
            margin-bottom: 25px;
            border: 1px solid var(--border);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .card-title {
            font-size: 19px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-subtitle {
            color: var(--text-muted);
            font-size: 14px;
            margin-bottom: 20px;
        }

        /* Table QA */
        .table-responsive {
            overflow-x: auto;
        }

        table.qa-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13.5px;
            text-align: left;
        }

        table.qa-table th {
            background: #f1f5f9;
            color: #334155;
            padding: 12px 14px;
            font-weight: 700;
            border-bottom: 2px solid var(--border);
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }

        table.qa-table td {
            padding: 14px;
            border-bottom: 1px solid var(--border);
            vertical-align: top;
        }

        table.qa-table tr:hover {
            background-color: #f8fafc;
        }

        .tag-pass {
            display: inline-block;
            background-color: #dcfce7;
            color: #15803d;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
            border: 1px solid #bbf7d0;
        }

        .tag-error-type {
            display: inline-block;
            background: #fee2e2;
            color: #b91c1c;
            font-weight: 600;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 12px;
        }

        /* Test triggers */
        .test-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
            gap: 16px;
        }

        .test-box {
            background: #f8fafc;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 18px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .test-box.positive { border-left: 4px solid var(--success); }
        .test-box.exception { border-left: 4px solid var(--warning); }
        .test-box.negative { border-left: 4px solid var(--danger); }
        .test-box.debug { border-left: 4px solid var(--primary); }

        .test-box-title {
            font-weight: 700;
            font-size: 15px;
            margin-bottom: 6px;
        }

        .test-box-desc {
            font-size: 13px;
            color: var(--text-muted);
            margin-bottom: 15px;
            flex-grow: 1;
        }

        .btn-test {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 8px 14px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            color: white;
            transition: all 0.2s ease;
        }

        .btn-green { background: var(--success); }
        .btn-green:hover { background: #15803d; }
        .btn-orange { background: var(--warning); }
        .btn-orange:hover { background: #b45309; }
        .btn-red { background: var(--danger); }
        .btn-red:hover { background: #b91c1c; }
        .btn-blue { background: var(--primary); }
        .btn-blue:hover { background: #1d4ed8; }

        /* Log console */
        .log-console {
            background: #0f172a;
            color: #cbd5e1;
            padding: 18px;
            border-radius: 10px;
            font-family: 'Consolas', 'Courier New', monospace;
            font-size: 12.5px;
            max-height: 280px;
            overflow-y: auto;
            white-space: pre-wrap;
            word-break: break-all;
            border: 1px solid #334155;
        }

        .log-line {
            margin-bottom: 4px;
            line-height: 1.4;
        }

        .log-error { color: #f87171; font-weight: bold; }
        .log-warning { color: #fbbf24; font-weight: bold; }
        .log-info { color: #60a5fa; }

        .nav-footer {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .btn-back {
            display: inline-block;
            padding: 10px 20px;
            background: #475569;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
        }

        .btn-back:hover {
            background: #334155;
        }
    </style>
</head>
<body>
<div class="container">

    <!-- HEADER DASHBOARD -->
    <div class="header">
        <h1>E-Commerce QA, Debugging &amp; Automated Testing Dashboard</h1>
        <p>Proyek Cadangan Tugas Mandiri Pertemuan 16: Penanganan Eksepsi (Try-Catch), Pelacakan Bug &amp; Rekam Jejak <code>Log::error()</code>, Halaman Error 404 Kustom, serta Pengujian Otomatis Fitur E-Commerce Menggunakan <code>php artisan test</code>.</p>
        
        <div class="badges-top">
            <span class="badge-pill">✓ Automated Test Suite: PASS</span>
            <span class="badge-pill">✓ MySQL Database: ecommerce_qa_16</span>
            <span class="badge-pill">✓ Eloquent ORM: Product &amp; Order</span>
            <span class="badge-pill">✓ Try-Catch &amp; Log::error Active</span>
        </div>
    </div>

    <!-- KONSOL PENGUJIAN LANGSUNG DI BROWSER (INTERACTIVE TEST RUNNER) -->
    <div class="card">
        <div class="card-title">
            <span>🧪</span> Konsol Pengujian Langsung di Web Browser (Interactive Test Runner)
        </div>
        <div class="card-subtitle">
            Dosen atau penguji dapat langsung mengklik tombol di bawah ini untuk menguji secara real-time berbagai skenario normal, eksepsi ekstrem, dan respon 404 pada aplikasi E-Commerce.
        </div>

        <div class="test-grid">
            <!-- 1. Uji Normal (Positive Test) -->
            <div class="test-box positive">
                <div>
                    <div class="test-box-title" style="color: var(--success);">1. Uji Normal (Positive Test)</div>
                    <div class="test-box-desc">
                        Memastikan katalog produk E-Commerce berhasil dibuka dengan status <b>HTTP 200 OK</b> dan menampilkan seluruh data produk dari MySQL.
                    </div>
                </div>
                <a href="{{ url('/ecommerce') }}" target="_blank" class="btn-test btn-green">
                    Buka /ecommerce &rarr;
                </a>
            </div>

            <!-- 2. Uji Filter Valid (Positive Test) -->
            <div class="test-box positive">
                <div>
                    <div class="test-box-title" style="color: var(--success);">2. Uji Filter Valid (Positive Test)</div>
                    <div class="test-box-desc">
                        Memastikan filter produk berdasarkan kategori valid (misal: <code>elektronik</code>) berhasil menyaring produk dengan benar (200 OK).
                    </div>
                </div>
                <a href="{{ url('/ecommerce?category=elektronik') }}" target="_blank" class="btn-test btn-green">
                    Filter Kategori Elektronik &rarr;
                </a>
            </div>

            <!-- 3. Uji Kategori Ekstrem (Exception Test) -->
            <div class="test-box exception">
                <div>
                    <div class="test-box-title" style="color: var(--warning);">3. Uji Kategori Ekstrem (Exception Test)</div>
                    <div class="test-box-desc">
                        Mengakses kategori palsu/ekstrem: <code>?category=KategoriEkstrem999</code>. Sistem melempar Exception, tertangkap di <b>try-catch</b>, mencatat ke log, dan web <b>tidak crash</b>.
                    </div>
                </div>
                <a href="{{ url('/ecommerce?category=KategoriEkstrem999') }}" target="_blank" class="btn-test btn-orange">
                    Uji Kategori Ekstrem &rarr;
                </a>
            </div>

            <!-- 4. Uji Pembagian Nol (Exception Test) -->
            <div class="test-box exception">
                <div>
                    <div class="test-box-title" style="color: var(--warning);">4. Uji Pembagian Nol (Exception Test)</div>
                    <div class="test-box-desc">
                        Menguji simulasi cicilan dengan tenor <b>0 bulan</b> pada laptop. Blok try-catch menangkal <code>DivisionByZeroError</code> dan mencatat <code>Log::error()</code>.
                    </div>
                </div>
                <a href="{{ url('/ecommerce/cicilan/LAPTOP-PRO-15?tenor=0') }}" target="_blank" class="btn-test btn-orange">
                    Uji Tenor 0 Bulan &rarr;
                </a>
            </div>

            <!-- 5. Uji Kode SKU Palsu (Negative Test 404) -->
            <div class="test-box negative">
                <div>
                    <div class="test-box-title" style="color: var(--danger);">5. Uji SKU Palsu (Negative Test 404)</div>
                    <div class="test-box-desc">
                        Mengakses detail produk dengan kode SKU palsu: <code>SKU-TIDAK-ADA-999</code>. Sistem memicu <code>abort(404)</code> dan menampilkan <b>404.blade.php</b> bertema e-commerce.
                    </div>
                </div>
                <a href="{{ url('/ecommerce/produk/SKU-TIDAK-ADA-999') }}" target="_blank" class="btn-test btn-red">
                    Uji SKU Palsu 404 &rarr;
                </a>
            </div>

            <!-- 6. Uji Stok Habis (Exception Test) -->
            <div class="test-box exception">
                <div>
                    <div class="test-box-title" style="color: var(--warning);">6. Uji Stok 0 / Habis (Exception Test)</div>
                    <div class="test-box-desc">
                        Membuka detail produk yang stoknya 0 (Headset Gaming). Memvalidasi jika ada percobaan order stok habis akan tertangkap Exception.
                    </div>
                </div>
                <a href="{{ url('/ecommerce/produk/HEADSET-71-SURROUND') }}" target="_blank" class="btn-test btn-orange">
                    Cek Produk Stok 0 &rarr;
                </a>
            </div>

            <!-- 7. Uji Praktik Debugging dd() -->
            <div class="test-box debug">
                <div>
                    <div class="test-box-title" style="color: var(--primary);">7. Praktik Debugging dd()</div>
                    <div class="test-box-desc">
                        Menguji pemeriksaan alur variabel mentah Model Product menggunakan fungsi bawaan Laravel <code>dd()</code> dengan parameter <code>?debug=1</code>.
                    </div>
                </div>
                <a href="{{ url('/ecommerce/produk/LAPTOP-PRO-15?debug=1') }}" target="_blank" class="btn-test btn-blue">
                    Inspeksi dd() Produk &rarr;
                </a>
            </div>
        </div>
    </div>

    <!-- TABEL RESMI LAPORAN HASIL TEMUAN UJI COBA & DEBUGGING (SPESIFIKASI SOAL NO 4) -->
    <div class="card">
        <div class="card-title">
            <span>📋</span> Tabel Laporan Hasil Temuan Uji Coba &amp; Debugging E-Commerce
        </div>
        <div class="card-subtitle">
            Format resmi sesuai spesifikasi Tugas Mandiri Modul 16 untuk dipresentasikan dan didiskusikan di kelas.
        </div>

        <div class="table-responsive">
            <table class="qa-table">
                <thead>
                    <tr>
                        <th style="width: 40px;">No</th>
                        <th style="width: 230px;">Nama Fitur / URL di Proyekmu</th>
                        <th style="width: 170px;">Jenis Error / Skenario Uji</th>
                        <th>Penyebab Masalah (Hasil Debugging)</th>
                        <th>Solusi Error Handling / Perbaikan Kode</th>
                        <th style="width: 110px; text-align: center;">Status Hasil Uji</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($laporan_qa as $item)
                    <tr>
                        <td style="font-weight: bold; text-align: center;">{{ $item['no'] }}</td>
                        <td>
                            <b>{{ $item['fitur_url'] }}</b>
                        </td>
                        <td>
                            <span class="tag-error-type">{{ $item['jenis_error'] }}</span>
                        </td>
                        <td style="color: #475569;">
                            {{ $item['penyebab'] }}
                        </td>
                        <td style="color: #1e293b;">
                            {{ $item['solusi'] }}
                        </td>
                        <td style="text-align: center;">
                            <span class="tag-pass">✓ {{ $item['status_uji'] }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- LIVE LOG VIEWER (STORAGE/LOGS/LARAVEL.LOG) -->
    <div class="card">
        <div class="card-title">
            <span>📜</span> Bukti Rekam Jejak Log Real-Time (<code>storage/logs/laravel.log</code>)
        </div>
        <div class="card-subtitle">
            Menampilkan baris-baris log terbaru langsung dari sistem berkas Laravel sebagai bukti fisik bahwa <code>Log::error()</code>, <code>Log::warning()</code>, dan <code>Log::info()</code> tercatat dengan sempurna pada aplikasi E-Commerce.
        </div>

        <div class="log-console">
            @if (count($recent_logs) > 0)
                @foreach ($recent_logs as $log)
                    @php
                        $class = '';
                        if (str_contains($log, '.ERROR:')) {
                            $class = 'log-error';
                        } elseif (str_contains($log, '.WARNING:')) {
                            $class = 'log-warning';
                        } elseif (str_contains($log, '.INFO:')) {
                            $class = 'log-info';
                        }
                    @endphp
                    <div class="log-line {{ $class }}">{{ $log }}</div>
                @endforeach
            @else
                <div style="color: #94a3b8;">Log file kosong atau belum ada pesan log yang direkam.</div>
            @endif
        </div>
    </div>

    <!-- NAVIGASI KEMBALI -->
    <div class="nav-footer">
        <a href="{{ url('/') }}" class="btn-back">&laquo; Kembali ke Portal Utama Aplikasi</a>
        <a href="{{ url('/ecommerce') }}" class="btn-back" style="background: #0284c7;">Ke Katalog E-Commerce &raquo;</a>
    </div>

</div>
</body>
</html>
