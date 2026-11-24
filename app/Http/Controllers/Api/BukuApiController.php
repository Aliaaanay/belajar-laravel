<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class BukuApiController extends Controller
{
    // 1. GET /api/buku -> Menampilkan seluruh koleksi buku (200 OK)
    public function index()
    {
        $bukus = Buku::orderBy('id', 'asc')->get();

        return response()->json([
            'status' => true,
            'pesan' => 'Daftar katalog buku perpustakaan berhasil diambil.',
            'jumlah_data' => $bukus->count(),
            'total_stok' => $bukus->sum('stok'),
            'data' => $bukus
        ], 200);
    }

    // 2. POST /api/buku -> Menambahkan buku baru (201 Created / 422 Unprocessable)
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'kode_buku' => 'required|string|max:30|unique:bukus,kode_buku',
                'judul_buku' => 'required|string|max:200',
                'penulis' => 'required|string|max:150',
                'stok' => 'required|integer|min:0',
            ], [
                'kode_buku.unique' => 'Kode buku sudah terdaftar di sistem katalog.',
                'kode_buku.required' => 'Kode buku wajib diisi.',
                'judul_buku.required' => 'Judul buku wajib diisi.',
                'penulis.required' => 'Penulis buku wajib diisi.',
                'stok.min' => 'Jumlah stok buku tidak boleh bernilai negatif (minimal 0).'
            ]);

            if ($validator->fails()) {
                Log::warning("Validasi penambahan buku gagal", ['errors' => $validator->errors()->toArray()]);

                return response()->json([
                    'status' => false,
                    'pesan' => 'Validasi gagal! Periksa kembali input data buku.',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Simulasi Exception Handling jika data ekstrem
            if ((int)$request->stok < 0) {
                throw new \Exception("Stok buku tidak boleh kurang dari 0!");
            }

            $buku = Buku::create($request->only(['kode_buku', 'judul_buku', 'penulis', 'stok']));

            Log::info("Buku baru berhasil ditambahkan melalui API: {$buku->kode_buku} - {$buku->judul_buku}");

            return response()->json([
                'status' => true,
                'pesan' => 'Buku baru berhasil ditambahkan ke katalog via POST /api/buku (201 Created)!',
                'data' => $buku
            ], 201);
        } catch (\Throwable $e) {
            Log::error("Error saat menyimpan buku via API: " . $e->getMessage());
            return response()->json([
                'status' => false,
                'pesan' => 'Terjadi kesalahan pada server saat memproses data buku: ' . $e->getMessage()
            ], 500);
        }
    }

    // 3. GET /api/buku/{id} -> Menampilkan detail 1 buku (200 OK / 404 Not Found)
    public function show(string $id)
    {
        $buku = Buku::find($id);

        if (!$buku) {
            Log::warning("Pencarian buku via API tidak ditemukan untuk ID: {$id}");
            return response()->json([
                'status' => false,
                'pesan' => "Data buku dengan ID {$id} tidak ditemukan di katalog perpustakaan!"
            ], 404);
        }

        return response()->json([
            'status' => true,
            'pesan' => 'Detail data buku berhasil ditemukan.',
            'data' => $buku
        ], 200);
    }

    // 4. PUT/PATCH /api/buku/{id} -> Memperbarui informasi buku
    public function update(Request $request, string $id)
    {
        $buku = Buku::find($id);

        if (!$buku) {
            return response()->json([
                'status' => false,
                'pesan' => "Data buku dengan ID {$id} tidak ditemukan untuk diperbarui!"
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'kode_buku' => 'required|string|max:30|unique:bukus,kode_buku,' . $id,
            'judul_buku' => 'required|string|max:200',
            'penulis' => 'required|string|max:150',
            'stok' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'pesan' => 'Validasi gagal saat memperbarui data buku!',
                'errors' => $validator->errors()
            ], 422);
        }

        $buku->update($request->only(['kode_buku', 'judul_buku', 'penulis', 'stok']));

        Log::info("Data buku berhasil diperbarui melalui API ID: {$id}");

        return response()->json([
            'status' => true,
            'pesan' => 'Data buku berhasil diperbarui!',
            'data' => $buku
        ], 200);
    }

    // 5. DELETE /api/buku/{id} -> Menghapus buku
    public function destroy(string $id)
    {
        $buku = Buku::find($id);

        if (!$buku) {
            return response()->json([
                'status' => false,
                'pesan' => "Data buku dengan ID {$id} tidak ditemukan untuk dihapus!"
            ], 404);
        }

        $judul = $buku->judul_buku;
        $buku->delete();

        Log::info("Buku berhasil dihapus melalui API: ID {$id} - {$judul}");

        return response()->json([
            'status' => true,
            'pesan' => "Buku '{$judul}' berhasil dihapus dari server API perpustakaan!"
        ], 200);
    }
}
