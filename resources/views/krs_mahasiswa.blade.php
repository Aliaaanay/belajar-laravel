<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Pengisian KRS Mahasiswa</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f0f4f8; margin: 0; padding: 40px 20px; color: #1e293b; }
        .container { max-width: 850px; margin: auto; background: white; padding: 35px; border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,0.08); border-top: 5px solid #2563eb; }
        h1 { margin-top: 0; color: #1e3a8a; font-size: 26px; border-bottom: 2px solid #e2e8f0; padding-bottom: 12px; }
        .lead { font-size: 15px; color: #475569; margin: 10px 0 20px 0; }
        .user-badge { display: inline-flex; align-items: center; gap: 8px; background: #eff6ff; color: #1d4ed8; padding: 6px 14px; border-radius: 20px; font-size: 13px; font-weight: 600; margin-bottom: 20px; }
        .role-pill { background: #22c55e; color: white; padding: 2px 8px; border-radius: 10px; font-size: 11px; text-transform: uppercase; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; font-size: 14px; }
        th, td { padding: 12px 14px; text-align: left; border-bottom: 1px solid #e2e8f0; }
        th { background: #1e3a8a; color: white; font-weight: 600; font-size: 12px; text-transform: uppercase; }
        tr:hover { background-color: #f8fafc; }
        .badge-wajib { background: #dcfce7; color: #15803d; padding: 3px 8px; border-radius: 6px; font-size: 11px; font-weight: 700; }
        .badge-peminatan { background: #ffedd5; color: #c2410c; padding: 3px 8px; border-radius: 6px; font-size: 11px; font-weight: 700; }
        .sks-summary { background: #f8fafc; border: 2px dashed #cbd5e1; border-radius: 8px; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; margin-top: 20px; font-size: 15px; }
        .btn-simpan { background: #2563eb; color: white; border: none; padding: 10px 22px; border-radius: 6px; font-weight: 700; cursor: pointer; font-size: 14px; }
        .btn-simpan:hover { background: #1d4ed8; }
        .btn-kembali { display: inline-block; margin-top: 25px; color: #0284c7; text-decoration: none; font-weight: 600; font-size: 14px; }
        .btn-kembali:hover { text-decoration: underline; }
        .alert-success { background: #dcfce7; color: #15803d; border-left: 4px solid #16a34a; padding: 12px 16px; border-radius: 6px; margin-bottom: 20px; font-size: 14px; display: none; }
    </style>
</head>
<body>
<div class="container">
    <h1>Halaman Pengisian KRS Mahasiswa</h1>
    <p class="lead">Silakan pilih mata kuliah sesuai peminatan kamu semester ini.</p>

    <div class="user-badge">
        <span>Mahasiswa Aktif: <b>{{ Auth::user()->name }}</b> ({{ Auth::user()->email }})</span>
        <span class="role-pill">{{ Auth::user()->role }}</span>
    </div>

    <div id="pesanSukses" class="alert-success">
        ✓ <b>KRS Berhasil Disimpan!</b> Rencana studi Anda telah diajukan ke Dosen Pembimbing Akademik.
    </div>

    <form id="formKrs" onsubmit="event.preventDefault(); document.getElementById('pesanSukses').style.display = 'block'; window.scrollTo({top: 0, behavior: 'smooth'});">
        <table>
            <thead>
                <tr>
                    <th style="width: 50px; text-align: center;">Pilih</th>
                    <th>Kode</th>
                    <th>Nama Mata Kuliah</th>
                    <th>Beban SKS</th>
                    <th>Semester</th>
                    <th>Kategori</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;"><input type="checkbox" name="matkul[]" value="4" checked onchange="hitungTotalSks()"></td>
                    <td><b>IF201</b></td>
                    <td>Pemrograman Web Lanjut</td>
                    <td>4 SKS</td>
                    <td>Semester 4</td>
                    <td><span class="badge-wajib">Wajib</span></td>
                </tr>
                <tr>
                    <td style="text-align: center;"><input type="checkbox" name="matkul[]" value="3" checked onchange="hitungTotalSks()"></td>
                    <td><b>IF202</b></td>
                    <td>Kecerdasan Buatan (Artificial Intelligence)</td>
                    <td>3 SKS</td>
                    <td>Semester 4</td>
                    <td><span class="badge-wajib">Wajib</span></td>
                </tr>
                <tr>
                    <td style="text-align: center;"><input type="checkbox" name="matkul[]" value="3" onchange="hitungTotalSks()"></td>
                    <td><b>IF305</b></td>
                    <td>Pengembangan Game & Teknologi Imersif (AR/VR)</td>
                    <td>3 SKS</td>
                    <td>Semester 6</td>
                    <td><span class="badge-peminatan">Peminatan</span></td>
                </tr>
                <tr>
                    <td style="text-align: center;"><input type="checkbox" name="matkul[]" value="2" checked onchange="hitungTotalSks()"></td>
                    <td><b>IF308</b></td>
                    <td>Keamanan Jaringan & Etika Profesi IT</td>
                    <td>2 SKS</td>
                    <td>Semester 6</td>
                    <td><span class="badge-wajib">Wajib</span></td>
                </tr>
            </tbody>
        </table>

        <div class="sks-summary">
            <div>
                Total SKS Terpilih: <strong id="totalSks" style="color: #2563eb; font-size: 18px;">9 SKS</strong> (Batas Maksimal: 24 SKS)
            </div>
            <button type="submit" class="btn-simpan">Ajukan KRS Semester Ini</button>
        </div>
    </form>

    <div style="margin-top: 25px;">
        <a href="{{ url('/dashboard') }}" class="btn-kembali">&laquo; Kembali ke Dashboard</a>
    </div>
</div>

<script>
    function hitungTotalSks() {
        const checkboxes = document.querySelectorAll('input[name="matkul[]"]:checked');
        let total = 0;
        checkboxes.forEach(cb => {
            total += parseInt(cb.value);
        });
        document.getElementById('totalSks').innerText = total + ' SKS';
    }
    hitungTotalSks();
</script>
</body>
</html>
