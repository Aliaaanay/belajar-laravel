# Proyek Aplikasi Web E-Commerce Terpadu: ecommerce-git-una
**Mata Kuliah:** Pemrograman Web Lanjut  
**Dosen Pengampu:** Septa, S.Kom., M.Kom.  
**Universitas Pamulang — Fakultas Ilmu Komputer**

---

## Identitas Pengembang
- **Nama Lengkap:** Sabrina Luna Apsari Faizah
- **NIM:** 231011401822
- **Kelas / Program Studi:** 07TPLP017 / Teknik Informatika
- **Username GitHub:** [Aliaaanay](https://github.com/Aliaaanay)
- **Nama Repositori:** `belajar-laravel`
- **Basis Data MySQL:** `belajar_laravel` (phpMyAdmin Laragon)

---

## Deskripsi Proyek
Proyek aplikasi web ini dibangun menggunakan framework **Laravel** modern yang tersinkronisasi penuh dengan database **MySQL (phpMyAdmin) di Laragon**, serta dikelola menggunakan **Version Control System (Git & GitHub)** sesuai standar industri perangkat lunak.

Aplikasi ini mencakup modul terpadu:
1. **Arsitektur MVC (Model-View-Controller):** Pengelolaan data dinamis katalog produk dan pesanan transaksi.
2. **Autentikasi & Multi-Role Authorization:** Pembatasan akses pengguna berdasarkan hak wewenang.
3. **RESTful API & Web Client:** Integrasi data JSON dengan frontend responsif.
4. **Quality Assurance & Error Handling:** Penanganan eksepsi `try-catch`, pencegahan `DivisionByZeroError`, dan audit log di `storage/logs/laravel.log`.
5. **Sistem Pelaporan (Reporting):** Ekspor laporan resmi ke format PDF (`barryvdh/laravel-dompdf`) dan Excel CSV UTF-8 BOM (`\xEF\xBB\xBF`).
6. **Version Control & Kolaborasi (Git):** Alur kerja *branching* (`fitur-kontak`, `fitur-readme-dokumentasi`), *staging*, *commit history*, *merging* ke cabang utama `main`, dan publikasi remote ke GitHub.

---

## Panduan Instalasi & Menjalankan di Lokal (Laragon + phpMyAdmin)

### 1. Menyiapkan Database di phpMyAdmin
1. Buka Laragon, klik tombol **Start All** (pastikan Apache dan MySQL dalam kondisi *Running*).
2. Buka browser dan akses phpMyAdmin di `http://localhost/phpmyadmin`.
3. Buat database baru bernama: `ecommerce_git_18` (atau `belajar_laravel`).

### 2. Konfigurasi Lingkungan (`.env`)
Pastikan konfigurasi koneksi database di file `.env` sudah sesuai:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=belajar_laravel
DB_USERNAME=root
DB_PASSWORD=aliaunaa112005
```

### 3. Eksekusi Migrasi & Seeder Database
Jalankan perintah berikut di terminal proyek:
```bash
php artisan migrate:fresh --seed
```
*Perintah ini akan membuat tabel `products`, `orders`, `users`, `mahasiswas`, `bukus` serta mengisi data transaksi awal secara otomatis.*

### 4. Menjalankan Server Lokal
```bash
php artisan serve
```
Akses portal web melalui browser di: [http://127.0.0.1:8000](http://127.0.0.1:8000).

### 5. Menjalankan Pengujian Otomatis (*Automated Testing*)
```bash
php artisan test
```
Seluruh 38 pengujian fitur akan berstatus **100% PASS (Hijau Sempurna)**.

---

## Daftar Rute Web Utama

| Modul Pertemuan | URL / Rute | Keterangan |
| :--- | :--- | :--- |
| **Beranda** | `/` | Portal Utama Navigasi Seluruh Modul (13 s.d. 18) |
| **Pertemuan 13** | `/mahasiswa`, `/matakuliah`, `/laboratorium` | Arsitektur MVC & Koleksi Data |
| **Pertemuan 14** | `/login`, `/register`, `/panel-admin`, `/krs-mahasiswa` | Multi-Role Auth (Admin vs Mahasiswa) |
| **Pertemuan 15** | `/client-mahasiswa`, `/api/mahasiswa`, `/api/buku` | RESTful API & Web Consumer |
| **Pertemuan 16** | `/qa-testing`, `/ecommerce/qa-dashboard` | QA Dashboard & Interactive Test Runner |
| **Pertemuan 17** | `/laporan`, `/laporan/pdf`, `/ecommerce/laporan` | Laporan Keuangan & Penjualan (PDF & Excel) |
| **Pertemuan 18** | `/kontak`, `/profil`, `/tentang` | Hasil Branching & Git Version Control |
