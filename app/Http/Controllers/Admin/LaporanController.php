<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Polisi; // PENTING: Memastikan Model Polisi diimpor
use App\Notifications\AdminUpdateLaporan;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    /**
     * Menampilkan Dashboard Admin.
     */
    public function dashboard(Request $request)
    {
        // Ambil 3 laporan terbaru
        $laporan = Laporan::latest()->take(3)->get();

        return view('admin.dashboard', [
            'laporan' => $laporan,
        ]);
    }

    public function adminindex(Request $request)
    {
        // 1. Ambil daftar Kategori Unik
        $kategoriList = Laporan::select('kategori')->distinct()->pluck('kategori');

        // 2. Ambil daftar Tahun Unik dari kolom TGL_LAPOR (Diurutkan dari terbaru)
        $years = Laporan::select(DB::raw('YEAR(tgl_lapor) as year'))
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        // 3. Set Nilai Default dan Nilai yang Dipilih
        $selectedKategori = $request->kategori ?? 'semua';
        $selectedStatus = $request->status ?? 'semua';
        $selectedYear = $request->input('year', 'semua');
        $selectedMonth = $request->input('month', 'semua');

        // 4. Query Dasar Laporan
        $laporanQuery = Laporan::with('user')->latest();

        // 5. Filter Kategori
        if ($selectedKategori !== 'semua') {
            $laporanQuery->where('kategori', $selectedKategori);
        }

        // 6. Filter Status
        if ($selectedStatus !== 'semua') {
            $laporanQuery->where('status', $selectedStatus);
        }

        // 7. Filter Waktu (Tahun dan Bulan)

        // A. Filter TAHUN (Jika dipilih)
        if ($selectedYear !== 'semua') {
            $laporanQuery->whereYear('tgl_lapor', $selectedYear);
        }

        // B. Filter BULAN (Jika dipilih, baik filter tahun aktif maupun tidak)
        if ($selectedMonth !== 'semua') {
            $laporanQuery->whereMonth('tgl_lapor', $selectedMonth);
        }

        // 8. Eksekusi Query
        $laporan = $laporanQuery->get();

        // Kirim semua data yang diperlukan ke view
        return view('admin.laporan.index', [
            'laporan' => $laporan,
            'kategoriList' => $kategoriList,
            'selectedKategori' => $selectedKategori,
            'selectedStatus' => $selectedStatus,
            'years' => $years,             // Daftar tahun unik
            'selectedYear' => $selectedYear,
            'selectedMonth' => $selectedMonth,
        ]);
    }

    /**
     * Menampilkan detail laporan tertentu
     */
    public function show($id)
    {
        $laporan = Laporan::with('user', 'polisi')->findOrFail($id);
        $polisis = Polisi::all(); // <--- VARIABEL INI YANG HILANG!

        // Mengirimkan $laporan dan $polisis
        return view('admin.laporan.show', compact('laporan', 'polisis'));
    }

    /**
     * Menampilkan form edit laporan
     */
    public function edit($id)
    {
        $laporan = Laporan::findOrFail($id);
        return view('admin.laporan.edit', compact('laporan'));
    }

    /**
     * Update laporan
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_laporan' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'status' => 'required|in:pending,proses,selesai',
        ]);

        $laporan = Laporan::findOrFail($id);

        $laporan->update([
            'judul_laporan' => $request->judul_laporan,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'status' => strtolower($request->status), // Simpan selalu dalam huruf kecil
        ]);

        $laporan = Laporan::findOrFail($id);
        $laporan->status = strtolower($request->status);
        $laporan->save();

        // Kirim notifikasi ke user pembuat laporan
        $user = $laporan->user;
        if ($user) {
            // Asumsi: AdminUpdateLaporan adalah class Notifikasi yang valid
            // $user->notify(new AdminUpdateLaporan($laporan));
        }

        return redirect()->route('admin.laporan.index')
            ->with('success', 'Laporan berhasil diperbarui.');
    }

    /**
     * Hapus laporan
     */
    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->delete();

        return redirect()->route('admin.laporan.index')
            ->with('success', 'Laporan berhasil dihapus.');
    }

    public function assignForm($id)
    {
        $laporan = Laporan::with('user', 'polisi')->findOrFail($id);
        $polisis = Polisi::all();
        return view('admin.laporan.assign', compact('laporan', 'polisis'));
    }

    public function assignStore(Request $request, $id)
    {
        $request->validate([
            'polisi_id' => 'required|exists:polisis,id',
        ]);

        $laporan = Laporan::findOrFail($id);
        $laporan->update(['polisi_id' => $request->polisi_id, 'status' => 'proses']);

        return redirect()->route('admin.laporan.index')->with('success', 'Laporan berhasil diberikan kepada polisi.');
    }
}
