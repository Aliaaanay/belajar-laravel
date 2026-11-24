<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Mahasiswa - Praktik 3 Git Branching</title>
    <style>
        body { font-family: 'Segoe UI', system-ui, sans-serif; background: #f8fafc; color: #0f172a; margin: 0; padding: 40px 20px; }
        .container { max-width: 650px; margin: auto; background: white; padding: 35px; border-radius: 14px; box-shadow: 0 4px 15px rgba(0,0,0,0.06); border: 1px solid #e2e8f0; text-align: center; }
        .avatar { width: 90px; height: 90px; border-radius: 50%; background: #2563eb; color: white; display: flex; align-items: center; justify-content: center; font-size: 36px; margin: 0 auto 15px auto; font-weight: bold; }
        h1 { margin: 0 0 6px 0; font-size: 24px; color: #1e3a8a; }
        .badge { display: inline-block; background: #dbeafe; color: #1d4ed8; font-size: 13px; font-weight: 600; padding: 4px 12px; border-radius: 20px; margin-bottom: 20px; }
        .info-table { width: 100%; border-collapse: collapse; text-align: left; margin-top: 15px; font-size: 14px; }
        .info-table td { padding: 10px 12px; border-bottom: 1px solid #e2e8f0; }
        .info-table td:first-child { font-weight: 600; color: #64748b; width: 35%; }
        .nav-back { margin-top: 25px; }
        .nav-back a { color: #2563eb; text-decoration: none; font-weight: 600; font-size: 13.5px; }
        .nav-back a:hover { text-decoration: underline; }
    </style>
</head>
<body>
<div class="container">
    <div class="avatar">SL</div>
    <h1>{{ $profil['nama'] }}</h1>
    <span class="badge">NIM: {{ $profil['nim'] }} &bull; Semester {{ $profil['semester'] }}</span>

    <table class="info-table">
        <tr>
            <td>Program Studi</td>
            <td>{{ $profil['prodi'] }}</td>
        </tr>
        <tr>
            <td>Fakultas</td>
            <td>{{ $profil['fakultas'] }}</td>
        </tr>
        <tr>
            <td>GitHub</td>
            <td><a href="{{ $profil['github'] }}" target="_blank" style="color: #2563eb;">{{ $profil['github'] }}</a></td>
        </tr>
        <tr>
            <td>Bio</td>
            <td>{{ $profil['bio'] }}</td>
        </tr>
        <tr>
            <td>Cabang Git</td>
            <td><code style="background: #f1f5f9; padding: 2px 6px; border-radius: 4px;">fitur-profil</code> (Praktik 3 Modul 18)</td>
        </tr>
    </table>

    <div class="nav-back">
        <a href="{{ url('/') }}">&laquo; Kembali ke Portal Utama</a>
    </div>
</div>
</body>
</html>
