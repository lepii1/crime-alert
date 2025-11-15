<?php
//////
//////namespace App\Http\Controllers\Admin;
//////
//////use App\Http\Controllers\Controller;
//////use App\Models\Laporan;
//////use Illuminate\Http\Request;
//////
//////class LaporanController extends Controller
//////{
//////    // Tampilkan semua laporan
//////    public function index()
//////    {
//////        $laporan = Laporan::with('user')->latest()->get();
//////        return view('admin.laporan.index', compact('laporan'));
//////    }
//////
//////    // Detail laporan
//////    public function show($id)
//////    {
//////        $laporan = Laporan::with('user')->findOrFail($id);
//////        return view('admin.laporan.show', compact('laporan'));
//////    }
//////
//////    // Form edit laporan (misalnya ubah status)
//////    public function edit($id)
//////    {
//////        $laporan = Laporan::findOrFail($id);
//////        return view('admin.laporan.edit', compact('laporan'));
//////    }
//////
//////    // Proses update laporan
//////    public function update(Request $request, $id)
//////    {
//////        $laporan = Laporan::findOrFail($id);
//////        $laporan->update($request->only('status'));
//////        return redirect()->route('admin.laporan.index')->with('success', 'Status laporan diperbarui!');
//////    }
//////
//////    // Hapus laporan
//////    public function destroy($id)
//////    {
//////        Laporan::destroy($id);
//////        return redirect()->route('admin.laporan.index')->with('success', 'Laporan berhasil dihapus!');
//////    }
//////}
////
////
////namespace App\Http\Controllers\Admin;
////
////use App\Http\Controllers\Controller;
////use Illuminate\Http\Request;
////use App\Models\Laporan;
////
////// pastikan model Laporan sudah ada
////
////class LaporanController extends Controller
////{
////    // ✅ Method yang diminta oleh route /admin/laporan
////    public function adminIndex()
////    {
////        $laporan = Laporan::latest()->get(); // ambil semua laporan
////        return view('admin.laporan.index', compact('laporan'));
////    }
////
////    public function show($id)
////    {
////        $laporan = Laporan::findOrFail($id);
////        return view('admin.laporan.show', compact('laporan'));
////    }
////
////    public function edit($id)
////    {
////        $laporan = Laporan::findOrFail($id);
////        return view('admin.laporan.edit', compact('laporan'));
////    }
////
////    public function update(Request $request, $id)
////    {
////        $request->validate([
////            'status' => 'required|string|in:pending,proses,selesai',
////        ]);
////
////        $laporan = Laporan::findOrFail($id);
////        $laporan->status = (string) $request->input('status');
////        $laporan->save();
////
////        return redirect()
////            ->route('admin.laporan.index')
////            ->with('success', 'Status laporan diperbarui!');
////    }
////
////    public function destroy($id)
////    {
////        $laporan = Laporan::findOrFail($id);
////        $laporan->delete();
////        return redirect()->route('admin.laporan.index')->with('success', 'Laporan berhasil dihapus!');
////    }
////}
//
//
//namespace App\Http\Controllers\Admin;
//
//use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
//use App\Models\Laporan;
//
//
//class LaporanController extends Controller
//{
//    public function adminindex()
//    {
//        $laporan = Laporan::latest()->get();
//        return view('admin.laporan.index', compact('laporan'));
//    }
//
//    public function show($id)
//    {
//        $laporan = Laporan::findOrFail($id);
//        return view('admin.laporan.show', compact('laporan'));
//    }
//
//    public function edit($id)
//    {
//        $laporan = Laporan::findOrFail($id);
//        return view('admin.laporan.edit', compact('laporan'));
//    }
//
//    public function update(Request $request, $id)
//    {
//        // 1. Validasi semua field yang dikirim dari form
//        $request->validate([
//            'judul_laporan' => 'required|string|max:255',
//            'deskripsi' => 'required|string',
//            'kategori' => 'required|string|max:255',
//            'status' => 'required|string|in:pending,proses,selesai',
//        ]);
//
//        $laporan = Laporan::findOrFail($id);
//
//        // 2. Gunakan $request->only() untuk mengambil semua field yang valid
//        $laporan->update($request->only(['judul_laporan', 'deskripsi','kategori', 'status']));
//
//        return redirect()
//            ->route('admin.laporan.index')
//            ->with('success', 'Laporan berhasil diperbarui!');
//    }
//
//    public function destroy($id)
//    {
//        $laporan = Laporan::findOrFail($id);
//        $laporan->delete();
//        return redirect()->route('admin.laporan.index')->with('success', 'Laporan berhasil dihapus!');
//    }
//
//}

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Polisi;

class LaporanController extends Controller
{
    /**
     * Menampilkan daftar laporan dengan filter kategori & status
     */
    public function adminindex(Request $request)
    {
        // Ambil daftar kategori unik dari kolom 'kategori'
        $kategoriList = Laporan::select('kategori')->distinct()->pluck('kategori');

        // Query dasar laporan
        $laporanQuery = Laporan::with('user')->latest();

        // Filter kategori jika ada di query string (contoh: ?kategori=Pencurian)
        if ($request->filled('kategori') && $request->kategori !== 'semua') {
            $laporanQuery->where('kategori', $request->kategori);
        }

        // Filter status jika ada di query string (contoh: ?status=selesai)
        if ($request->filled('status')) {
            $laporanQuery->where('status', $request->status);
        }

        // Eksekusi query
        $laporan = $laporanQuery->get();

        // Kirim data ke view
        return view('admin.laporan.index', [
            'laporan' => $laporan,
            'kategoriList' => $kategoriList,
            'selectedKategori' => $request->kategori ?? 'semua',
            'selectedStatus' => $request->status,
        ]);
    }

    /**
     * Menampilkan detail laporan tertentu
     */
    public function show($id)
    {
        $laporan = Laporan::with('user')->findOrFail($id);
        return view('admin.laporan.show', compact('laporan'));
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

        // Pastikan kolom yang boleh di-update diset di model Laporan ($fillable)
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
