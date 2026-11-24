# Proyek Web Laravel Terpadu: Modul 13 s.d. 18

Aplikasi web Laravel modern, lengkap, dan siap produksi yang dibangun untuk memenuhi seluruh tugas dan latihan mata kuliah **Pemrograman Web Lanjut** (Pertemuan 13 sampai 18), tersinkronisasi penuh dengan basis data **MySQL (phpMyAdmin) di Laragon**.

---

## Identitas Pengembang
- **Nama Mahasiswa:** Sabrina Luna
- **Program Studi:** Teknik Informatika
- **Mata Kuliah:** Pemrograman Web Lanjut
- **Dosen Pengampu:** Septa, S.Kom., M.Kom.
- **Repository:** `belajar-laravel`

---

## Daftar Fitur Berdasarkan Pertemuan Modul

### 1. Pertemuan 13: Arsitektur Model-View-Controller (MVC)
- **Model Koleksi & Eloquent:** Model `Mahasiswa.php`, `MataKuliah.php`, dan `Laboratorium.php`.
- **Controller:** Pengaturan alur data di `MahasiswaController`, `MataKuliahController`, `LaboratoriumController`.
- **View Blade:** Penggunaan `@foreach`, `@if` predikat kelulusan (Cumlaude / Sangat Memuaskan), dan kartu inventaris.
- **Rute:**
  - `/mahasiswa` & `/mahasiswa/{nim}`
  - `/matakuliah` & `/matakuliah/{kode}`
  - `/laboratorium`, `/laboratorium/detail/{kode}`, `/laboratorium/status/{status}`

### 2. Pertemuan 14: Autentikasi dan Otorisasi Multi-Role
- **Multi-Role Middleware:** Middleware `CekRole.php` terdaftar sebagai alias `'role'`.
- **Portal Akademik:** Role `admin` (akses `/panel-admin`) dan `mahasiswa` (akses `/krs-mahasiswa`).
- **E-Perpustakaan:** Role `pustakawan` (akses `/perpus/kelola-buku`) dan `anggota` (akses `/perpus/pinjam-buku`).
- **Rute:**
  - `/login`, `/register`, `/dashboard`, `/logout`, `/panel-admin`, `/krs-mahasiswa`
  - `/perpus/login`, `/perpus/register`, `/perpus/dashboard`, `/perpus/kelola-buku`, `/perpus/pinjam-buku`

### 3. Pertemuan 15: RESTful API & Web Client Consumer
- **API Mahasiswa & Buku:** Endpoint JSON standar dengan format `{ status, data, message }` dan validasi HTTP 422.
- **Web Client UI:** Integrasi AJAX / Fetch API langsung dari browser dengan render tabel dinamis.
- **Rute:**
  - Web Client: `/client-mahasiswa` & `/perpus/katalog-api`
  - RESTful API: `/api/mahasiswa` (GET, POST) & `/api/buku` (GET, POST, GET {id})

### 4. Pertemuan 16: Quality Assurance, Error Handling, Debugging & Testing
- **Try-Catch & Exception Handling:** Penanganan pembagian dengan nol (*DivisionByZeroError*), validasi stok habis, pembelian negatif.
- **Jejak Audit Log:** Rekam jejak `Log::info()`, `Log::warning()`, dan `Log::error()` di `storage/logs/laravel.log`.
- **Halaman Error Kustom:** `resources/views/errors/404.blade.php` dan `403.blade.php`.
- **QA Dashboard Interaktif:** Route `/qa-testing` dan `/qa-dashboard` lengkap dengan *Interactive Test Runner* dan *Live Log Viewer*.
- **Automated Testing:** 38 skenario uji lulus 100% PASS (`php artisan test`).

### 5. Pertemuan 17: Sistem Pelaporan (Reporting), Export PDF & Excel
- **Export PDF Resmi:** Menggunakan library `barryvdh/laravel-dompdf` lengkap dengan Kop Surat resmi instansi, nomor dokumen, tanggal cetak, tabel rekapitulasi, dan kolom tanda tangan pengesahan.
- **Export Excel / CSV Native:** Menggunakan `response()->streamDownload()` dengan penanda UTF-8 BOM (`\xEF\xBB\xBF`) dan delimiter titik-koma (`;`) untuk kompatibilitas penuh Microsoft Excel.
- **Print-Friendly:** Aturan CSS `@media print` untuk menyembunyikan tombol aksi dan menu saat cetak browser.
- **Rute:**
  - Latihan 17: `/laporan`, `/laporan/pdf`, `/laporan/excel`
  - Tugas Mandiri 17: `/ecommerce/laporan`, `/ecommerce/laporan/pdf`, `/ecommerce/laporan/excel`

### 6. Pertemuan 18: Version Control System (Git) & Kolaborasi
- **Struktur Repositori:** Inisialisasi Git (`git init`), pengaturan `.gitignore` mengamankan `.env` dan `/vendor`.
- **Branching & Merging:** Penerapan cabang fitur `fitur-kontak` dan `fitur-readme-dokumentasi` yang digabungkan kembali ke `main`.
- **Halaman Kontak:** Rute `/kontak` hasil isolasi cabang fitur.

---

## Panduan Menjalankan Proyek di Lokal

1. **Jalankan Laragon:**
   Pastikan web server **Apache** dan **MySQL** dalam status running.

2. **Konfigurasi Database (.env):**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=belajar_laravel
   DB_USERNAME=root
   DB_PASSWORD=aliaunaa112005
   ```

3. **Migrasi & Seeding Data:**
   ```bash
   php artisan migrate:fresh --seed
   ```

4. **Jalankan Aplikasi:**
   ```bash
   php artisan serve
   ```
   Buka portal utama di browser: [http://127.0.0.1:8000](http://127.0.0.1:8000).

5. **Jalankan Pengujian Otomatis:**
   ```bash
   php artisan test
   ```
   Seluruh 38 pengujian fitur akan berstatus **PASS (Hijau)**.
