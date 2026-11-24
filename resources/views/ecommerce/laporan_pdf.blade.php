<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Rekapitulasi Penjualan Resmi</title>
    <style>
        body { font-family: DejaVu Sans, Arial, sans-serif; font-size: 11px; color: #1e293b; }
        .kop-surat { text-align: center; border-bottom: 3px double #0f172a; padding-bottom: 12px; margin-bottom: 18px; }
        .kop-surat h2 { margin: 0; font-size: 17px; text-transform: uppercase; color: #0f172a; }
        .kop-surat h4 { margin: 4px 0; font-size: 12px; font-weight: normal; color: #334155; }
        .kop-surat p { margin: 2px 0; font-size: 9.5px; color: #64748b; }
        .meta-info { width: 100%; margin-bottom: 15px; font-size: 10.5px; }
        .meta-info td { padding: 3px 0; border: none; }
        .data-table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 10px; }
        .data-table th, .data-table td { border: 1px solid #334155; padding: 7px 6px; text-align: left; }
        .data-table th { background-color: #0f172a; color: #ffffff; text-align: center; font-weight: bold; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .total-row { background-color: #f1f5f9; font-weight: bold; }
        .ttd-table { width: 100%; margin-top: 35px; }
        .ttd-table td { border: none; text-align: center; width: 50%; vertical-align: top; font-size: 11px; }
        .ruang-ttd { height: 60px; }
    </style>
</head>
<body>
    <!-- KOP SURAT RESMI E-COMMERCE -->
    <div class="kop-surat">
        <h2>PT TECHSTORE NUSANTARA E-COMMERCE</h2>
        <h4>Laporan Resmi Rekapitulasi Transaksi &amp; Omset Penjualan</h4>
        <p>Cyber 2 Tower Lt. 18, Jl. H.R. Rasuna Said Kav. X-5, Jakarta Selatan | Email: finance@techstore.co.id</p>
    </div>

    <!-- METADATA DOKUMEN -->
    <table class="meta-info">
        <tr>
            <td style="width: 20%;"><b>Filter Status</b></td>
            <td style="width: 30%;">: {{ $status_aktif }}</td>
            <td style="width: 20%;"><b>Tanggal Cetak</b></td>
            <td style="width: 30%;">: {{ $tanggal_cetak }}</td>
        </tr>
        <tr>
            <td><b>Jumlah Pesanan</b></td>
            <td>: {{ $rekap['total_transaksi'] }} Transaksi</td>
            <td><b>Status Audit</b></td>
            <td>: Dokumen Resmi Terverifikasi Sistem</td>
        </tr>
    </table>

    <!-- TABEL TRANSAKSI -->
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 20%;">No. Invoice</th>
                <th style="width: 15%;">Tanggal</th>
                <th style="width: 28%;">Nama Produk</th>
                <th style="width: 8%;">Qty</th>
                <th style="width: 10%;">Diskon</th>
                <th style="width: 14%;">Total Bayar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-center"><b>{{ $item->invoice_code }}</b></td>
                <td class="text-center">{{ $item->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $item->product ? $item->product->name : 'Produk Dihapus' }}</td>
                <td class="text-center">{{ $item->qty }}</td>
                <td class="text-center">{{ $item->discount_percent }}%</td>
                <td class="text-right">Rp {{ number_format($item->total_price, 0, ',', '.') }}</td>
            </tr>
            @endforeach

            <tr class="total-row">
                <td colspan="4" class="text-right">TOTAL ITEM TERJUAL:</td>
                <td class="text-center">{{ $rekap['total_item'] }} unit</td>
                <td colspan="2"></td>
            </tr>
            <tr class="total-row" style="background-color: #e0f2fe;">
                <td colspan="5" class="text-right">TOTAL OMSET PENDAPATAN:</td>
                <td colspan="2" class="text-right" style="font-size: 11px; color: #0369a1;">
                    <b>Rp {{ number_format($rekap['total_omset'], 0, ',', '.') }}</b>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- TANDA TANGAN PENGESAHAN -->
    <table class="ttd-table">
        <tr>
            <td>
                Mengetahui,<br>
                <b>Operational Director</b>
                <div class="ruang-ttd"></div>
                <u><b>( Septa Pratama, M.Kom. )</b></u>
            </td>
            <td>
                Jakarta Selatan, {{ $tanggal_cetak }}<br>
                <b>Finance &amp; Accounting Manager</b>
                <div class="ruang-ttd"></div>
                <u><b>( Siti Nabila, S.E., M.Ak. )</b></u>
            </td>
        </tr>
    </table>
</body>
</html>
