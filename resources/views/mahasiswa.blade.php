<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa - Konsep MVC Pertemuan 13</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f6f9; margin: 0; padding: 40px 20px; color: #333; }
        .container { max-width: 900px; margin: auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); border-top: 5px solid #0284c7; }
        h1 { margin-top: 0; color: #1e3a8a; font-size: 24px; border-bottom: 2px solid #e2e8f0; padding-bottom: 12px; }
        .info-box { background: #e0f2fe; border-left: 4px solid #0284c7; padding: 12px 16px; margin: 20px 0; border-radius: 4px; font-size: 14px; color: #0369a1; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 12px 14px; text-align: left; border: 1px solid #cbd5e1; }
        th { background: #1e3a8a; color: white; font-weight: 600; text-transform: uppercase; font-size: 12px; }
        tr:hover { background-color: #f8fafc; }
        .badge-cumlaude { color: green; font-weight: bold; }
        .badge-memuaskan { color: blue; }
        .btn-detail { display: inline-block; padding: 6px 12px; background: #0284c7; color: white; text-decoration: none; border-radius: 4px; font-size: 12px; font-weight: 600; }
        .btn-detail:hover { background: #0369a1; }
        .nav-back { margin-top: 25px; }
        .nav-back a { color: #0284c7; text-decoration: none; font-size: 14px; font-weight: 600; }
        .nav-back a:hover { text-decoration: underline; }
    </style>
</head>
<body>
<div class="container">
    <h1>Daftar Mahasiswa (Implementasi MVC - Pertemuan 13)</h1>

    <div class="info-box">
        Halaman ini mendemonstrasikan arsitektur <b>Model-View-Controller (MVC)</b>: Model <code>Mahasiswa.php</code> menyediakan data, Controller <code>MahasiswaController.php</code> mengatur alur logika, dan View <code>mahasiswa.blade.php</code> merender tampilan tabel dengan sintaks <code>@@foreach</code> dan percabangan <code>@@if</code> predikat kelulusan.
    </div>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>IPK</th>
                <th>Predikat Kelulusan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($daftar_mhs as $mhs)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><b>{{ $mhs['nim'] }}</b></td>
                <td>{{ $mhs['nama'] }}</td>
                <td><b>{{ number_format((float)$mhs['ipk'], 2) }}</b></td>
                <td>
                    @if ((float)$mhs['ipk'] >= 3.50)
                        <span class="badge-cumlaude">Cumlaude</span>
                    @else
                        <span class="badge-memuaskan">Sangat Memuaskan</span>
                    @endif
                </td>
                <td>
                    <a href="{{ url('/mahasiswa/' . $mhs['nim']) }}" class="btn-detail">Lihat Profil</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="nav-back">
        <a href="{{ url('/') }}">&laquo; Kembali ke Portal Utama</a> |
        <a href="{{ url('/matakuliah') }}">Ke Katalog Mata Kuliah &raquo;</a>
    </div>
</div>
</body>
</html>
