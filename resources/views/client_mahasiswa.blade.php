<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Konsumen RESTful API Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f9; padding: 40px; margin: 0; }
        .card { max-width: 850px; margin: auto; background: white; padding: 28px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
        .header-row { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #eee; padding-bottom: 12px; }
        h2 { margin: 0; color: #2c3e50; font-size: 22px; }
        .badge-status { background: #27ae60; color: white; padding: 6px 14px; border-radius: 12px; font-size: 12px; font-weight: bold; }
        .alert { display: none; padding: 10px 14px; border-radius: 5px; font-size: 13px; margin-top: 15px; }
        .alert-sukses { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .form-row { display: flex; gap: 10px; margin-top: 18px; flex-wrap: wrap; }
        .form-row input { flex: 1; min-width: 130px; padding: 9px; border: 1px solid #ccc; border-radius: 5px; }
        .btn-simpan { background: #3498db; color: white; border: none; padding: 9px 18px; border-radius: 5px; font-weight: bold; cursor: pointer; }
        .btn-simpan:hover { background: #2980b9; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 14px; }
        th { background: #2c3e50; color: white; text-align: left; padding: 10px; }
        td { padding: 10px; border-bottom: 1px solid #eee; }
        .btn-hapus { background: #e74c3c; color: white; border: none; padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: bold; cursor: pointer; }
        .btn-hapus:hover { background: #c0392b; }
        .nav-links { margin-top: 25px; text-align: center; }
        .nav-links a { color: #3498db; text-decoration: none; font-size: 13px; margin: 0 10px; }
    </style>
</head>
<body>
<div class="card">
    <div class="header-row">
        <h2>Portal Konsumen RESTful API Mahasiswa</h2>
        <span class="badge-status" id="indikatorApi">API STATUS: 200 OK</span>
    </div>

    <div id="kotakPesan" class="alert"></div>

    <!-- Form Input untuk Mengirim Request POST ke RESTful API -->
    <form id="formApiMahasiswa" class="form-row">
        <input type="text" id="nim" placeholder="NIM (Contoh: 2210114001)" required>
        <input type="text" id="nama" placeholder="Nama Mahasiswa" required>
        <input type="text" id="jurusan" placeholder="Jurusan" required>
        <input type="number" step="0.01" min="0" max="4.00" id="ipk" placeholder="IPK (0-4)" required>
        <button type="submit" class="btn-simpan">+ Simpan ke API</button>
    </form>

    <!-- Tabel yang Diisi Otomatis dari Response JSON GET /api/mahasiswa -->
    <table>
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Jurusan</th>
                <th>IPK</th>
                <th>Aksi API</th>
            </tr>
        </thead>
        <tbody id="tabelBodyApi">
            <tr><td colspan="5">Memuat data dari endpoint /api/mahasiswa...</td></tr>
        </tbody>
    </table>

    <div class="nav-links">
        <a href="{{ url('/api/mahasiswa') }}" target="_blank">Lihat JSON Mentah (/api/mahasiswa)</a> |
        <a href="{{ url('/matakuliah') }}">Ke Katalog Mata Kuliah</a>
    </div>
</div>

<script>
    const API_URL = '/api/mahasiswa';

    function statusBadge(teks, bg) {
        const ind = document.getElementById('indikatorApi');
        ind.innerText = teks;
        ind.style.backgroundColor = bg;
    }

    function tampilkanPesan(teks, sukses = true) {
        const box = document.getElementById('kotakPesan');
        box.style.display = 'block';
        box.className = 'alert ' + (sukses ? 'alert-sukses' : 'alert-error');
        box.innerText = (sukses ? '✓ ' : '✗ ') + teks;
    }

    // 1. Fungsi Mengkonsumsi Endpoint GET /api/mahasiswa
    async function muatDataDariApi() {
        try {
            const res = await fetch(API_URL, {
                headers: { 'Accept': 'application/json' }
            });
            const json = await res.json();
            const tbody = document.getElementById('tabelBodyApi');
            tbody.innerHTML = '';

            if (!json.data || json.data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="5" style="text-align:center; padding: 20px; color: #888;">Belum ada data di dalam API.</td></tr>';
                statusBadge('API STATUS: 200 OK (0 Data)', '#27ae60');
                return;
            }

            statusBadge(`API STATUS: 200 OK (${json.data.length} Data)`, '#27ae60');

            json.data.forEach(mhs => {
                tbody.innerHTML += `
                    <tr>
                        <td><b>${mhs.nim}</b></td>
                        <td>${mhs.nama}</td>
                        <td>${mhs.jurusan}</td>
                        <td><span style="font-weight:bold; color: #27ae60;">${parseFloat(mhs.ipk).toFixed(2)}</span></td>
                        <td>
                            <button class="btn-hapus" onclick="hapusViaApi(${mhs.id})">Hapus (DELETE)</button>
                        </td>
                    </tr>
                `;
            });
        } catch (err) {
            statusBadge('API ERROR / OFFLINE', '#e74c3c');
            console.error(err);
        }
    }

    // 2. Fungsi Mengkonsumsi Endpoint POST /api/mahasiswa
    document.getElementById('formApiMahasiswa').addEventListener('submit', async function(e) {
        e.preventDefault();
        const payload = {
            nim: document.getElementById('nim').value,
            nama: document.getElementById('nama').value,
            jurusan: document.getElementById('jurusan').value,
            ipk: document.getElementById('ipk').value
        };

        try {
            const res = await fetch(API_URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            });

            const json = await res.json();

            if (res.status === 201) {
                tampilkanPesan(json.pesan, true);
                this.reset();
                muatDataDariApi();
            } else {
                let errorMsg = json.pesan || 'Gagal menyimpan data';
                if (json.errors) {
                    const detail = Object.values(json.errors).flat().join(', ');
                    errorMsg += ': ' + detail;
                }
                tampilkanPesan(errorMsg, false);
            }
        } catch (err) {
            tampilkanPesan('Terjadi kesalahan jaringan!', false);
        }
    });

    // 3. Fungsi Mengkonsumsi Endpoint DELETE /api/mahasiswa/{id}
    async function hapusViaApi(id) {
        if (!confirm('Apakah Anda yakin ingin menghapus data mahasiswa ini dari server API?')) return;

        try {
            const res = await fetch(`${API_URL}/${id}`, {
                method: 'DELETE',
                headers: { 'Accept': 'application/json' }
            });

            const json = await res.json();
            tampilkanPesan(json.pesan, res.ok);
            muatDataDariApi();
        } catch (err) {
            tampilkanPesan('Gagal menghapus data melalui API!', false);
        }
    }

    // Panggil fungsi GET saat halaman pertama kali dibuka
    muatDataDariApi();
</script>
</body>
</html>
