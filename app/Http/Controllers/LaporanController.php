<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
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

        // 🔹 Redirect ke dashboard user + flash message sukses
        return redirect()
            ->route('user.dashboard') // pastikan route 'dashboard' sudah ada di web.php
            ->with('success', 'Laporan berhasil dikirim dan sedang diproses!');
    }

    public function adminIndex()
    {
        $laporan = Laporan::latest()->get();
        return view('admin.laporan.index', compact('laporan'));
    }

}
