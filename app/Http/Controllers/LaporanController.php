<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function index()
    {
        $laporans = Laporan::with('user')->latest()->get();
        return view('user.home', compact('laporans'));
    }

    public function dashboard()
    {
        $laporans = Laporan::where('user_id', Auth::id())->latest()->get();

        $summary = [
            'total' => $laporans->count(),
            'pending' => $laporans->where('status', 'pending')->count(),
            'proses' => $laporans->where('status', 'proses')->count(),
            'selesai' => $laporans->where('status', 'selesai')->count(),
        ];

        return view('user.dashboard', compact('laporans', 'summary'));
    }

    public function create()
    {
        return view('laporan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_laporan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|string',
            'tgl_lapor' => 'required|date',
            'bukti_kejadian' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_identitas' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'lokasi_kejadian' => 'required|string',
            'confirm' => 'required',
        ]);

        // Simpan file ke storage public
        $buktiPath = $request->file('bukti_kejadian')->store('laporan/bukti', 'public');
        $identitasPath = $request->file('foto_identitas')->store('laporan/identitas', 'public');

        Laporan::create([
            'user_id' => Auth::id(),
            'judul_laporan' => $request->judul_laporan,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'tgl_lapor' => $request->tgl_lapor,
            'ip_terlapor' => $request->ip_terlapor,
            'bukti_kejadian' => $buktiPath,
            'foto_identitas' => $identitasPath,
            'lokasi_kejadian' => $request->lokasi_kejadian,
            'status' => 'pending',
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Laporan berhasil dikirim!');
    }

    public function show($id)
    {
        $laporan = Laporan::with(['user', 'polisi'])->findOrFail($id);
        return view('laporan.show', compact('laporan'));
    }

    public function profileSettings()
    {
        $user = Auth::user();
        return view('laporan.profile', compact('user'));
    }
}
