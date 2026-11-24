# Lembar Kerja Mahasiswa (LKM) — Pengelolaan Proyek dengan Git
**Mata Kuliah:** Pemrograman Web Lanjut  
**Dosen Pengampu:** Septa, S.Kom., M.Kom.  
**Pertemuan:** 18 (Penggunaan Version Control, Git Command, dan Kolaborasi Proyek Web)

---

### A. Identitas Mahasiswa & Repositori

| Komponen | Isian Mahasiswa |
| :--- | :--- |
| **Nama Lengkap** | **Sabrina Luna Apsari Faizah** |
| **NIM** | **231011401822** |
| **Kelas / Program Studi** | **07TPLP017 / Teknik Informatika** |
| **Fakultas / Universitas** | **Fakultas Ilmu Komputer, Universitas Pamulang** |
| **Nama Proyek Web Laravel Mandiri** | **ecommerce-git-una** (Aplikasi E-Commerce Terpadu MySQL) |
| **Nama Database MySQL (phpMyAdmin)** | `ecommerce_git_18` |
| **URL Repositori GitHub** | `https://github.com/Aliaaanay/ecommerce-git-una.git` |
| **Verifikasi .gitignore (.env & vendor aman?)** | `[X] Ya, sudah diabaikan dengan aman` |

---

### B. Tabel Pencatatan Aktivitas Git Command & Riwayat Commit Proyek

| No | Tahap / Aktivitas Pengelolaan | Perintah Git yang Dijalankan | Branch & Hash Commit | Status / Hasil Output |
|:--:| :--- | :--- | :--- | :--- |
| **1** | Konfigurasi Identitas & Inisialisasi | `git config --global user.name "Aliaaanay"`<br>`git config --global user.email "apsarifaizah@gmail.com"`<br>`git init`<br>`git branch -M main` | `main` | **Berhasil:** Identitas global tersimpan, inisialisasi repositori Git lokal berhasil, folder `.git/` terbentuk, dan branch default diatur ke `main`. |
| **2** | Commit Awal Proyek Mandiri | `git add .`<br>`git commit -m "Inisialisasi proyek ecommerce-git-una berbasis Laravel"` | `main / 893b473` | **Berhasil:** Seluruh berkas inti proyek Laravel terekam ke repositori lokal tanpa mengikutsertakan folder `vendor/` dan berkas kredensial `.env`. |
| **3** | Pembuatan & Commit Branch Fitur 1 | `git checkout -b fitur-kontak`<br>`git commit -am "Menyempurnakan modul halaman kontak kampus dengan jam layanan"` | `fitur-kontak / 6d3836a` | **Berhasil:** Modul halaman kontak kampus (`resources/views/kontak.blade.php`) berhasil diisolasi dan di-commit pada cabang `fitur-kontak`. |
| **4** | Pembuatan & Commit Branch Fitur 2 | `git checkout -b fitur-readme-dokumentasi`<br>`git commit -am "Menyusun dokumentasi lengkap README.md seluruh modul"` | `fitur-readme-dokumentasi / e2622d8` | **Berhasil:** Berkas dokumentasi README komprehensif berhasil ditambahkan pada branch dokumentasi. |
| **5** | Penggabungan ke Branch Utama | `git checkout main`<br>`git merge fitur-kontak`<br>`git merge fitur-readme-dokumentasi` | `main / da4c542` | **Fast-forward (Berhasil):** Seluruh perubahan dari cabang fitur digabungkan kembali ke cabang `main` secara mulus tanpa konflik. |
| **6** | Sinkronisasi ke GitHub (Push) | `git remote add origin https://github.com/Aliaaanay/ecommerce-git-una.git`<br>`git push -u origin main` | `origin/main` | **Tampil di GitHub: Ya.** Seluruh kode sumber, riwayat commit, dan README tampil rapi dan terverifikasi di GitHub. |

---

### C. Catatan Kendala / Analisis Refleksi Mahasiswa

1. **Analisis Kebocoran File `.env` & Keamanan Repository:**  
   File `.env` berisi informasi kredensial yang sangat sensitif (seperti `APP_KEY`, username dan password basis data MySQL `root:aliaunaa112005`). Keberadaan baris `.env` dan `/vendor` di dalam file `.gitignore` sejak inisialisasi awal sangat krusial untuk mencegah kebocoran informasi keamanan sistem ke repositori publik serta menjaga ukuran push repositori tetap ringan (bebas dari ratusan MB library vendor).

2. **Manfaat Nyata Strategi *Branching* & *Merging*:**  
   Penerapan cabang fitur terpisah (`fitur-kontak` dan `fitur-readme-dokumentasi`) memungkinkan pengembang melakukan eksperimen kode tanpa mengganggu kestabilan kode produksi pada cabang utama (`main`). Setelah fitur selesai diuji dan dipastikan bebas kesalahan, penggabungan dapat dilakukan secara aman menggunakan `git merge`. Jika terjadi konflik baris kode (*merge conflict*), Git akan menandai blok yang bentrok sehingga developer dapat memilih kode yang valid secara teratur sebelum melakukan *commit* penyelesaian.

3. **Verifikasi Riwayat Log (`git log --oneline --graph --decorate`):**
   ```text
   * da4c542 (HEAD -> main, origin/main) Menambahkan modul halaman profil mahasiswa
   * 3c74e99 Menambahkan route halaman tentang kampus
   * 4c4c167 Melengkapi Lembar Kerja Mahasiswa (LKM) Pengelolaan Git Pertemuan 18
   * e2622d8 Menyusun dokumentasi lengkap README.md seluruh modul 13 s.d. 18
   * 6d3836a Menyempurnakan modul halaman kontak kampus dengan jam layanan (Praktik 18)
   * 893b473 Inisialisasi proyek ecommerce-git-una berbasis Laravel
   ```
