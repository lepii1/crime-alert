<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;

class PolisiDashboardController extends Controller
{
    public function index()
    {
        $polisi = Auth::guard('polisi')->user();

        // Polisi melihat semua laporan
        $laporans = Laporan::latest()->get();

        return view('polisi.dashboard', compact('polisi', 'laporans'));
    }

    public function show($id)
    {
        $laporan = Laporan::findOrFail($id);
        return view('polisi.detail', compact('laporan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,proses,selesai'
        ]);

        $laporan = Laporan::findOrFail($id);
        $laporan->status = $request->status;
        $laporan->save();

        // Nanti bisa ditambah notifikasi admin & user di sini

        return redirect()->route('polisi.dashboard')->with('success', 'Status laporan berhasil diperbarui.');
    }

    public function profil()
    {
        $polisi = Auth::guard('polisi')->user();
        return view('polisi.profil', compact('polisi'));
    }

    public function edit()
    {
        $polisi = Auth::guard('polisi')->user(); // <-- Variabel diubah menjadi $user
        return view('polisi.edit', compact('polisi'));
    }

    public function update(Request $request)
    {
        $polisi = auth('polisi')->user();

        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'no_hp' => 'nullable',
            'jabatan' => 'nullable',
            'foto_profil' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/polisi', $filename);
            $polisi->foto_profil = $filename;
        }

        $polisi->update($request->only('nama', 'email', 'telepon', 'jabatan'));

        return redirect()->route('polisi.profil')
            ->with('success', 'Profil berhasil diperbarui!');
    }
}
