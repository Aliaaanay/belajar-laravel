<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Portal E-Perpustakaan</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f0f4f8; margin: 0; padding: 40px 20px; color: #1e293b; }
        .box { max-width: 700px; margin: auto; background: white; padding: 35px; border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,0.08); border-top: 5px solid #0284c7; }
        .header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #e2e8f0; padding-bottom: 15px; }
        h2 { margin: 0; color: #0369a1; font-size: 24px; }
        .profile-card { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 18px; margin: 20px 0; }
        .badge { display: inline-block; padding: 4px 12px; border-radius: 9999px; font-size: 12px; font-weight: 700; text-transform: uppercase; }
        .bg-pustakawan { background: #7c3aed; color: white; }
        .bg-anggota { background: #059669; color: white; }
        .menu-title { font-size: 15px; font-weight: 700; color: #334155; margin-bottom: 12px; }
        .nav-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 25px; }
        .nav-card { display: block; padding: 18px; background: #ffffff; border: 2px solid #e2e8f0; border-radius: 8px; text-decoration: none; color: #1e293b; transition: all 0.2s; }
        .nav-card:hover { border-color: #0284c7; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(2,132,199,0.1); }
        .nav-card h4 { margin: 0 0 6px 0; color: #0369a1; font-size: 16px; }
        .nav-card p { margin: 0; font-size: 12px; color: #64748b; }
        .role-notice { font-size: 12px; color: #e11d48; margin-top: 6px; font-weight: 600; }
        .api-card { grid-column: 1 / -1; background: #f0fdf4; border: 2px solid #bbf7d0; }
        .api-card h4 { color: #166534; }
        .btn-logout { background: #ef4444; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; font-weight: 700; font-size: 14px; transition: background 0.2s; }
        .btn-logout:hover { background: #dc2626; }
    </style>
</head>
<body>
<div class="box">
    <div class="header">
        <h2>Dashboard E-Perpustakaan</h2>
        <form method="POST" action="{{ url('/perpus/logout') }}">
            @csrf
            <button type="submit" class="btn-logout">Keluar (Logout)</button>
        </form>
    </div>

    <div class="profile-card">
        <div>Selamat Datang, <strong style="font-size: 18px; color: #0369a1;">{{ Auth::user()->name }}</strong></div>
        <div style="margin-top: 8px; font-size: 14px; color: #475569;">
            Email Terdaftar: <b>{{ Auth::user()->email }}</b>
        </div>
        <div style="margin-top: 8px; font-size: 14px;">
            Hak Akses Sistem:
            @if (Auth::user()->role === 'pustakawan')
                <span class="badge bg-pustakawan">Pustakawan (Administrator Koleksi)</span>
            @else
                <span class="badge bg-anggota">Anggota Perpustakaan</span>
            @endif
        </div>
    </div>

    <div class="menu-title">Menu Navigasi Otorisasi Berbasis Peran:</div>
    <div class="nav-grid">
        <a href="{{ url('/perpus/kelola-buku') }}" class="nav-card">
            <h4>📖 Kelola Koleksi Buku</h4>
            <p>Hanya dapat diakses oleh role <b>pustakawan</b>.</p>
            @if (Auth::user()->role !== 'pustakawan')
                <div class="role-notice">🔒 Memerlukan Role Pustakawan (Akses akan ditolak 403)</div>
            @endif
        </a>

        <a href="{{ url('/perpus/pinjam-buku') }}" class="nav-card">
            <h4>🔖 Pinjam & Sirkulasi Buku</h4>
            <p>Hanya dapat diakses oleh role <b>anggota</b>.</p>
            @if (Auth::user()->role !== 'anggota')
                <div class="role-notice">🔒 Memerlukan Role Anggota (Akses akan ditolak 403)</div>
            @endif
        </a>

        <a href="{{ url('/perpus/katalog-api') }}" class="nav-card api-card">
            <h4>⚡ Portal Katalog Buku (RESTful API Client)</h4>
            <p>Integrasi Fetch API ke endpoint <code>/api/buku</code> (Pertemuan 15) untuk melihat, menambah, dan menghapus buku secara real-time.</p>
        </a>
    </div>
</div>
</body>
</html>
