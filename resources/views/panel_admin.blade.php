<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Ruang Server Admin</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f0f4f8; margin: 0; padding: 40px 20px; color: #1e293b; }
        .container { max-width: 800px; margin: auto; background: white; padding: 35px; border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,0.08); border-top: 5px solid #d97706; }
        h1 { margin-top: 0; color: #92400e; font-size: 26px; border-bottom: 2px solid #fef3c7; padding-bottom: 12px; }
        .lead { font-size: 15px; color: #475569; margin: 10px 0 20px 0; }
        .metrics { display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; margin: 25px 0; }
        .metric-card { background: #fefce8; border: 1px solid #fef08a; padding: 18px; border-radius: 8px; text-align: center; }
        .metric-val { font-size: 22px; font-weight: 700; color: #854d0e; }
        .metric-lbl { font-size: 12px; color: #713f12; text-transform: uppercase; font-weight: 600; margin-top: 4px; }
        .btn-kembali { display: inline-block; margin-top: 20px; color: #0284c7; text-decoration: none; font-weight: 600; font-size: 14px; }
        .btn-kembali:hover { text-decoration: underline; }
    </style>
</head>
<body>
<div class="container">
    <h1>Panel Ruang Server Admin</h1>
    <p class="lead">Halo Admin! Kamu memiliki hak akses penuh di halaman ini.</p>

    <div style="background: #f8fafc; border-left: 4px solid #16a34a; padding: 12px 16px; border-radius: 4px; font-size: 14px; color: #15803d;">
        <b>Status Otorisasi: DIIZINKAN (Role: Admin)</b><br>
        Middleware <code>role:admin</code> berhasil memvalidasi hak akses level administrator untuk akun: <b>{{ Auth::user()->email }}</b>.
    </div>

    <div class="metrics">
        <div class="metric-card">
            <div class="metric-val">Aktif (3306)</div>
            <div class="metric-lbl">MySQL Laragon</div>
        </div>
        <div class="metric-card">
            <div class="metric-val">Normal</div>
            <div class="metric-lbl">Status Server</div>
        </div>
        <div class="metric-card">
            <div class="metric-val">4 Role</div>
            <div class="metric-lbl">Hak Akses Sistem</div>
        </div>
    </div>

    <a href="{{ url('/dashboard') }}" class="btn-kembali">&laquo; Kembali ke Dashboard</a>
</div>
</body>
</html>
