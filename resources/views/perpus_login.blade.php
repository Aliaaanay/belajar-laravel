<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login E-Perpustakaan Kampus</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f0f4f8; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .card { background: white; width: 400px; padding: 32px; border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,0.08); border-top: 5px solid #0284c7; }
        h2 { margin-top: 0; color: #0369a1; border-bottom: 2px solid #e0f2fe; padding-bottom: 12px; font-size: 22px; text-align: center; }
        .subtitle { text-align: center; color: #64748b; font-size: 13px; margin-top: -8px; margin-bottom: 20px; }
        label { display: block; margin-top: 14px; font-weight: 600; font-size: 13px; color: #334155; }
        input { width: 100%; padding: 10px 12px; margin-top: 6px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box; font-size: 14px; font-family: inherit; }
        input:focus { outline: none; border-color: #0284c7; box-shadow: 0 0 0 3px rgba(2,132,199,0.15); }
        button { width: 100%; margin-top: 24px; padding: 11px; background: #0284c7; color: white; border: none; border-radius: 6px; font-weight: 700; cursor: pointer; font-size: 15px; transition: background 0.2s; }
        button:hover { background: #0369a1; }
        .alert-sukses { background: #dcfce7; border-left: 4px solid #16a34a; color: #15803d; padding: 10px 14px; border-radius: 4px; font-size: 13px; margin-bottom: 15px; }
        .alert-error { background: #fef2f2; border-left: 4px solid #ef4444; color: #991b1b; padding: 10px 14px; border-radius: 4px; font-size: 13px; margin-bottom: 15px; }
        .link { text-align: center; margin-top: 20px; font-size: 13px; color: #64748b; }
        .link a { color: #0284c7; text-decoration: none; font-weight: 600; }
        .link a:hover { text-decoration: underline; }
    </style>
</head>
<body>
<div class="card">
    <h2>Login Portal E-Perpustakaan</h2>
    <div class="subtitle">Akses Layanan Koleksi & Peminjaman Buku</div>

    @if (session('sukses'))
    <div class="alert-sukses">{{ session('sukses') }}</div>
    @endif

    @if ($errors->any())
    <div class="alert-error">
        @foreach ($errors->all() as $err)
            <div>{{ $err }}</div>
        @endforeach
    </div>
    @endif

    <form method="POST" action="{{ url('/perpus/login') }}">
        @csrf
        <label>Alamat Email</label>
        <input type="email" name="email" value="{{ old('email') }}" placeholder="email@perpus.ac.id" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Masukkan password Anda" required>

        <button type="submit">Masuk ke Portal</button>
    </form>

    <div class="link">
        Belum memiliki akun perpustakaan? <a href="{{ url('/perpus/register') }}">Daftar Baru</a>
    </div>
</div>
</body>
</html>
