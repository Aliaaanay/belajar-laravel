# Lembar Kerja Mahasiswa (LKM) — Pengelolaan Proyek dengan Git
**Mata Kuliah:** Pemrograman Web Lanjut  
**Dosen Pengampu:** Septa, S.Kom., M.Kom.  
**Pertemuan:** 18 (Penggunaan Version Control, Git Command, dan Kolaborasi Proyek Web)

---

### A. Identitas Mahasiswa & Repositori
| Komponen | Isian Mahasiswa |
| :--- | :--- |
| **Nama Lengkap / NIM** | Sabrina Luna / 2410114001 |
| **Kelas / Program Studi** | 04TPLP001 / Teknik Informatika |
| **Nama Proyek Web Laravel Mandiri** | Portal Akademik, Sistem Laporan & E-Commerce Terpadu (`belajar-laravel`) |
| **URL Repositori GitHub** | `https://github.com/sabrinaluna/belajar-laravel.git` |
| **Verifikasi .gitignore (.env & vendor aman?)** | `[X] Ya, sudah diabaikan dengan aman` |

---

### B. Tabel Pencatatan Aktivitas Git Command & Riwayat Commit Proyek

| No | Tahap / Aktivitas Pengelolaan | Perintah Git yang Dijalankan | Branch & Hash Commit | Status / Hasil Output |
|:--:| :--- | :--- | :--- | :--- |
| 1 | Konfigurasi Identitas & Inisialisasi | `git config user.name "Sabrina Luna"`<br>`git config user.email "sabrinaluna@kampus.ac.id"`<br>`git init`<br>`git branch -M main` | `main` | **Berhasil:** Inisialisasi repositori Git lokal berhasil, folder `.git/` terbentuk dan branch default diatur ke `main`. |
| 2 | Commit Awal Proyek Mandiri | `git add .`<br>`git commit -m "Inisialisasi repositori proyek belajar-laravel (Modul 13 s.d. 16)"` | `main / d48427e` | **Berhasil:** 119 berkas proyek Laravel berhasil direkam ke repositori lokal tanpa mengikutsertakan `.env` dan `vendor/`. |
| 3 | Pembuatan & Commit Branch Fitur 1 | `git checkout -b fitur-kontak`<br>`git commit -am "Menyempurnakan modul halaman kontak kampus dengan jam layanan (Praktik 18)"` | `fitur-kontak / 331dcf3` | **Berhasil:** Fitur halaman kontak kampus berhasil diisolasi pada cabang `fitur-kontak` dan dicatat dengan commit tersendiri. |
| 4 | Pembuatan & Commit Branch Fitur 2 | `git checkout -b fitur-readme-dokumentasi`<br>`git commit -am "Menyusun dokumentasi lengkap README.md seluruh modul 13 s.d. 18"` | `fitur-readme-dokumentasi / c9dcf43` | **Berhasil:** Dokumentasi komprehensif README berhasil ditambahkan pada branch dokumentasi. |
| 5 | Penggabungan ke Branch Utama | `git checkout main`<br>`git merge fitur-kontak`<br>`git merge fitur-readme-dokumentasi` | `main / c9dcf43` | **Fast-forward (Berhasil):** Seluruh perubahan dari kedua cabang fitur berhasil digabungkan ke cabang `main` tanpa konflik. |
| 6 | Sinkronisasi ke GitHub (Push) | `git remote add origin https://github.com/sabrinaluna/belajar-laravel.git`<br>`git push -u origin main` | `origin/main` | **Tampil di GitHub: Ya.** Seluruh struktur proyek, commit history, dan README tampil rapi di repositori GitHub. |

---

### C. Catatan Kendala / Analisis Refleksi Mahasiswa

1. **Analisis Kebocoran File `.env` & Keamanan:**  
   File `.env` berisi informasi kredensial yang sangat sensitif (seperti `APP_KEY`, username dan password basis data MySQL `root:aliaunaa112005`). Keberadaan baris `.env` dan `/vendor` di dalam file `.gitignore` sejak inisialisasi awal sangat krusial untuk mencegah kebocoran informasi keamanan sistem ke repositori publik serta menjaga ukuran repositori tetap ringan dan bersih.

2. **Manfaat Nyata Strategi *Branching* & *Merging*:**  
   Penerapan cabang fitur terpisah (`fitur-kontak` dan `fitur-readme-dokumentasi`) memungkinkan pengembang melakukan eksperimen kode tanpa mengganggu kestabilan kode produksi pada cabang utama (`main`). Setelah fitur selesai diuji dan dipastikan bebas kesalahan, penggabungan dapat dilakukan secara aman menggunakan `git merge`.

3. **Verifikasi Riwayat Log (`git log --oneline --graph --decorate`):**
   ```text
   * a5f1b2c (HEAD -> main) Melengkapi Lembar Kerja Mahasiswa (LKM) Pengelolaan Git Pertemuan 18
   * c9dcf43 (fitur-readme-dokumentasi) Menyusun dokumentasi lengkap README.md seluruh modul 13 s.d. 18
   * 331dcf3 (fitur-kontak) Menyempurnakan modul halaman kontak kampus dengan jam layanan (Praktik 18)
   * d48427e Inisialisasi repositori proyek belajar-laravel (Modul 13 s.d. 16)
   ```
