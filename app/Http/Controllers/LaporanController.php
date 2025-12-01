<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    /**
     * Menampilkan dashboard utama untuk pengguna (user).
     * Fokus pada laporan yang dibuat oleh pengguna yang sedang login.
     */
    public function dashboard()
    {
        // Ambil semua laporan yang dibuat oleh pengguna yang sedang login
        $laporans = Laporan::where('user_id', Auth::id())
            ->latest()
            ->get();

        // Hitung status ringkasan
        $summary = [
            'total' => $laporans->count(),
            'pending' => $laporans->where('status', 'pending')->count(),
            'proses' => $laporans->where('status', 'proses')->count(),
            'selesai' => $laporans->where('status', 'selesai')->count(),
        ];

        return view('user.dashboard', compact('laporans', 'summary'));
    }

    // Menampilkan form laporan
    public function create()
    {
        return view('laporan.create');
    }

    // Simpan laporan baru
    public function store(Request $request)
    {
        $request->validate([
            'judul_laporan' => 'required|string',
            'deskripsi' => 'required|string',
            'kategori' => 'required|string',
            'tgl_lapor' => 'required|date',
            'ip_terlapor' => 'nullable|string',
            'confirm' => 'required',
        ]);

        Laporan::create([
            'user_id' => auth()->id(),
            'judul_laporan' => $request->judul_laporan,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'tgl_lapor' => $request->tgl_lapor,
            'ip_terlapor' => $request->ip_terlapor,
            'status' => 'pending',
        ]);

        // Redirect ke dashboard user + flash message sukses
        return redirect()
            ->route('user.dashboard')
            ->with('success', 'Laporan berhasil dikirim dan sedang diproses!');
    }

    /**
     * Menampilkan detail laporan pengguna (USER).
     */
    public function show($id)
    {
        // PENTING: Mengambil laporan dengan relasi polisi, dan HANYA milik user yang sedang login
        $laporan = Laporan::with('polisi')
            ->where('user_id', Auth::id())
            ->findOrFail($id); // Jika laporan tidak ditemukan/bukan milik user, akan throw 404

        // Menggunakan view 'laporan.show' sesuai struktur folder Anda
        return view('laporan.show', compact('laporan'));
    }
}
