<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Mahasiswa - {{ $mhs['nama'] }}</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f6f9; margin: 0; padding: 40px 20px; color: #333; }
        .card { max-width: 550px; margin: auto; background: white; padding: 35px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); border-top: 5px solid #0284c7; }
        h2 { margin-top: 0; color: #1e3a8a; border-bottom: 2px solid #e2e8f0; padding-bottom: 12px; font-size: 22px; }
        .row { margin-bottom: 14px; font-size: 15px; display: flex; }
        .label { width: 160px; font-weight: 600; color: #64748b; }
        .val { font-weight: 600; color: #1e293b; }
        .badge-cumlaude { background: #dcfce7; color: #15803d; padding: 4px 10px; border-radius: 12px; font-size: 12px; }
        .badge-memuaskan { background: #dbeafe; color: #1e40af; padding: 4px 10px; border-radius: 12px; font-size: 12px; }
        .btn-kembali { display: inline-block; margin-top: 25px; background: #1e3a8a; color: white; padding: 9px 18px; text-decoration: none; border-radius: 6px; font-weight: 600; font-size: 14px; }
        .btn-kembali:hover { background: #172554; }
    </style>
</head>
<body>
<div class="card">
    <h2>Detail Informasi Mahasiswa</h2>

    <div class="row">
        <span class="label">NIM</span>
        <span class="val"><strong style="color: #0284c7;">{{ $mhs['nim'] }}</strong></span>
    </div>
    <div class="row">
        <span class="label">Nama Lengkap</span>
        <span class="val">{{ $mhs['nama'] }}</span>
    </div>
    <div class="row">
        <span class="label">Program Studi</span>
        <span class="val">{{ $mhs['prodi'] ?? $mhs['jurusan'] ?? 'Teknik Informatika' }}</span>
    </div>
    <div class="row">
        <span class="label">Indeks Prestasi (IPK)</span>
        <span class="val">{{ number_format((float)$mhs['ipk'], 2) }}</span>
    </div>
    <div class="row">
        <span class="label">Predikat Kelulusan</span>
        <span class="val">
            @if ((float)$mhs['ipk'] >= 3.50)
                <span class="badge-cumlaude">✓ Cumlaude</span>
            @else
                <span class="badge-memuaskan">Sangat Memuaskan</span>
            @endif
        </span>
    </div>

    <a href="{{ url('/mahasiswa') }}" class="btn-kembali">&laquo; Kembali ke Daftar Mahasiswa</a>
</div>
</body>
</html>
