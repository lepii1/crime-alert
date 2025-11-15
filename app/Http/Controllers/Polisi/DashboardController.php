<?php

namespace App\Http\Controllers\Polisi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Laporan;

class DashboardController extends Controller
{
    public function index()
    {
        $polisi = Auth::guard('polisi')->user();

        $laporans = Laporan::where('polisi_id', $polisi->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('polisi.dashboard', compact('polisi', 'laporans'));
    }
}
