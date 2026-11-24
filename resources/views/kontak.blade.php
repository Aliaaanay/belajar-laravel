<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Kampus &amp; Layanan Bantuan - Pertemuan 18</title>
    <style>
        body { font-family: 'Segoe UI', system-ui, sans-serif; background: #f8fafc; color: #0f172a; margin: 0; padding: 40px 20px; }
        .container { max-width: 800px; margin: auto; background: white; padding: 35px; border-radius: 14px; box-shadow: 0 4px 15px rgba(0,0,0,0.06); border: 1px solid #e2e8f0; }
        .header { border-bottom: 2px solid #e2e8f0; padding-bottom: 15px; margin-bottom: 25px; }
        h1 { margin: 0 0 6px 0; color: #1e3a8a; font-size: 24px; }
        .subtitle { color: #64748b; font-size: 14px; margin: 0; }
        .info-card { background: #f1f5f9; border-left: 4px solid #2563eb; padding: 18px; border-radius: 8px; margin-bottom: 25px; line-height: 1.6; }
        .contact-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 18px; margin-bottom: 25px; }
        .contact-box { background: #ffffff; border: 1px solid #cbd5e1; padding: 20px; border-radius: 10px; }
        .contact-box h3 { margin: 0 0 8px 0; font-size: 15px; color: #0f172a; display: flex; align-items: center; gap: 8px; }
        .contact-box p { margin: 0; font-size: 13.5px; color: #475569; }
        .nav-back { margin-top: 30px; font-size: 14px; }
        .nav-back a { color: #2563eb; text-decoration: none; font-weight: 600; }
        .nav-back a:hover { text-decoration: underline; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Kontak Kampus &amp; Layanan Akademik</h1>
        <p class="subtitle">Modul Fitur Percabangan Git (Branching &amp; Merging `fitur-kontak`) - Pertemuan 18</p>
    </div>

    <div class="info-card">
        <b>Tentang Modul Ini:</b> Halaman ini dikembangkan sebagai pembuktian siklus alur kerja Git industri (Branching, Staging, Commit, dan Fast-forward Merging ke cabang <code>main</code>) pada proyek Laravel.
    </div>

    <div class="contact-grid">
        <div class="contact-box">
            <h3><span>📍</span> Alamat Kampus</h3>
            <p>Gedung Fakultas Ilmu Komputer<br>Jl. Pendidikan Raya No. 10, Tangerang Selatan</p>
        </div>
        <div class="contact-box">
            <h3><span>📞</span> Telepon &amp; WhatsApp</h3>
            <p>Hotline: (021) 740-1234<br>Helpdesk WA: 0812-3456-7890</p>
        </div>
        <div class="contact-box">
            <h3><span>✉️</span> Surat Elektronik</h3>
            <p>Akademik: baak@kampus.ac.id<br>Himpunan: himatif@kampus.ac.id</p>
        </div>
        <div class="contact-box">
            <h3><span>⏰</span> Jam Layanan</h3>
            <p>Senin - Jumat: 08.00 - 16.00 WIB<br>Sabtu: 08.00 - 13.00 WIB</p>
        </div>
    </div>

    <div class="nav-back">
        <a href="{{ url('/') }}">&laquo; Kembali ke Portal Utama Proyek</a>
    </div>
</div>
</body>
</html>
