<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Buku RESTful API - E-Perpustakaan</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f0f4f8; margin: 0; padding: 35px 20px; color: #1e293b; }
        .container { max-width: 950px; margin: auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,0.08); border-top: 5px solid #0284c7; }
        .top-bar { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #e2e8f0; padding-bottom: 15px; margin-bottom: 20px; }
        h1 { margin: 0; color: #0369a1; font-size: 24px; }
        .badge-status { background: #059669; color: white; padding: 6px 14px; border-radius: 9999px; font-size: 12px; font-weight: 700; }
        .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; margin-bottom: 25px; }
        .stat-card { background: #f8fafc; border: 1px solid #e2e8f0; padding: 15px; border-radius: 8px; text-align: center; }
        .stat-num { font-size: 24px; font-weight: 700; color: #0284c7; }
        .stat-lbl { font-size: 12px; color: #64748b; text-transform: uppercase; font-weight: 600; margin-top: 4px; }
        .alert { display: none; padding: 12px 16px; border-radius: 6px; font-size: 14px; margin-bottom: 20px; line-height: 1.5; }
        .alert-sukses { background: #dcfce7; color: #15803d; border-left: 4px solid #16a34a; }
        .alert-error { background: #fee2e2; color: #991b1b; border-left: 4px solid #ef4444; }
        .form-card { background: #f8fafc; border: 1px solid #cbd5e1; border-radius: 8px; padding: 20px; margin-bottom: 25px; }
        .form-card h3 { margin-top: 0; color: #1e293b; font-size: 16px; margin-bottom: 12px; }
        .form-grid { display: grid; grid-template-columns: 1fr 2fr 1.5fr 1fr auto; gap: 10px; align-items: end; }
        .form-group label { display: block; font-size: 12px; font-weight: 600; color: #475569; margin-bottom: 4px; }
        .form-group input { width: 100%; padding: 9px 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 13px; box-sizing: border-box; font-family: inherit; }
        .form-group input:focus { outline: none; border-color: #0284c7; }
        .btn-tambah { padding: 9px 18px; background: #0284c7; color: white; border: none; border-radius: 6px; font-weight: 700; cursor: pointer; font-size: 13px; height: 38px; white-space: nowrap; }
        .btn-tambah:hover { background: #0369a1; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 14px; }
        th, td { padding: 12px 14px; text-align: left; border-bottom: 1px solid #e2e8f0; }
        th { background: #0369a1; color: white; font-weight: 600; font-size: 12px; text-transform: uppercase; }
        tr:hover { background: #f8fafc; }
        .btn-hapus { background: #ef4444; color: white; border: none; padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: 600; cursor: pointer; }
        .btn-hapus:hover { background: #dc2626; }
        .bottom-nav { margin-top: 30px; display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #e2e8f0; padding-top: 15px; font-size: 13px; }
        .bottom-nav a { color: #0284c7; text-decoration: none; font-weight: 600; }
        .bottom-nav a:hover { text-decoration: underline; }
    </style>
</head>
<body>
<div class="container">
    <div class="top-bar">
        <div>
            <h1>Katalog Buku Perpustakaan (RESTful API Client)</h1>
            <div style="font-size: 13px; color: #64748b; margin-top: 4px;">Integrasi Asynchronous via JavaScript Fetch API ke Endpoint <code>/api/buku</code></div>
        </div>
        <span class="badge-status" id="statusApi">REST API: AKTIF</span>
    </div>

    <!-- Live Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-num" id="totalJudul">0</div>
            <div class="stat-lbl">Judul Buku Terdaftar</div>
        </div>
        <div class="stat-card">
            <div class="stat-num" id="totalStok">0</div>
            <div class="stat-lbl">Total Eksemplar Fisik</div>
        </div>
        <div class="stat-card">
            <div class="stat-num" id="formatApi">JSON</div>
            <div class="stat-lbl">Protokol Komunikasi</div>
        </div>
    </div>

    <div id="alertBox" class="alert"></div>

    <!-- Form Tambah Buku ke POST /api/buku -->
    <div class="form-card">
        <h3>+ Tambah Judul Buku Baru ke Server API</h3>
        <form id="formTambahBuku">
            <div class="form-grid">
                <div class="form-group">
                    <label>Kode Buku</label>
                    <input type="text" id="kode_buku" placeholder="Misal: BK-001" required>
                </div>
                <div class="form-group">
                    <label>Judul Buku</label>
                    <input type="text" id="judul_buku" placeholder="Judul literatur lengkap" required>
                </div>
                <div class="form-group">
                    <label>Nama Penulis</label>
                    <input type="text" id="penulis" placeholder="Penulis / Pengarang" required>
                </div>
                <div class="form-group">
                    <label>Stok</label>
                    <input type="number" id="stok" min="0" placeholder="0" required>
                </div>
                <div>
                    <button type="submit" class="btn-tambah">+ Simpan API</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Tabel Buku dari GET /api/buku -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Buku</th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Stok Tersedia</th>
                <th>Aksi API</th>
            </tr>
        </thead>
        <tbody id="tabelBukuBody">
            <tr><td colspan="6" style="text-align: center; padding: 20px;">Memuat data buku dari endpoint /api/buku...</td></tr>
        </tbody>
    </table>

    <div class="bottom-nav">
        <div>
            <a href="{{ url('/perpus/dashboard') }}">&laquo; Kembali ke Dashboard E-Perpustakaan</a>
        </div>
        <div>
            <a href="{{ url('/api/buku') }}" target="_blank">Endpoint JSON: /api/buku &nearr;</a> |
            <a href="{{ url('/client-mahasiswa') }}">Portal Client Mahasiswa &nearr;</a>
        </div>
    </div>
</div>

<script>
    const API_BUKU_URL = '/api/buku';

    function setStatus(text, bg) {
        const el = document.getElementById('statusApi');
        el.innerText = text;
        el.style.backgroundColor = bg;
    }

    function showNotification(text, success = true) {
        const box = document.getElementById('alertBox');
        box.style.display = 'block';
        box.className = 'alert ' + (success ? 'alert-sukses' : 'alert-error');
        box.innerHTML = (success ? '<b>Berhasil:</b> ' : '<b>Peringatan:</b> ') + text;
    }

    // 1. Mengambil data buku dari GET /api/buku
    async function muatKatalogBuku() {
        try {
            const res = await fetch(API_BUKU_URL, {
                headers: { 'Accept': 'application/json' }
            });
            const json = await res.json();
            const tbody = document.getElementById('tabelBukuBody');
            tbody.innerHTML = '';

            const list = json.data || [];
            document.getElementById('totalJudul').innerText = list.length;
            document.getElementById('totalStok').innerText = json.total_stok || list.reduce((acc, curr) => acc + parseInt(curr.stok || 0), 0);

            if (list.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" style="text-align: center; padding: 25px; color: #94a3b8;">Belum ada koleksi buku di database. Silakan tambahkan menggunakan form di atas.</td></tr>';
                setStatus('REST API: 200 OK (0 Buku)', '#059669');
                return;
            }

            setStatus(`REST API: 200 OK (${list.length} Buku)`, '#059669');

            list.forEach((buku, index) => {
                tbody.innerHTML += `
                    <tr>
                        <td>${index + 1}</td>
                        <td><strong style="color: #0284c7;">${buku.kode_buku}</strong></td>
                        <td><b>${buku.judul_buku}</b></td>
                        <td>${buku.penulis}</td>
                        <td><span style="font-weight: 700; color: ${buku.stok > 0 ? '#15803d' : '#b91c1c'};">${buku.stok} Eks</span></td>
                        <td>
                            <button class="btn-hapus" onclick="hapusBukuApi(${buku.id})">Hapus</button>
                        </td>
                    </tr>
                `;
            });
        } catch (err) {
            setStatus('REST API: ERROR / OFFLINE', '#ef4444');
            console.error(err);
        }
    }

    // 2. Mengirim data buku baru ke POST /api/buku
    document.getElementById('formTambahBuku').addEventListener('submit', async function(e) {
        e.preventDefault();
        const payload = {
            kode_buku: document.getElementById('kode_buku').value,
            judul_buku: document.getElementById('judul_buku').value,
            penulis: document.getElementById('penulis').value,
            stok: document.getElementById('stok').value
        };

        try {
            const res = await fetch(API_BUKU_URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            });

            const json = await res.json();

            if (res.status === 201) {
                showNotification(json.pesan, true);
                this.reset();
                muatKatalogBuku();
            } else {
                let errText = json.pesan || 'Gagal menyimpan buku!';
                if (json.errors) {
                    const detail = Object.values(json.errors).flat().join('<br>• ');
                    errText += '<br>• ' + detail;
                }
                showNotification(errText, false);
            }
        } catch (err) {
            showNotification('Gagal terhubung ke endpoint API server.', false);
        }
    });

    // 3. Menghapus buku via DELETE /api/buku/{id}
    async function hapusBukuApi(id) {
        if (!confirm('Hapus buku ini dari server RESTful API?')) return;

        try {
            const res = await fetch(`${API_BUKU_URL}/${id}`, {
                method: 'DELETE',
                headers: { 'Accept': 'application/json' }
            });

            const json = await res.json();
            showNotification(json.pesan, res.ok);
            muatKatalogBuku();
        } catch (err) {
            showNotification('Gagal menghapus buku dari server API.', false);
        }
    }

    // Panggil saat halaman dimuat
    muatKatalogBuku();
</script>
</body>
</html>
