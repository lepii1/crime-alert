<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Polisi;
use App\Notifications\AdminUpdateLaporan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanController extends Controller
{
    /**
     * Menampilkan Dashboard Admin.
     * Mengambil data untuk chart tren 12 bulan dan laporan terbaru.
     */
    public function dashboard(Request $request)
    {
        // 1. Ambil 3 laporan terbaru untuk Recent Reports
        $laporan = Laporan::latest()->take(3)->get();

        // 2. Data Trend Bulanan (12 bulan terakhir)
        $monthlyData = Laporan::select(
            DB::raw('COUNT(id) as count'),
            DB::raw("DATE_FORMAT(tgl_lapor, '%Y-%m') as month_year"),
            DB::raw("DATE_FORMAT(tgl_lapor, '%b') as month_name") // Hanya bulan singkat untuk dashboard
        )
            ->where('tgl_lapor', '>=', Carbon::now()->subMonths(11)->startOfMonth())
            ->groupBy('month_year', 'month_name')
            ->orderBy('month_year', 'asc')
            ->get();

        $monthlyChartData = [
            'labels' => $monthlyData->pluck('month_name'),
            'data' => $monthlyData->pluck('count'),
        ];

        // 3. AMBIL 3 LAPORAN TERBARU DENGAN STATUS PENDING UNTUK KARTU ALERTS
        $pendingReports = Laporan::where('status', 'pending')
            ->latest('tgl_lapor')
            ->take(4)
            ->get();

        return view('admin.dashboard', [
            'laporan' => $laporan,
            'monthlyChartData' => $monthlyChartData,
            'pendingReports' => $pendingReports, // <-- DATA BARU DIKIRIM
        ]);
    }

    public function reports()
    {
        // ... (Metode reports tetap) ...
        $monthlyData = Laporan::select(
            DB::raw('COUNT(id) as count'),
            DB::raw("DATE_FORMAT(tgl_lapor, '%Y-%m') as month_year"),
            DB::raw("DATE_FORMAT(tgl_lapor, '%b %Y') as month_name")
        )
            ->where('tgl_lapor', '>=', Carbon::now()->subMonths(11)->startOfMonth())
            ->groupBy('month_year', 'month_name')
            ->orderBy('month_year', 'asc')
            ->get();

        $monthlyChartData = [
            'labels' => $monthlyData->pluck('month_name'),
            'data' => $monthlyData->pluck('count'),
        ];

        $categoryData = Laporan::select('kategori', DB::raw('COUNT(id) as count'))
            ->groupBy('kategori')
            ->orderBy('count', 'desc')
            ->get();

        $categoryChartData = [
            'labels' => $categoryData->pluck('kategori'),
            'data' => $categoryData->pluck('count'),
        ];

        $statusData = Laporan::select('status', DB::raw('COUNT(id) as count'))
            ->groupBy('status')
            ->get();

        $statusChartData = [
            'labels' => $statusData->pluck('status')->map(fn($s) => ucfirst($s)),
            'data' => $statusData->pluck('count'),
        ];

        return view('admin.laporan.reports', compact('monthlyChartData', 'categoryChartData', 'statusChartData'));
    }

    public function adminIndex(Request $request)
    {
        // ... (metode adminIndex tetap) ...
        $kategoriList = Laporan::select('kategori')->distinct()->pluck('kategori');

        $laporanQuery = Laporan::with('user')->latest();

        // Filter Kategori
        if ($request->filled('kategori') && $request->kategori !== 'semua') {
            $laporanQuery->where('kategori', $request->kategori);
        }

        // Filter Status
        if ($request->filled('status')) {
            $laporanQuery->where('status', $request->status);
        }

        // Filter Tahun dan Bulan (berbasis tgl_lapor)
        $selectedYear = $request->input('year');
        $selectedMonth = $request->input('month');

        if ($selectedYear && $selectedYear !== 'semua') {
            $laporanQuery->whereYear('tgl_lapor', $selectedYear);
        }

        if ($selectedMonth && $selectedMonth !== 'semua') {
            $laporanQuery->whereMonth('tgl_lapor', $selectedMonth);
        }

        $laporan = $laporanQuery->get();

        $years = Laporan::select(DB::raw('YEAR(tgl_lapor) as year'))
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        return view('admin.laporan.index', [
            'laporan' => $laporan,
            'kategoriList' => $kategoriList,
            'selectedKategori' => $request->kategori ?? 'semua',
            'selectedStatus' => $request->status,
            'years' => $years,
            'selectedYear' => $selectedYear ?? 'semua',
            'selectedMonth' => $selectedMonth ?? 'semua',
            'months' => $months,
        ]);
    }

    /**
     * Menampilkan detail laporan tertentu
     */
    public function show($id)
    {
        $laporan = Laporan::with('user', 'polisi')->findOrFail($id);
        $polisis = Polisi::all();

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
            'status' => $request->status,
        ]);

        return redirect()->route('admin.laporan.index')
            ->with('success', 'Laporan berhasil diperbarui.');
    }

    /**
     * Hapus laporan
     */
    public function destroy($id)
    {
        Laporan::destroy($id);
        return redirect()->route('admin.laporan.index')
            ->with('success', 'Laporan berhasil dihapus!');
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
        $laporan->update([
            'polisi_id' => $request->polisi_id,
            'status' => 'proses'
        ]);

        return redirect()->route('admin.laporan.show', $laporan->id)
            ->with('success', 'Laporan berhasil ditugaskan kepada polisi dan status diubah menjadi PROSES.');
    }
}
