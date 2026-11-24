<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan &amp; Transaksi E-Commerce</title>
    <style>
        body { font-family: 'Segoe UI', system-ui, sans-serif; background: #f8fafc; padding: 30px 20px; color: #0f172a; margin: 0; }
        .container { max-width: 1050px; margin: auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.06); border: 1px solid #e2e8f0; }
        h2 { margin-top: 0; color: #0f172a; font-size: 22px; border-bottom: 2px solid #e2e8f0; padding-bottom: 12px; }
        .toolbar { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-bottom: 25px; background: #f1f5f9; padding: 16px; border-radius: 8px; border: 1px solid #cbd5e1; }
        select { padding: 8px 12px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13.5px; }
        .btn { padding: 8px 15px; border-radius: 6px; text-decoration: none; color: white; font-size: 13px; font-weight: 600; border: none; cursor: pointer; display: inline-block; transition: opacity 0.2s; }
        .btn:hover { opacity: 0.9; }
        .btn-filter { background: #334155; }
        .btn-pdf { background: #dc2626; }
        .btn-preview { background: #ea580c; }
        .btn-excel { background: #16a34a; }
        .btn-print { background: #2563eb; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; font-size: 13.5px; }
        th, td { padding: 11px 12px; border: 1px solid #e2e8f0; text-align: left; }
        th { background: #1e293b; color: white; font-weight: 600; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .badge-status { display: inline-block; padding: 3px 8px; border-radius: 4px; font-size: 11.5px; font-weight: 700; background: #dcfce7; color: #166534; }
        .summary-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-top: 25px; }
        .summary-card { background: #f8fafc; border: 1px solid #e2e8f0; padding: 15px; border-radius: 8px; }
        .summary-title { font-size: 12px; color: #64748b; font-weight: 600; text-transform: uppercase; margin-bottom: 5px; }
        .summary-val { font-size: 20px; font-weight: 800; color: #0284c7; }

        @media print {
            .no-print { display: none !important; }
            body { background: white; padding: 0; }
            .container { box-shadow: none; border: none; max-width: 100%; padding: 0; }
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Laporan Rekapitulasi Penjualan E-Commerce (Status: {{ $status_aktif }})</h2>

    <!-- Area Filter & Tombol Aksi Export (Disembunyikan saat Print) -->
    <div class="toolbar no-print">
        <form method="GET" action="{{ url('/ecommerce/laporan') }}">
            <label><b>Filter Status:</b></label>
            <select name="status">
                <option value="Semua" {{ $status_aktif == 'Semua' ? 'selected' : '' }}>Semua Status</option>
                <option value="SUCCESS" {{ strtoupper($status_aktif) == 'SUCCESS' ? 'selected' : '' }}>SUCCESS Saja</option>
                <option value="PENDING" {{ strtoupper($status_aktif) == 'PENDING' ? 'selected' : '' }}>PENDING Saja</option>
            </select>
            <button type="submit" class="btn btn-filter">Terapkan Filter</button>
        </form>

        <div style="display: flex; gap: 8px; flex-wrap: wrap;">
            <a href="{{ url('/ecommerce/laporan/pdf?status=' . $status_aktif . '&mode=stream') }}" target="_blank" class="btn btn-preview">Preview PDF</a>
            <a href="{{ url('/ecommerce/laporan/pdf?status=' . $status_aktif . '&mode=download') }}" class="btn btn-pdf">Download PDF</a>
            <a href="{{ url('/ecommerce/laporan/excel?status=' . $status_aktif) }}" class="btn btn-excel">Export Excel (CSV)</a>
            <button onclick="window.print()" class="btn btn-print">Cetak Langsung</button>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 40px;" class="text-center">No</th>
                <th>No. Invoice</th>
                <th>Tanggal</th>
                <th>Nama Produk</th>
                <th class="text-center">Qty</th>
                <th class="text-right">Total Bayar</th>
                <th class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td><b>{{ $item->invoice_code }}</b></td>
                <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $item->product ? $item->product->name : 'Produk Tidak Ditemukan' }}</td>
                <td class="text-center">{{ $item->qty }} unit</td>
                <td class="text-right"><b>Rp {{ number_format($item->total_price, 0, ',', '.') }}</b></td>
                <td class="text-center">
                    <span class="badge-status">{{ $item->status }}</span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center" style="padding: 30px; color: #94a3b8;">
                    Tidak ada transaksi penjualan untuk filter status yang dipilih.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- KARTU REKAPITULASI OMSET -->
    <div class="summary-grid">
        <div class="summary-card">
            <div class="summary-title">Total Pesanan</div>
            <div class="summary-val">{{ $rekap['total_transaksi'] }} Transaksi</div>
        </div>
        <div class="summary-card">
            <div class="summary-title">Total Item Terjual</div>
            <div class="summary-val">{{ $rekap['total_item'] }} Unit</div>
        </div>
        <div class="summary-card" style="border-left: 4px solid #16a34a;">
            <div class="summary-title">Total Omset Pendapatan</div>
            <div class="summary-val" style="color: #16a34a;">Rp {{ number_format($rekap['total_omset'], 0, ',', '.') }}</div>
        </div>
    </div>

    <div class="no-print" style="margin-top: 30px; font-size: 13.5px; display: flex; gap: 15px;">
        <a href="{{ url('/ecommerce') }}" style="color: #0284c7; text-decoration: none; font-weight: 600;">&laquo; Kembali ke Katalog Toko</a>
        <a href="{{ url('/ecommerce/qa-dashboard') }}" style="color: #2563eb; text-decoration: none; font-weight: 600;">Ke QA Dashboard E-Commerce &raquo;</a>
    </div>
</div>
</body>
</html>
