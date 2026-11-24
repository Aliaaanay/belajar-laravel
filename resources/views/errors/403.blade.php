<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>403 - Akses Ditolak (Forbidden)</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f6f9; text-align: center; padding-top: 80px; color: #333; margin: 0; }
        .error-card { max-width: 520px; margin: auto; background: white; padding: 35px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); border-top: 5px solid #d97706; }
        h1 { font-size: 64px; margin: 0; color: #d97706; }
        h3 { margin-top: 10px; color: #2c3e50; }
        p { color: #666; line-height: 1.6; }
        .pesan-khusus { background: #fef3c7; color: #92400e; padding: 12px; border-radius: 6px; font-weight: bold; margin: 15px 0; font-size: 14px; }
        .btn { display: inline-block; margin-top: 15px; padding: 10px 20px; background: #2c3e50; color: white; text-decoration: none; border-radius: 6px; }
        .btn:hover { background: #1a252f; }
    </style>
</head>
<body>
<div class="error-card">
    <h1>403</h1>
    <h3>Akses Ditolak (Forbidden)</h3>

    @if (isset($exception) && $exception->getMessage())
        <div class="pesan-khusus">
            {{ $exception->getMessage() }}
        </div>
    @else
        <p>Anda tidak memiliki izin otorisasi untuk mengakses halaman ini.</p>
    @endif

    <a href="{{ url('/dashboard') }}" class="btn">&laquo; Kembali ke Dashboard</a>
</div>
</body>
</html>
