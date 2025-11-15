<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PolisiLaporanController extends Controller
{
    public function index()
    {
        $laporan = Laporan::where('polisi_id', auth()->id())->get();
        return view('admin.laporan.index', compact('laporan'));
    }
}
