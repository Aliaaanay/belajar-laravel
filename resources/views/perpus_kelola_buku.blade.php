<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Koleksi Buku - E-Perpustakaan</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f0f4f8; padding: 40px 20px; color: #1e293b; }
        .card { max-width: 650px; margin: auto; background: white; padding: 35px; border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,0.08); border-top: 5px solid #7c3aed; }
        h2 { margin-top: 0; color: #6d28d9; }
        .badge { background: #7c3aed; color: white; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: 700; }
        .box { background: #f5f3ff; border: 1px solid #ddd6fe; border-radius: 8px; padding: 18px; margin: 20px 0; line-height: 1.6; }
        .btn { display: inline-block; padding: 10px 18px; background: #7c3aed; color: white; text-decoration: none; border-radius: 6px; font-weight: 600; margin-right: 10px; font-size: 14px; }
        .btn-outline { background: #e2e8f0; color: #334155; }
    </style>
</head>
<body>
<div class="card">
    <h2>Panel Kelola Koleksi Buku <span class="badge">Role: Pustakawan</span></h2>
    <p>Halo, <b>{{ Auth::user()->name }}</b>! Anda memiliki akses penuh sebagai pustakawan untuk mengelola master buku, kategori, dan stok fisik perpustakaan.</p>

    <div class="box">
        <strong>Status Akses: DISETUJUI (200 OK)</strong><br>
        Middleware <code>role:pustakawan</code> telah memvalidasi kredensial Anda dan mengizinkan Anda masuk ke panel administrasi buku ini.
    </div>

    <div style="margin-top: 25px;">
        <a href="{{ url('/perpus/katalog-api') }}" class="btn">Buka API Katalog Buku</a>
        <a href="{{ url('/perpus/dashboard') }}" class="btn btn-outline">&laquo; Kembali ke Dashboard</a>
    </div>
</div>
</body>
</html>
