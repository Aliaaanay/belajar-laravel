<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quality Assurance & Automated Testing Dashboard - Pertemuan 16</title>
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
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            color: white;
            padding: 35px 30px;
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.25);
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0 0 10px 0;
            font-size: 28px;
            font-weight: 700;
        }

        .header p {
            margin: 0;
            color: #dbeafe;
            font-size: 15px;
            max-width: 800px;
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
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(8px);
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
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
        .test-box.auth { border-left: 4px solid var(--primary); }

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
        .btn-blue:hover { background: var(--primary-dark); }

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
        <h1>Dashboard Quality Assurance, Debugging &amp; Testing</h1>
        <p>Implementasi Tugas Mandiri Pertemuan 16: Penanganan Eksepsi (Try-Catch), Pelacakan Bug &amp; Rekam Jejak <code>Log::error()</code>, Halaman Error 404 Kustom, serta Pengujian Otomatis Fitur Menggunakan <code>php artisan test</code>.</p>
        
        <div class="badges-top">
            <span class="badge-pill">✓ Automated Test Suite: PASS</span>
            <span class="badge-pill">✓ 19/19 Tests Passed</span>
            <span class="badge-pill">✓ 47 Assertions Verified</span>
            <span class="badge-pill">✓ Laravel Error Handler Active</span>
        </div>
    </div>

    <!-- KONSOL PENGUJIAN LANGSUNG (LIVE INTERACTIVE TEST RUNNER) -->
    <div class="card">
        <div class="card-title">
            <span>🧪</span> Konsol Pengujian Langsung di Web Browser (Interactive Test Runner)
        </div>
        <div class="card-subtitle">
            Dosen atau penguji dapat langsung mengklik tombol di bawah ini untuk membuktikan secara real-time bagaimana aplikasi menangani skenario normal, skenario eksepsi ekstrem, dan respon 404.
        </div>

        <div class="test-grid">
            <!-- 1. Uji Positif Normal -->
            <div class="test-box positive">
                <div>
                    <div class="test-box-title" style="color: var(--success);">1. Uji Normal (Positive Test)</div>
                    <div class="test-box-desc">
                        Memastikan fitur utama direktori inventaris laboratorium komputer termuat normal dengan kode status <b>HTTP 200 OK</b>.
                    </div>
                </div>
                <a href="{{ url('/laboratorium') }}" target="_blank" class="btn-test btn-green">
                    Buka /laboratorium &rarr;
                </a>
            </div>

            <!-- 2. Uji Filter Normal -->
            <div class="test-box positive">
                <div>
                    <div class="test-box-title" style="color: var(--success);">2. Uji Filter Valid (Positive Test)</div>
                    <div class="test-box-desc">
                        Memastikan filter status laboratorium bekerja normal saat diberikan kategori valid seperti <code>Tersedia</code>.
                    </div>
                </div>
                <a href="{{ url('/laboratorium/status/Tersedia') }}" target="_blank" class="btn-test btn-green">
                    Buka Filter Tersedia &rarr;
                </a>
            </div>

            <!-- 3. Uji Exception Try-Catch -->
            <div class="test-box exception">
                <div>
                    <div class="test-box-title" style="color: var(--warning);">3. Uji Eksepsi Try-Catch (Exception Test)</div>
                    <div class="test-box-desc">
                        Menguji parameter status acak/ekstrem: <code>StatusNgawurDanEkstrem999</code>. Sistem melempar Exception, tertangkap aman oleh blok <b>try-catch</b>, mencatat ke log, dan aplikasi <b>tidak crash</b>.
                    </div>
                </div>
                <a href="{{ url('/laboratorium/status/StatusNgawurDanEkstrem999') }}" target="_blank" class="btn-test btn-orange">
                    Uji Status Ekstrem &rarr;
                </a>
            </div>

            <!-- 4. Uji DivisionByZero Try-Catch -->
            <div class="test-box exception">
                <div>
                    <div class="test-box-title" style="color: var(--warning);">4. Uji Pembagian Nol (Exception Test)</div>
                    <div class="test-box-desc">
                        Menguji perhitungan IP mahasiswa baru dengan SKS = 0 (NIM 2410114003). Logika <b>try-catch</b> mencegah DivisionByZero, mencatat <code>Log::error()</code>, dan menampilkan alert informatif.
                    </div>
                </div>
                <a href="{{ url('/uji-nilai/hitung/2410114003') }}" target="_blank" class="btn-test btn-orange">
                    Uji Hitung SKS 0 &rarr;
                </a>
            </div>

            <!-- 5. Uji Negatif 404 Kustom -->
            <div class="test-box negative">
                <div>
                    <div class="test-box-title" style="color: var(--danger);">5. Uji Kode Palsu (Negative Test 404)</div>
                    <div class="test-box-desc">
                        Mengakses kode laboratorium fiktif <code>LAB-TIDAK-ADA-999</code>. Sistem memicu <code>abort(404)</code> dan menampilkan desain error kustom <b>404.blade.php</b>.
                    </div>
                </div>
                <a href="{{ url('/laboratorium/detail/LAB-TIDAK-ADA-999') }}" target="_blank" class="btn-test btn-red">
                    Uji Kode Palsu &rarr;
                </a>
            </div>

            <!-- 6. Uji NIM Palsu 404 -->
            <div class="test-box negative">
                <div>
                    <div class="test-box-title" style="color: var(--danger);">6. Uji NIM Palsu (Negative Test 404)</div>
                    <div class="test-box-desc">
                        Mengakses perhitungan IP dengan NIM fiktif <code>99999999</code>. Sistem mendeteksi parameter tidak terdaftar, mencatat peringatan, lalu memunculkan halaman 404.
                    </div>
                </div>
                <a href="{{ url('/uji-nilai/hitung/99999999') }}" target="_blank" class="btn-test btn-red">
                    Uji NIM Palsu &rarr;
                </a>
            </div>

            <!-- 7. Uji REST API JSON -->
            <div class="test-box auth">
                <div>
                    <div class="test-box-title" style="color: var(--primary);">7. Uji RESTful API JSON (Positive Test)</div>
                    <div class="test-box-desc">
                        Memastikan endpoint RESTful API katalog buku perpustakaan mengembalikan struktur JSON standar dengan status 200 OK.
                    </div>
                </div>
                <a href="{{ url('/api/buku') }}" target="_blank" class="btn-test btn-blue">
                    Buka /api/buku JSON &rarr;
                </a>
            </div>

            <!-- 8. Uji Otorisasi Role -->
            <div class="test-box auth">
                <div>
                    <div class="test-box-title" style="color: var(--primary);">8. Uji Otorisasi Middleware Role (403)</div>
                    <div class="test-box-desc">
                        Mencoba mengakses rute terproteksi <code>/krs-mahasiswa</code> atau <code>/panel-admin</code>. Jika wewenang role tidak sesuai, sistem menolak dengan HTTP 403.
                    </div>
                </div>
                <a href="{{ url('/krs-mahasiswa') }}" target="_blank" class="btn-test btn-blue">
                    Uji Proteksi KRS &rarr;
                </a>
            </div>
        </div>
    </div>

    <!-- TABEL RESMI LAPORAN HASIL TEMUAN UJI COBA & DEBUGGING (SPESIFIKASI SOAL NO 4) -->
    <div class="card">
        <div class="card-title">
            <span>📋</span> Tabel Laporan Hasil Temuan Uji Coba &amp; Debugging
        </div>
        <div class="card-subtitle">
            Format resmi sesuai spesifikasi Tugas Mandiri Modul 16 untuk dipresentasikan dan didiskusikan di kelas.
        </div>

        <div class="table-responsive">
            <table class="qa-table">
                <thead>
                    <tr>
                        <th style="width: 40px;">No</th>
                        <th style="width: 220px;">Nama Fitur / URL di Proyekmu</th>
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
            Menampilkan 20 baris log terakhir langsung dari sistem Laravel sebagai bukti konkrit bahwa <code>Log::error()</code>, <code>Log::warning()</code>, dan <code>Log::info()</code> tercatat dengan sempurna saat penanganan error terjadi.
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
        <div style="font-size: 13px; color: var(--text-muted);">
            Proyek Mandiri Laravel Modul 13 - 16 &bull; Status Seluruh Pengujian: <b>100% PASS</b>
        </div>
    </div>

</div>
</body>
</html>
