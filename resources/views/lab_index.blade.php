<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $judul }}</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f6f9; margin: 0; padding: 30px; color: #2c3e50; }
        .container { max-width: 950px; margin: auto; background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.06); }
        h1 { margin-top: 0; color: #1e3a8a; border-bottom: 3px solid #3b82f6; padding-bottom: 12px; font-size: 26px; }
        .filter-nav { display: flex; gap: 10px; margin-bottom: 20px; align-items: center; }
        .filter-btn { padding: 8px 18px; border-radius: 20px; text-decoration: none; font-size: 14px; font-weight: 600; border: 1px solid #cbd5e1; color: #475569; background: #f8fafc; transition: all 0.2s; }
        .filter-btn:hover, .filter-btn.active { background: #1e3a8a; color: white; border-color: #1e3a8a; }
        .stat-banner { background: #eff6ff; border-left: 5px solid #3b82f6; padding: 14px 18px; margin-bottom: 25px; border-radius: 6px; font-size: 15px; color: #1e40af; }
        .alert-error { background: #fee2e2; border-left: 5px solid #ef4444; color: #991b1b; padding: 12px 16px; border-radius: 6px; margin-bottom: 20px; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 14px 16px; text-align: left; border-bottom: 1px solid #e2e8f0; }
        th { background: #1e3a8a; color: white; font-weight: 600; text-transform: uppercase; font-size: 12px; letter-spacing: 0.5px; }
        tr:hover { background-color: #f8fafc; }
        .badge { display: inline-block; padding: 5px 12px; border-radius: 9999px; font-size: 12px; font-weight: 700; }
        .badge-tersedia { background: #dcfce7; color: #15803d; border: 1px solid #86efac; }
        .badge-maintenance { background: #fee2e2; color: #b91c1c; border: 1px solid #fca5a5; }
        .btn-detail { display: inline-block; padding: 6px 14px; background: #2563eb; color: white; text-decoration: none; border-radius: 6px; font-size: 13px; font-weight: 500; }
        .btn-detail:hover { background: #1d4ed8; }
        .empty-row { text-align: center; color: #94a3b8; padding: 30px; font-style: italic; }
    </style>
</head>
<body>
<div class="container">
    <h1>{{ $judul }}</h1>

    <div class="filter-nav">
        <span><b>Filter Status:</b></span>
        <a href="{{ url('/laboratorium') }}" class="filter-btn {{ $filter_aktif === 'semua' ? 'active' : '' }}">Semua Lab</a>
        <a href="{{ url('/laboratorium/status/Tersedia') }}" class="filter-btn {{ $filter_aktif === 'tersedia' ? 'active' : '' }}">Tersedia</a>
        <a href="{{ url('/laboratorium/status/Maintenance') }}" class="filter-btn {{ in_array($filter_aktif, ['maintenance', 'sedang maintenance']) ? 'active' : '' }}">Maintenance</a>
    </div>

    @if (isset($pesan_error))
    <div class="alert-error">
        <b>Peringatan:</b> {{ $pesan_error }}
    </div>
    @endif

    <div class="stat-banner">
        Menampilkan <b>{{ count($daftar_lab) }} Laboratorium</b> dengan total kapasitas akumulasi <b>{{ $total_pc }} Unit PC</b> siap guna.
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Lab</th>
                <th>Nama Laboratorium</th>
                <th>Penanggung Jawab</th>
                <th>Kapasitas</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($daftar_lab as $lab)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><strong style="color: #1e3a8a;">{{ $lab['kode_lab'] }}</strong></td>
                <td><b>{{ $lab['nama_lab'] }}</b></td>
                <td>{{ $lab['penanggung_jawab'] }}</td>
                <td>{{ $lab['kapasitas_pc'] }} PC</td>
                <td>
                    @if ($lab['status'] === 'Tersedia')
                        <span class="badge badge-tersedia">✓ Tersedia</span>
                    @else
                        <span class="badge badge-maintenance">⚠ Sedang Maintenance</span>
                    @endif
                </td>
                <td>
                    <a href="{{ url('/laboratorium/detail/' . $lab['kode_lab']) }}" class="btn-detail">Lihat Detail</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="empty-row">Tidak ada data laboratorium untuk kriteria filter ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
</body>
</html>
