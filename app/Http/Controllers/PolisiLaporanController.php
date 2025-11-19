<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\PolisiUpdateLaporan;

class PolisiLaporanController extends Controller
{
    public function index()
    {
        $laporan = Laporan::where('polisi_id', auth()->id())->get();
        return view('admin.laporan.index', compact('laporan'));
    }

    public function update(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->status = $request->status;
        $laporan->save();

        // Kirim notifikasi ke admin
        $admin = User::where('role', 'admin')->first();
        if ($admin) {
            $admin->notify(new PolisiUpdateLaporan($laporan));
        }

        return back()->with('success', 'Status laporan berhasil diperbarui');
    }
}
