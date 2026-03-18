<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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

    /**
     * Menampilkan form pembuatan laporan manual.
     */
    public function create()
    {
        return view('laporan.create');
    }

    /**
     * Menyimpan laporan manual dengan bukti foto dan koordinat peta.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul_laporan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi_kejadian' => 'required|string',
            'kategori' => 'required|string',
            'tgl_lapor' => 'required|date',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'bukti_kejadian' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_identitas' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'confirm' => 'accepted',
        ]);

        $buktiPath = $request->file('bukti_kejadian')->store('laporan/bukti', 'public');
        $identitasPath = $request->file('foto_identitas')->store('laporan/identitas', 'public');

        Laporan::create([
            'user_id' => Auth::id(),
            'judul_laporan' => $request->judul_laporan,
            'deskripsi' => $request->deskripsi,
            'lokasi_kejadian' => $request->lokasi_kejadian,
            'kategori' => $request->kategori,
            'tgl_lapor' => $request->tgl_lapor,
            'ip_terlapor' => $request->ip(),
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'bukti_kejadian' => $buktiPath,
            'foto_identitas' => $identitasPath,
            'status' => 'pending',
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Laporan berhasil dikirim!');
    }

    /**
     * Menyimpan SOS dari Halaman Welcome (Tanpa Login)
     * Menggunakan penanganan error yang lebih baik untuk debug.
     */
    public function publicSosStore(Request $request)
    {
        try {
            $request->validate([
                'latitude' => 'required',
                'longitude' => 'required'
            ]);

            $laporan = Laporan::create([
                'user_id' => Auth::id() ?? null,
                'judul_laporan' => 'PANIC ALERT (PUBLIC SOS)',
                'deskripsi' => 'Tombol darurat ditekan dari halaman depan aplikasi. Bantuan segera diperlukan!',
                'lokasi_kejadian' => 'Lokasi GPS Otomatis (Public)',
                'kategori' => 'SOS',
                'tgl_lapor' => now(),
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'status' => 'pending',
                'ip_terlapor' => $request->ip(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Sinyal SOS berhasil dikirim ke pusat komando.',
                'data' => $laporan
            ]);

        } catch (\Exception $e) {
            // Log error untuk pengecekan di storage/logs/laravel.log
            Log::error("SOS Error: " . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan pada server: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menyimpan SOS dari Dashboard User (Sudah Login)
     */
    public function sosStore(Request $request)
    {
        try {
            $request->validate([
                'latitude' => 'required',
                'longitude' => 'required'
            ]);

            $laporan = Laporan::create([
                'user_id' => Auth::id(),
                'judul_laporan' => 'EMERGENCY SOS ALERT',
                'deskripsi' => 'Pengguna terverifikasi mengirim sinyal darurat dari dashboard.',
                'lokasi_kejadian' => 'Lokasi GPS Otomatis (Dashboard)',
                'kategori' => 'SOS',
                'tgl_lapor' => now(),
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'status' => 'pending',
                'ip_terlapor' => $request->ip(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Sinyal SOS terkirim!',
                'data' => $laporan
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim SOS: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menampilkan detail laporan.
     */
    public function show($id)
    {
        $laporan = Laporan::with(['user', 'polisi'])->findOrFail($id);
        return view('laporan.show', compact('laporan'));
    }
}
