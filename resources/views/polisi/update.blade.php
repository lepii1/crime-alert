<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Update Status Laporan - Panel Polisi</title>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; background-color: #f0f2f5; margin: 0; }

        /* Sidebar Styling (Police Theme) */
        .sidebar { width: 250px; background-color: #1a202c; color: #ecf0f1; height: 100vh; position: fixed; left: 0; top: 0; z-index: 50; transition: 0.3s; transform: translateX(-100%); }
        @media (min-width: 1024px) { .sidebar { transform: translateX(0); } }
        .sidebar-open { transform: translateX(0) !important; }
        .sidebar-nav a { display: flex; align-items: center; padding: 12px 20px; color: #cbd5e0; text-decoration: none; border-left: 4px solid transparent; }
        .sidebar-nav a:hover, .sidebar-nav a.active { background-color: #2d3748; color: #fff; border-left: 4px solid #3182ce; }

        /* Layout */
        .main-content { padding: 30px; margin-left: 0; transition: 0.3s; }
        @media (min-width: 1024px) { .main-content { margin-left: 250px; } }

        .card-edit { background: #fff; border-radius: 15px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05); overflow: hidden; max-width: 800px; margin: 0 auto; }
        .input-field { @apply w-full mt-1 p-3 border border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all outline-none text-sm font-medium; }

        .status-label { @apply block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1; }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body x-data="{ open: false }">

{{-- MOBILE MENU --}}
<div @click="open = true" class="lg:hidden fixed top-4 right-4 z-[60] bg-blue-600 p-3 rounded-full text-white shadow-xl cursor-pointer">
    <i class="fas fa-bars"></i>
</div>

<div class="flex">
    {{-- SIDEBAR --}}
    <div class="sidebar shadow-2xl" :class="{'sidebar-open': open}">
        <div class="flex flex-col h-full">
            <div class="p-6 flex items-center border-b border-gray-800">
                <i class="fas fa-user-shield text-blue-500 text-2xl mr-3"></i>
                <span class="font-bold text-lg tracking-wider uppercase">Panel Polisi</span>
            </div>
            <nav class="sidebar-nav mt-4 flex-grow">
                <a href="{{ route('polisi.dashboard') }}"><i class="fas fa-th-large mr-3"></i> Dashboard</a>
                <a href="{{ route('polisi.profil') }}"><i class="fas fa-user-circle mr-3"></i> Profil Saya</a>
            </nav>
            <div class="p-4 border-t border-gray-800">
                <form method="POST" action="{{ route('polisi.logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full text-left p-3 rounded-lg text-red-400 font-medium">
                        <i class="fas fa-sign-out-alt mr-3"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div x-show="open" @click="open = false" class="fixed inset-0 bg-black/50 z-40 lg:hidden" style="display: none;"></div>

    {{-- MAIN CONTENT --}}
    <div class="main-content w-full">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">Update Status</h1>
                <p class="text-gray-500 text-sm mt-1">Perbarui perkembangan investigasi laporan #{{ $laporan->id }}</p>
            </div>
            <a href="{{ route('polisi.laporan.show', $laporan->id) }}" class="text-xs font-bold text-gray-400 hover:text-blue-600 flex items-center transition uppercase tracking-tighter" style="padding-right: 35px">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Detail
            </a>
        </div>

        <div class="card-edit">
            {{-- Ringkasan Laporan (Read-Only) --}}
            <div class="bg-gray-50 p-6 border-b border-gray-100 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <span class="status-label">Judul Laporan</span>
                    <p class="text-sm font-bold text-gray-800">{{ $laporan->judul_laporan }}</p>
                </div>
                <div>
                    <span class="status-label">Kategori</span> <br>
                    <p class="text-xs font-bold text-blue-600 bg-blue-50 inline-block py-1 rounded">{{ $laporan->kategori }}</p>
                </div>
                <div>
                    <span class="status-label">Pelapor</span>
                    <p class="text-sm font-medium text-gray-700">{{ $laporan->user->name ?? '-' }}</p>
                </div>
                <div>
                    <span class="status-label">Lokasi</span>
                    <p class="text-sm font-medium text-gray-700">{{ $laporan->lokasi_kejadian ?? '-' }}</p>
                </div>
            </div>

            <div class="p-8">
                <form action="{{ route('polisi.laporan.status', $laporan->id) }}" method="POST">
                    @csrf

                    <div class="max-w-md mx-auto space-y-8">
                        {{-- Dropdown Status --}}
                        <div class="relative">
                            <label for="status" class="status-label mb-2 inline-block">Pilih Status Penanganan Terbaru</label>
                            <select name="status" id="status" class="input-field appearance-none cursor-pointer pr-10">
                                <option value="pending" {{ $laporan->status == 'pending' ? 'selected' : '' }}>🕒 PENDING (Menunggu)</option>
                                <option value="proses" {{ $laporan->status == 'proses' ? 'selected' : '' }}>🚧 PROSES (Investigasi)</option>
                                <option value="selesai" {{ $laporan->status == 'selesai' ? 'selected' : '' }}>✅ SELESAI (Ditangani)</option>
                            </select>
                        </div>

                        <div class="bg-blue-50 p-4 rounded-xl border border-blue-100 flex items-start">
                            <i class="fas fa-info-circle text-blue-500 mt-1 mr-3"></i>
                            <p class="text-xs text-blue-700 leading-relaxed font-medium">
                                Perubahan status akan langsung terlihat oleh Pelapor di dashboard mereka. Pastikan data investigasi sudah valid sebelum mengubah status menjadi <b>Selesai</b>.
                            </p>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="flex flex-col gap-3 pt-4">
                            <button type="submit" class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-2xl shadow-lg transition-all active:scale-95 uppercase tracking-wider text-sm flex items-center justify-center">
                                <i class="fas fa-save mr-2"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('polisi.dashboard') }}" class="w-full py-4 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold rounded-2xl text-center transition-all text-sm uppercase tracking-wider">
                                Batalkan
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
