<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laboratorium - {{ $lab['nama_lab'] }}</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f6f9; margin: 0; padding: 40px; color: #2c3e50; }
        .card { max-width: 650px; margin: auto; background: white; padding: 35px; border-radius: 12px; box-shadow: 0 4px 18px rgba(0,0,0,0.08); border-top: 5px solid #2563eb; }
        h2 { margin-top: 0; color: #1e3a8a; border-bottom: 2px solid #e2e8f0; padding-bottom: 12px; font-size: 22px; }
        .info-row { display: flex; margin-bottom: 14px; font-size: 15px; }
        .label { width: 180px; font-weight: 600; color: #64748b; flex-shrink: 0; }
        .val { color: #1e293b; font-weight: 500; }
        .badge { display: inline-block; padding: 4px 12px; border-radius: 9999px; font-size: 12px; font-weight: 700; }
        .badge-tersedia { background: #dcfce7; color: #15803d; border: 1px solid #86efac; }
        .badge-maintenance { background: #fee2e2; color: #b91c1c; border: 1px solid #fca5a5; }
        .fasilitas-box { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 16px; margin-top: 20px; line-height: 1.6; }
        .fasilitas-title { font-weight: 700; color: #334155; margin-bottom: 6px; }
        .btn-kembali { display: inline-block; margin-top: 25px; background: #1e3a8a; color: white; padding: 10px 20px; text-decoration: none; border-radius: 6px; font-weight: 600; font-size: 14px; transition: background 0.2s; }
        .btn-kembali:hover { background: #172554; }
    </style>
</head>
<body>
<div class="card">
    <h2>Detail Inventaris Laboratorium Komputer</h2>

    <div class="info-row">
        <span class="label">Kode Laboratorium</span>
        <span class="val"><strong style="color: #2563eb;">{{ $lab['kode_lab'] }}</strong></span>
    </div>
    <div class="info-row">
        <span class="label">Nama Laboratorium</span>
        <span class="val"><b>{{ $lab['nama_lab'] }}</b></span>
    </div>
    <div class="info-row">
        <span class="label">Penanggung Jawab</span>
        <span class="val">{{ $lab['penanggung_jawab'] }}</span>
    </div>
    <div class="info-row">
        <span class="label">Kapasitas Komputer</span>
        <span class="val"><b>{{ $lab['kapasitas_pc'] }} Unit PC Siap Pakai</b></span>
    </div>
    <div class="info-row">
        <span class="label">Status Kesiapan</span>
        <span class="val">
            @if ($lab['status'] === 'Tersedia')
                <span class="badge badge-tersedia">✓ Tersedia untuk Praktikum</span>
            @else
                <span class="badge badge-maintenance">⚠ Sedang Maintenance / Perbaikan</span>
            @endif
        </span>
    </div>

    <div class="fasilitas-box">
        <div class="fasilitas-title">Spesifikasi & Fasilitas Perangkat:</div>
        <div>{{ $lab['fasilitas'] }}</div>
    </div>

    <a href="{{ url('/laboratorium') }}" class="btn-kembali">&laquo; Kembali ke Direktori Laboratorium</a>
</div>
</body>
</html>
