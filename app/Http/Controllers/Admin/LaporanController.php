<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Polisi;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf; // Pastikan package ini sudah diinstal

class LaporanController extends Controller
{
    /**
     * Metode eksisting: Dashboard, Index, Show, Edit, dll tetap dipertahankan.
     */

    public function dashboard()
    {
        $laporan = Laporan::latest()->take(3)->get();
        $monthlyData = Laporan::select(
            DB::raw('COUNT(id) as count'),
            DB::raw("DATE_FORMAT(tgl_lapor, '%Y-%m') as month_key"),
            DB::raw("DATE_FORMAT(tgl_lapor, '%b') as month_name")
        )
            ->where('tgl_lapor', '>=', Carbon::now()->subMonths(11)->startOfMonth())
            ->groupBy('month_key', 'month_name')
            ->orderBy('month_key', 'asc')
            ->get();

        $monthlyChartData = [
            'labels' => $monthlyData->pluck('month_name')->toArray(),
            'data' => $monthlyData->pluck('count')->toArray(),
        ];

        $pendingReports = Laporan::where('status', 'pending')->latest()->take(4)->get();

        return view('admin.dashboard', compact('laporan', 'monthlyChartData', 'pendingReports'));
    }

    public function reports(Request $request)
    {
        $selectedYear = $request->get('year', date('Y'));
        $monthlyRaw = Laporan::select(
            DB::raw('MONTH(tgl_lapor) as month_num'),
            DB::raw('COUNT(id) as count')
        )
            ->whereYear('tgl_lapor', $selectedYear)
            ->groupBy(DB::raw('MONTH(tgl_lapor)'))
            ->orderBy('month_num', 'asc')
            ->get()
            ->keyBy('month_num');

        $allMonths = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $monthlyCounts = [];
        foreach (range(1, 12) as $m) {
            $monthlyCounts[] = $monthlyRaw->has($m) ? $monthlyRaw->get($m)->count : 0;
        }

        $monthlyChartData = ['labels' => $allMonths, 'data' => $monthlyCounts];

        $yearlyRaw = Laporan::select(DB::raw('YEAR(tgl_lapor) as year_label'), DB::raw('COUNT(id) as count'))
            ->groupBy(DB::raw('YEAR(tgl_lapor)'))->orderBy('year_label', 'asc')->get();
        $yearlyChartData = ['labels' => $yearlyRaw->pluck('year_label')->toArray(), 'data' => $yearlyRaw->pluck('count')->toArray()];

        $categoryRaw = Laporan::select('kategori', DB::raw('COUNT(id) as count'))
            ->groupBy('kategori')->orderBy('count', 'desc')->get();
        $categoryChartData = ['labels' => $categoryRaw->pluck('kategori')->toArray(), 'data' => $categoryRaw->pluck('count')->toArray()];

        $statusRaw = Laporan::select('status', DB::raw('COUNT(id) as count'))->groupBy('status')->get();
        $statusChartData = ['labels' => $statusRaw->pluck('status')->map(fn($s) => ucfirst($s))->toArray(), 'data' => $statusRaw->pluck('count')->toArray()];

        $availableYears = Laporan::select(DB::raw('YEAR(tgl_lapor) as year'))->distinct()->orderBy('year', 'desc')->pluck('year');
        if ($availableYears->isEmpty()) $availableYears = collect([date('Y')]);

        return view('admin.laporan.reports', compact('monthlyChartData', 'categoryChartData', 'statusChartData', 'yearlyChartData', 'availableYears'));
    }

    /**
     * BARU: Fungsi untuk Ekspor PDF Berdasarkan Filter
     */
    public function exportPdf(Request $request)
    {
        $year = $request->get('year', date('Y'));
        $month = $request->get('month'); // Opsional

        $query = Laporan::with(['user', 'polisi'])->whereYear('tgl_lapor', $year);

        if ($month && $month !== 'semua') {
            $query->whereMonth('tgl_lapor', $month);
        }

        $laporans = $query->orderBy('tgl_lapor', 'desc')->get();

        // Statistik Ringkas untuk PDF
        $stats = [
            'total' => $laporans->count(),
            'selesai' => $laporans->where('status', 'selesai')->count(),
            'proses' => $laporans->where('status', 'proses')->count(),
            'pending' => $laporans->where('status', 'pending')->count(),
            'periode' => ($month && $month !== 'semua')
                ? Carbon::createFromDate($year, $month, 1)->format('F Y')
                : "Tahun " . $year
        ];

        $pdf = Pdf::loadView('admin.laporan.exportPdf', compact('laporans', 'stats'));

        $filename = 'Laporan_Kejahatan_' . str_replace(' ', '_', $stats['periode']) . '.pdf';
        return $pdf->download($filename);
    }

    public function adminIndex(Request $request)
    {
        $kategoriList = Laporan::select('kategori')->distinct()->pluck('kategori');
        $laporanQuery = Laporan::with('user')->latest();
        if ($request->filled('kategori') && $request->kategori !== 'semua') $laporanQuery->where('kategori', $request->kategori);
        if ($request->filled('status') && $request->status !== 'semua') $laporanQuery->where('status', $request->status);
        $selectedYear = $request->input('year');
        $selectedMonth = $request->input('month');
        if ($selectedYear && $selectedYear !== 'semua') $laporanQuery->whereYear('tgl_lapor', $selectedYear);
        if ($selectedMonth && $selectedMonth !== 'semua') $laporanQuery->whereMonth('tgl_lapor', $selectedMonth);
        $laporan = $laporanQuery->get();
        $years = Laporan::select(DB::raw('YEAR(tgl_lapor) as year'))->distinct()->orderBy('year', 'desc')->pluck('year');
        $months = [1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'];
        return view('admin.laporan.index', ['laporan' => $laporan, 'kategoriList' => $kategoriList, 'selectedKategori' => $request->kategori ?? 'semua', 'selectedStatus' => $request->status ?? 'semua', 'years' => $years, 'selectedYear' => $selectedYear ?? 'semua', 'selectedMonth' => $selectedMonth ?? 'semua', 'months' => $months]);
    }

    public function show($id)
    {
        $laporan = Laporan::with(['user', 'polisi'])->findOrFail($id);
        $polisis = Polisi::all();
        return view('admin.laporan.show', compact('laporan', 'polisis'));
    }

    public function edit($id)
    {
        $laporan = Laporan::findOrFail($id);
        return view('admin.laporan.edit', compact('laporan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['judul_laporan' => 'required|string|max:255', 'deskripsi' => 'required|string', 'kategori' => 'required|string|max:100', 'status' => 'required|in:pending,proses,selesai']);
        $laporan = Laporan::findOrFail($id);
        $laporan->update($request->only(['judul_laporan', 'deskripsi', 'kategori', 'status']));
        return redirect()->route('admin.laporan.index')->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Laporan::destroy($id);
        return redirect()->route('admin.laporan.index')->with('success', 'Laporan berhasil dihapus!');
    }

    public function assignStore(Request $request, $id)
    {
        $request->validate(['polisi_id' => 'required|exists:polisis,id']);
        $laporan = Laporan::findOrFail($id);
        $laporan->update(['polisi_id' => $request->polisi_id, 'status' => 'proses']);
        return redirect()->route('admin.laporan.show', $laporan->id)->with('success', 'Laporan berhasil ditugaskan.');
    }
}
