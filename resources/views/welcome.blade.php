<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portal Tugas & Latihan Pemrograman Web - Pertemuan 13 s.d 16</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', system-ui, -apple-system, sans-serif; background-color: #f1f5f9; color: #1e293b; padding: 40px 20px; line-height: 1.5; }
        .wrapper { max-width: 1100px; margin: 0 auto; }
        .hero { background: linear-gradient(135deg, #1e3a8a 0%, #0284c7 100%); color: white; padding: 35px; border-radius: 16px; margin-bottom: 30px; box-shadow: 0 10px 25px rgba(2,132,199,0.25); text-align: center; }
        .hero h1 { font-size: 28px; margin-bottom: 10px; font-weight: 800; }
        .hero p { font-size: 15px; opacity: 0.92; max-width: 750px; margin: auto; }
        .db-status { display: inline-flex; align-items: center; gap: 8px; margin-top: 15px; background: rgba(255,255,255,0.18); padding: 6px 16px; border-radius: 9999px; font-size: 13px; font-weight: 600; }
        .db-dot { width: 10px; height: 10px; border-radius: 5px; background: #22c55e; box-shadow: 0 0 8px #22c55e; }
        
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(500px, 1fr)); gap: 24px; }
        .card { background: white; border-radius: 14px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; display: flex; flex-direction: column; justify-content: space-between; }
        .card-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; padding-bottom: 12px; border-bottom: 2px solid #f1f5f9; }
        .badge-modul { background: #e0f2fe; color: #0369a1; font-weight: 800; font-size: 12px; padding: 4px 10px; border-radius: 6px; text-transform: uppercase; }
        .card-title { font-size: 18px; font-weight: 700; color: #0f172a; }
        
        .section-box { background: #f8fafc; border-radius: 8px; padding: 14px; margin-bottom: 12px; border: 1px solid #e2e8f0; }
        .section-tag { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block; margin-bottom: 4px; padding: 2px 6px; border-radius: 4px; }
        .tag-latihan { background: #dcfce7; color: #15803d; }
        .tag-tugas { background: #fef3c7; color: #b45309; }
        .section-desc { font-size: 13px; color: #475569; margin-bottom: 10px; }
        
        .btn-group { display: flex; gap: 8px; flex-wrap: wrap; }
        .btn { display: inline-flex; align-items: center; gap: 6px; padding: 7px 14px; border-radius: 6px; font-size: 13px; font-weight: 600; text-decoration: none; transition: all 0.2s; }
        .btn-primary { background: #0284c7; color: white; }
        .btn-primary:hover { background: #0369a1; }
        .btn-secondary { background: #e2e8f0; color: #334155; }
        .btn-secondary:hover { background: #cbd5e1; }
        
        .footer { text-align: center; margin-top: 40px; font-size: 13px; color: #64748b; }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="hero">
        <h1>PORTAL PRAKTIKUM & TUGAS LARAVEL</h1>
        <p>Implementasi Komprehensif Arsitektur MVC, Autentikasi & Otorisasi Multi-Role, RESTful API JSON, serta Error Handling, Debugging, & Automated Testing (Pertemuan 13 s.d 16).</p>
        <div class="db-status">
            <span class="db-dot"></span>
            Sinkronisasi Database: MySQL Laragon (belajar_laravel) Active & Connected
        </div>
    </div>

    <div class="grid">
        <!-- PERTEMUAN 13 -->
        <div class="card">
            <div>
                <div class="card-header">
                    <span class="badge-modul">Pertemuan 13</span>
                    <span style="font-size: 13px; color: #64748b;">Konsep Arsitektur MVC</span>
                </div>
                <div class="card-title" style="margin-bottom: 15px;">Model, View, dan Controller di Laravel</div>
                
                <div class="section-box">
                    <span class="section-tag tag-latihan">Praktik MVC Dasar</span>
                    <div style="font-weight: 600; font-size: 14px; margin-bottom: 4px;">Daftar Mahasiswa (Model, View, Controller)</div>
                    <div class="section-desc">Penerapan Model Mahasiswa (ambilSemua, cariBerdasarkanNim), MahasiswaController, dan Blade View dengan logika percabangan @@if predikat kelulusan (Cumlaude / Sangat Memuaskan).</div>
                    <div class="btn-group">
                        <a href="{{ url('/mahasiswa') }}" class="btn btn-primary">Buka MVC Mahasiswa &rarr;</a>
                        <a href="{{ url('/mahasiswa/2410114001') }}" class="btn btn-secondary">Detail 2410114001</a>
                    </div>
                </div>

                <div class="section-box">
                    <span class="section-tag tag-latihan">Latihan Modul 13</span>
                    <div style="font-weight: 600; font-size: 14px; margin-bottom: 4px;">Katalog Mata Kuliah Teknik Informatika</div>
                    <div class="section-desc">Pemisahan data statis Model (MataKuliah.php), pemrosesan SKS di Controller, dan penyajian Blade View dengan filter silabus.</div>
                    <div class="btn-group">
                        <a href="{{ url('/matakuliah') }}" class="btn btn-primary">Buka Katalog Matkul &rarr;</a>
                        <a href="{{ url('/matakuliah/IF201') }}" class="btn btn-secondary">Detail IF201</a>
                    </div>
                </div>

                <div class="section-box">
                    <span class="section-tag tag-tugas">Tugas Mandiri 13</span>
                    <div style="font-weight: 600; font-size: 14px; margin-bottom: 4px;">Direktori & Inventaris Laboratorium Komputer</div>
                    <div class="section-desc">Model statis Laboratorium.php (5 ruang lab), Controller dengan filter status ('Tersedia' / 'Maintenance'), perhitungan total PC, dan tampilan detail.</div>
                    <div class="btn-group">
                        <a href="{{ url('/laboratorium') }}" class="btn btn-primary">Buka Direktori Lab &rarr;</a>
                        <a href="{{ url('/laboratorium/status/Tersedia') }}" class="btn btn-secondary">Filter Tersedia</a>
                        <a href="{{ url('/laboratorium/status/Maintenance') }}" class="btn btn-secondary">Filter Maintenance</a>
                        <a href="{{ url('/laboratorium/detail/LAB-01') }}" class="btn btn-secondary">Detail LAB-01</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- PERTEMUAN 14 -->
        <div class="card">
            <div>
                <div class="card-header">
                    <span class="badge-modul">Pertemuan 14</span>
                    <span style="font-size: 13px; color: #64748b;">Autentikasi & Otorisasi</span>
                </div>
                <div class="card-title" style="margin-bottom: 15px;">Login, Registrasi, dan Pembatasan Role</div>

                <div class="section-box">
                    <span class="section-tag tag-latihan">Latihan Modul 14</span>
                    <div style="font-weight: 600; font-size: 14px; margin-bottom: 4px;">Sistem Portal Akademik (Admin & Mahasiswa)</div>
                    <div class="section-desc">Bcrypt password hashing, Session authentication, Middleware CekRole ('role:admin', 'role:mahasiswa'), dan proteksi URL.</div>
                    <div class="btn-group">
                        <a href="{{ url('/login') }}" class="btn btn-primary">Halaman Login &rarr;</a>
                        <a href="{{ url('/register') }}" class="btn btn-secondary">Daftar Akun Baru</a>
                        <a href="{{ url('/dashboard') }}" class="btn btn-secondary">Dashboard Akademik</a>
                    </div>
                </div>

                <div class="section-box">
                    <span class="section-tag tag-tugas">Tugas Mandiri 14</span>
                    <div style="font-weight: 600; font-size: 14px; margin-bottom: 4px;">Sistem E-Perpustakaan (Pustakawan & Anggota)</div>
                    <div class="section-desc">PerpusAuthController, pemisahan otorisasi panel kelola buku (pustakawan) vs peminjaman buku (anggota), proteksi 403 Forbidden.</div>
                    <div class="btn-group">
                        <a href="{{ url('/perpus/login') }}" class="btn btn-primary">Login Perpustakaan &rarr;</a>
                        <a href="{{ url('/perpus/register') }}" class="btn btn-secondary">Register Anggota</a>
                        <a href="{{ url('/perpus/dashboard') }}" class="btn btn-secondary">Dashboard Perpus</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- PERTEMUAN 15 -->
        <div class="card">
            <div>
                <div class="card-header">
                    <span class="badge-modul">Pertemuan 15</span>
                    <span style="font-size: 13px; color: #64748b;">RESTful API & Client</span>
                </div>
                <div class="card-title" style="margin-bottom: 15px;">Layanan API JSON dan Konsumen Web Asinkron</div>

                <div class="section-box">
                    <span class="section-tag tag-latihan">Latihan Modul 15</span>
                    <div style="font-weight: 600; font-size: 14px; margin-bottom: 4px;">RESTful API Mahasiswa (CRUD JSON)</div>
                    <div class="section-desc">Endpoint <code>/api/mahasiswa</code> (GET, POST, PUT, DELETE), response JSON standar, dan antarmuka client Fetch API tanpa reload.</div>
                    <div class="btn-group">
                        <a href="{{ url('/client-mahasiswa') }}" class="btn btn-primary">Portal Web Client &rarr;</a>
                        <a href="{{ url('/api/mahasiswa') }}" target="_blank" class="btn btn-secondary">JSON Endpoint</a>
                    </div>
                </div>

                <div class="section-box">
                    <span class="section-tag tag-tugas">Tugas Mandiri 15</span>
                    <div style="font-weight: 600; font-size: 14px; margin-bottom: 4px;">Katalog Buku E-Perpustakaan (REST API & Client)</div>
                    <div class="section-desc">Model Buku, API Resource <code>/api/buku</code>, validasi 422 JSON, dan Web Client katalog interaktif dengan kalkulasi stok fisik.</div>
                    <div class="btn-group">
                        <a href="{{ url('/perpus/katalog-api') }}" class="btn btn-primary">Katalog Web Client &rarr;</a>
                        <a href="{{ url('/api/buku') }}" target="_blank" class="btn btn-secondary">JSON /api/buku</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- PERTEMUAN 16 -->
        <div class="card">
            <div>
                <div class="card-header">
                    <span class="badge-modul">Pertemuan 16</span>
                    <span style="font-size: 13px; color: #64748b;">Testing & Debugging</span>
                </div>
                <div class="card-title" style="margin-bottom: 15px;">Penanganan Error, Log, & Automated Test</div>

                <div class="section-box">
                    <span class="section-tag tag-latihan">Latihan Modul 16</span>
                    <div style="font-weight: 600; font-size: 14px; margin-bottom: 4px;">Kalkulator IP Mahasiswa & Custom 404</div>
                    <div class="section-desc">Try-catch exception (pembagian nol SKS), Log::error, fitur debugging dd(), custom error page 404/403, dan Feature Test NilaiAkademikTest.</div>
                    <div class="btn-group">
                        <a href="{{ url('/uji-nilai') }}" class="btn btn-primary">Simulasi Uji Nilai &rarr;</a>
                        <a href="{{ url('/uji-nilai/hitung/2410114001') }}" class="btn btn-secondary">Hitung Normal</a>
                        <a href="{{ url('/uji-nilai/hitung/2410114003') }}" class="btn btn-secondary">Uji Try-Catch (SKS 0)</a>
                        <a href="{{ url('/uji-nilai/hitung/99999999') }}" class="btn btn-secondary">Uji 404 Kustom</a>
                    </div>
                </div>

                <div class="section-box">
                    <span class="section-tag tag-tugas">Tugas Mandiri 16</span>
                    <div style="font-weight: 600; font-size: 14px; margin-bottom: 4px;">Quality Assurance, Debugging &amp; QA Testing Dashboard</div>
                    <div class="section-desc">Dashboard interaktif untuk menguji skenario Positif, Exception (Try-Catch), Negatif (404), serta tabel laporan temuan bug dan audit rekam jejak <code>storage/logs/laravel.log</code>.</div>
                    <div class="btn-group">
                        <a href="{{ url('/qa-testing') }}" class="btn btn-primary">Buka Dashboard QA &amp; Testing &rarr;</a>
                        <a href="{{ url('/laboratorium') }}" class="btn btn-secondary">Proyek Lab (MVC)</a>
                        <span class="btn" style="background: #22c55e; color: white; cursor: default;">✓ Automated Test: PASS</span>
                    </div>
                </div>

                <div class="section-box" style="border-left: 4px solid #2563eb; background: #f0f7ff;">
                    <span class="section-tag" style="background: #2563eb; color: white;">Cadangan Tugas Mandiri 16: E-Commerce</span>
                    <div style="font-weight: 600; font-size: 14px; margin-bottom: 4px;">E-Commerce QA, Error Handling &amp; Debugging System</div>
                    <div class="section-desc">Aplikasi E-Commerce lengkap tersinkronisasi database MySQL (Product &amp; Order). Dilengkapi kalkulator cicilan (uji DivisionByZero), validasi stok ekstrem, 404 kustom, dan Interactive QA Dashboard.</div>
                    <div class="btn-group">
                        <a href="{{ url('/qa-dashboard') }}" class="btn btn-primary" style="background: #2563eb;">Dashboard QA E-Commerce &rarr;</a>
                        <a href="{{ url('/ecommerce') }}" class="btn btn-secondary">Katalog Toko</a>
                        <a href="{{ url('/ecommerce/cicilan/LAPTOP-PRO-15?tenor=0') }}" class="btn btn-secondary">Uji Tenor 0 (Error)</a>
                        <a href="{{ url('/ecommerce/produk/SKU-TIDAK-ADA-999') }}" class="btn btn-secondary">Uji 404 SKU</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- PERTEMUAN 17 -->
        <div class="card">
            <div>
                <div class="card-header">
                    <span class="badge-modul">Pertemuan 17</span>
                    <span style="font-size: 13px; color: #64748b;">Reporting &amp; Export Data</span>
                </div>
                <div class="card-title" style="margin-bottom: 15px;">Pelaporan Web, Export PDF &amp; Excel (CSV)</div>

                <div class="section-box">
                    <span class="section-tag tag-latihan">Latihan Modul 17</span>
                    <div style="font-weight: 600; font-size: 14px; margin-bottom: 4px;">Laporan Kas &amp; Transaksi Himpunan Mahasiswa</div>
                    <div class="section-desc">Penyajian laporan keuangan dengan filter dinamis, cetak langsung (<code>window.print()</code> dengan <code>@media print</code>), pratinjau &amp; unduh PDF DomPDF, serta export CSV UTF-8 BOM.</div>
                    <div class="btn-group">
                        <a href="{{ url('/laporan') }}" class="btn btn-primary">Buka Laporan Kas &rarr;</a>
                        <a href="{{ url('/laporan/pdf?mode=stream') }}" target="_blank" class="btn btn-secondary">Preview PDF</a>
                        <a href="{{ url('/laporan/excel') }}" class="btn btn-secondary">Export Excel (CSV)</a>
                    </div>
                </div>

                <div class="section-box">
                    <span class="section-tag tag-tugas">Tugas Mandiri 17</span>
                    <div style="font-weight: 600; font-size: 14px; margin-bottom: 4px;">Laporan Rekapitulasi Penjualan E-Commerce</div>
                    <div class="section-desc">Laporan omset penjualan terintegrasi basis data MySQL. Dilengkapi kop surat resmi perusahaan, tanggal cetak, tabel transaksi, rekap total pendapatan, tanda tangan pengesahan, export PDF &amp; CSV.</div>
                    <div class="btn-group">
                        <a href="{{ url('/ecommerce/laporan') }}" class="btn btn-primary">Laporan Penjualan Web &rarr;</a>
                        <a href="{{ url('/ecommerce/laporan/pdf?mode=stream') }}" target="_blank" class="btn btn-secondary">Preview PDF Resmi</a>
                        <a href="{{ url('/ecommerce/laporan/excel') }}" class="btn btn-secondary">Export Excel Omset</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- PERTEMUAN 18 -->
        <div class="card">
            <div>
                <div class="card-header">
                    <span class="badge-modul">Pertemuan 18</span>
                    <span style="font-size: 13px; color: #64748b;">Version Control &amp; Git</span>
                </div>
                <div class="card-title" style="margin-bottom: 15px;">Version Control System, Git &amp; Kolaborasi Web</div>

                <div class="section-box">
                    <span class="section-tag tag-latihan">Praktik Modul 18</span>
                    <div style="font-weight: 600; font-size: 14px; margin-bottom: 4px;">Alur Kerja Git Branching &amp; Modul Kontak</div>
                    <div class="section-desc">Implementasi <code>git init</code>, konfigurasi <code>.gitignore</code> (.env &amp; /vendor aman), branching (<code>fitur-kontak</code>), staging, commit, dan merging ke cabang utama <code>main</code>.</div>
                    <div class="btn-group">
                        <a href="{{ url('/kontak') }}" class="btn btn-primary">Buka Halaman Kontak &rarr;</a>
                    </div>
                </div>

                <div class="section-box">
                    <span class="section-tag tag-tugas">Tugas Mandiri 18</span>
                    <div style="font-weight: 600; font-size: 14px; margin-bottom: 4px;">Lembar Kerja Mahasiswa (LKM) &amp; README Dokumentasi</div>
                    <div class="section-desc">Pengelolaan repositori proyek mandiri: minimal 2 branch fitur, minimal 4 riwayat commit rapi, penggabungan (merge), file README.md, dan pengisian tabel LKM aktivitas Git.</div>
                    <div class="btn-group">
                        <span class="btn" style="background: #0f172a; color: white; cursor: default;">✓ Git Repository Active</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        Aplikasi Web Laravel &bull; Laragon MySQL Server: <b>belajar_laravel</b> &bull; Modul 13 s.d. 18 Lengkap
    </div>
</div>
</body>
</html>
