<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Buku;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class PerpusAuthController extends Controller
{
    // 1. Menampilkan Form Registrasi Perpustakaan
    public function register()
    {
        return view('perpus_register');
    }

    // 2. Memproses Simpan Registrasi Perpustakaan
    public function simpanRegister(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:100',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'role' => 'required|in:pustakawan,anggota'
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            Log::info("Akun perpustakaan baru berhasil didaftarkan: {$request->email} sebagai {$request->role}");

            return redirect('/perpus/login')->with('sukses', 'Pendaftaran akun E-Perpustakaan berhasil! Silakan masuk.');
        } catch (\Illuminate\Validation\ValidationException $ve) {
            throw $ve;
        } catch (\Throwable $e) {
            Log::error("Gagal melakukan registrasi perpustakaan: " . $e->getMessage());
            return back()->withErrors(['email' => 'Terjadi kesalahan sistem: ' . $e->getMessage()])->withInput();
        }
    }

    // 3. Menampilkan Form Login Perpustakaan
    public function login()
    {
        return view('perpus_login');
    }

    // 4. Memeriksa Kredensial Login Perpustakaan
    public function cekLogin(Request $request)
    {
        $kredensial = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($kredensial)) {
            $request->session()->regenerate();
            Log::info("Pengguna perpustakaan berhasil login: " . Auth::user()->email . " (" . Auth::user()->role . ")");
            return redirect('/perpus/dashboard');
        }

        Log::warning("Gagal login perpustakaan untuk email: " . $request->email);

        return back()->withErrors([
            'email' => 'Email atau password perpustakaan yang Anda masukkan salah!',
        ])->onlyInput('email');
    }

    // 5. Menampilkan Halaman Dashboard Perpustakaan
    public function dashboard()
    {
        return view('perpus_dashboard');
    }

    // 6. Logout Perpustakaan
    public function logout(Request $request)
    {
        $userEmail = Auth::user()?->email;
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Log::info("Pengguna perpustakaan logout: " . $userEmail);

        return redirect('/perpus/login')->with('sukses', 'Anda telah berhasil logout dari Portal E-Perpustakaan.');
    }

    // 7. Halaman Kelola Buku (Khusus Pustakawan)
    public function kelolaBuku()
    {
        return view('perpus_kelola_buku');
    }

    // 8. Halaman Pinjam Buku (Khusus Anggota)
    public function pinjamBuku()
    {
        return view('perpus_pinjam_buku');
    }
}
