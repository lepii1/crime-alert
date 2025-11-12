<?php
////
////namespace App\Http\Controllers\Admin;
////
////use App\Http\Controllers\Controller;
////use App\Models\Laporan;
////use Illuminate\Http\Request;
////
////class LaporanController extends Controller
////{
////    // Tampilkan semua laporan
////    public function index()
////    {
////        $laporan = Laporan::with('user')->latest()->get();
////        return view('admin.laporan.index', compact('laporan'));
////    }
////
////    // Detail laporan
////    public function show($id)
////    {
////        $laporan = Laporan::with('user')->findOrFail($id);
////        return view('admin.laporan.show', compact('laporan'));
////    }
////
////    // Form edit laporan (misalnya ubah status)
////    public function edit($id)
////    {
////        $laporan = Laporan::findOrFail($id);
////        return view('admin.laporan.edit', compact('laporan'));
////    }
////
////    // Proses update laporan
////    public function update(Request $request, $id)
////    {
////        $laporan = Laporan::findOrFail($id);
////        $laporan->update($request->only('status'));
////        return redirect()->route('admin.laporan.index')->with('success', 'Status laporan diperbarui!');
////    }
////
////    // Hapus laporan
////    public function destroy($id)
////    {
////        Laporan::destroy($id);
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
//// pastikan model Laporan sudah ada
//
//class LaporanController extends Controller
//{
//    // ✅ Method yang diminta oleh route /admin/laporan
//    public function adminIndex()
//    {
//        $laporan = Laporan::latest()->get(); // ambil semua laporan
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
//        $request->validate([
//            'status' => 'required|string|in:pending,proses,selesai',
//        ]);
//
//        $laporan = Laporan::findOrFail($id);
//        $laporan->status = (string) $request->input('status');
//        $laporan->save();
//
//        return redirect()
//            ->route('admin.laporan.index')
//            ->with('success', 'Status laporan diperbarui!');
//    }
//
//    public function destroy($id)
//    {
//        $laporan = Laporan::findOrFail($id);
//        $laporan->delete();
//        return redirect()->route('admin.laporan.index')->with('success', 'Laporan berhasil dihapus!');
//    }
//}


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;

// pastikan model Laporan sudah ada

class LaporanController extends Controller
{
    // Tampilkan semua laporan
    public function adminindex()
    {
        // Asumsi method adminIndex diubah menjadi index untuk Route::resource
        $laporan = Laporan::latest()->get(); // ambil semua laporan
        return view('admin.laporan.index', compact('laporan'));
    }

    public function show($id)
    {
        $laporan = Laporan::findOrFail($id);
        return view('admin.laporan.show', compact('laporan'));
    }

    public function edit($id)
    {
        $laporan = Laporan::findOrFail($id);
        return view('admin.laporan.edit', compact('laporan'));
    }

    // ✅ PERBAIKAN: Memvalidasi dan menerima semua data dari form (judul, deskripsi, status)
    public function update(Request $request, $id)
    {
        // 1. Validasi semua field yang dikirim dari form
        $request->validate([
            'judul_laporan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'status' => 'required|string|in:pending,proses,selesai',
        ]);

        $laporan = Laporan::findOrFail($id);

        // 2. Gunakan $request->only() untuk mengambil semua field yang valid
        $laporan->update($request->only(['judul_laporan', 'deskripsi', 'status']));

        // Catatan: Pastikan model Laporan memiliki $fillable yang sesuai
        // Contoh: protected $fillable = ['judul_laporan', 'deskripsi', 'status', ...];

        return redirect()
            ->route('admin.laporan.index')
            ->with('success', 'Laporan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->delete();
        return redirect()->route('admin.laporan.index')->with('success', 'Laporan berhasil dihapus!');
    }

    // Jika Anda menggunakan adminIndex, hapus method ini atau ganti nama ke index()
    // public function adminIndex()
    // {
    //     $laporan = Laporan::latest()->get();
    //     return view('admin.laporan.index', compact('laporan'));
    // }
}
