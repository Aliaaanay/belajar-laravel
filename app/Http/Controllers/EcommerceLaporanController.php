<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;

class EcommerceLaporanController extends Controller
{
    /**
     * Mengambil data transaksi penjualan dari database dengan filter status
     */
    private function ambilDataPenjualan($status = 'Semua')
    {
        $query = Order::with('product')->latest();

        if ($status !== 'Semua') {
            $query->where('status', strtoupper($status));
        }

        return $query->get();
    }

    /**
     * Menghitung total transaksi, total item terjual, dan total omset
     */
    private function hitungRekapPenjualan($orders)
    {
        $total_transaksi = $orders->count();
        $total_item = $orders->sum('qty');
        $total_omset = $orders->sum('total_price');

        return [
            'total_transaksi' => $total_transaksi,
            'total_item' => $total_item,
            'total_omset' => $total_omset
        ];
    }

    /**
     * 1. Halaman Web Laporan Penjualan E-Commerce (/ecommerce/laporan)
     */
    public function index(Request $request)
    {
        $status = $request->query('status', 'Semua');
        $orders = $this->ambilDataPenjualan($status);
        $rekap = $this->hitungRekapPenjualan($orders);

        return view('ecommerce.laporan_index', [
            'orders' => $orders,
            'status_aktif' => $status,
            'rekap' => $rekap
        ]);
    }

    /**
     * 2. Export Laporan Penjualan ke Format PDF (/ecommerce/laporan/pdf)
     */
    public function exportPdf(Request $request)
    {
        $status = $request->query('status', 'Semua');
        $mode = $request->query('mode', 'download'); // 'download' atau 'stream'
        $orders = $this->ambilDataPenjualan($status);
        $rekap = $this->hitungRekapPenjualan($orders);

        $pdf = Pdf::loadView('ecommerce.laporan_pdf', [
            'orders' => $orders,
            'status_aktif' => $status,
            'rekap' => $rekap,
            'tanggal_cetak' => date('d F Y')
        ])->setPaper('a4', 'portrait');

        $nama_file = 'Laporan-Penjualan-Ecommerce-' . $status . '-' . date('Ymd') . '.pdf';

        if ($mode === 'stream') {
            return $pdf->stream($nama_file);
        }

        return $pdf->download($nama_file);
    }

    /**
     * 3. Export Laporan Penjualan ke Excel / CSV Ramah Excel (/ecommerce/laporan/excel)
     */
    public function exportExcel(Request $request)
    {
        $status = $request->query('status', 'Semua');
        $orders = $this->ambilDataPenjualan($status);
        $rekap = $this->hitungRekapPenjualan($orders);

        $nama_file = 'Laporan-Penjualan-Ecommerce-' . $status . '-' . date('Ymd') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"$nama_file\"",
        ];

        return response()->streamDownload(function () use ($orders, $rekap) {
            $handle = fopen('php://output', 'w');

            // 1. Sisipkan UTF-8 BOM
            fwrite($handle, "\xEF\xBB\xBF");

            // 2. Baris Header Kolom Tabel
            fputcsv($handle, ['No', 'No. Invoice', 'Tanggal', 'Nama Produk', 'SKU', 'Harga Satuan (Rp)', 'Qty', 'Diskon (%)', 'Total Pembayaran (Rp)', 'Status'], ';');

            // 3. Baris Isi Data
            $no = 1;
            foreach ($orders as $item) {
                fputcsv($handle, [
                    $no++,
                    $item->invoice_code,
                    $item->created_at->format('Y-m-d H:i'),
                    $item->product ? $item->product->name : 'Produk Dihapus',
                    $item->product ? $item->product->sku : '-',
                    $item->product ? $item->product->price : 0,
                    $item->qty,
                    $item->discount_percent,
                    $item->total_price,
                    $item->status
                ], ';');
            }

            // 4. Baris Rekapitulasi Total di Bawah Tabel
            fputcsv($handle, [], ';');
            fputcsv($handle, ['', '', '', 'TOTAL TRANSAKSI', '', '', $rekap['total_transaksi'] . ' Pesanan', '', '', ''], ';');
            fputcsv($handle, ['', '', '', 'TOTAL BARANG TERJUAL', '', '', $rekap['total_item'] . ' Unit', '', '', ''], ';');
            fputcsv($handle, ['', '', '', 'TOTAL OMSET PENDAPATAN', '', '', '', '', $rekap['total_omset'], ''], ';');

            fclose($handle);
        }, $nama_file, $headers);
    }
}
