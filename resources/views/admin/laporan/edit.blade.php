<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Edit Laporan #{{ $laporan->id }} - Admin Panel</title>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap');

        body { font-family: 'Poppins', sans-serif; background-color: #f0f2f5; margin: 0; }

        .sidebar { width: 260px; background-color: #2c3e50; color: #ecf0f1; height: 100vh; position: fixed; left: 0; top: 0; z-index: 50; transition: 0.3s ease-in-out; transform: translateX(-100%); }
        @media (min-width: 1024px) { .sidebar { transform: translateX(0); } }
        .sidebar-open { transform: translateX(0) !important; }

        .sidebar-nav a { display: flex; align-items: center; padding: 14px 24px; color: #ecf0f1; text-decoration: none; border-left: 4px solid transparent; transition: 0.2s; font-size: 0.9rem; }
        .sidebar-nav a:hover, .sidebar-nav a.active { background-color: #34495e; border-left: 4px solid #e74c3c; color: #fff; font-weight: 600; }

        .main-content { padding: 30px; margin-left: 0; transition: 0.3s; }
        @media (min-width: 1024px) { .main-content { margin-left: 260px; } }

        .card-edit { background: #fff; border-radius: 24px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); padding-left: 40px; padding-right: 40px; padding-bottom: 30px; border: 1px solid #edf2f7; max-width: 5xl; margin: 0 auto; }

        .label-text { @apply block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2; }

        .form-input-style {
            @apply w-full border border-gray-200 p-3 rounded-xl shadow-sm transition duration-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-100 outline-none text-sm font-medium;
        }

        .section-title { padding-bottom: 15px; @apply text-lg font-black text-gray-800 uppercase tracking-tight mb-6 border-b pb-3; }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body x-data="{ open: false }">

{{-- HAMBURGER --}}
<div @click="open = true" class="lg:hidden fixed top-4 right-4 z-[60] bg-indigo-600 p-3 rounded-full text-white shadow-xl cursor-pointer active:scale-95 transition">
    <i class="fas fa-bars"></i>
</div>

<div class="flex">
    {{-- SIDEBAR --}}
    <div class="sidebar shadow-2xl" :class="{'sidebar-open': open}">
        <div class="flex flex-col h-full">
            <div class="p-8 border-b border-gray-700">
                <a href="{{ url('/') }}" class="flex items-center group">
                    <i class="fas fa-exclamation-circle text-red-500 text-3xl mr-3 group-hover:rotate-12 transition-transform"></i>
                    <span class="font-black text-xl tracking-tighter uppercase text-white">Crime Alert</span>
                </a>
            </div>

            <nav class="sidebar-nav mt-6 flex-grow">
                <a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt mr-3 w-5 text-center"></i> Dashboard</a>
                <a href="{{ route('admin.laporan.index') }}" class="active"><i class="fas fa-bell mr-3 w-5 text-center"></i> Laporan Masuk</a>
                <a href="{{ route('admin.laporan.reports') }}"><i class="fas fa-chart-bar mr-3 w-5 text-center"></i> Analisis Visual</a>
                <a href="{{ route('profile.edit') }}"><i class="fas fa-cog mr-3 w-5 text-center"></i> Pengaturan</a>
            </nav>

            <div class="p-6 border-t border-gray-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full text-left p-3 hover:bg-red-500/10 rounded-xl text-red-400 font-bold uppercase text-[10px] tracking-widest transition">
                        <i class="fas fa-power-off mr-3"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- OVERLAY MOBILE --}}
    <div x-show="open" @click="open = false" x-cloak class="fixed inset-0 bg-black/50 z-40 lg:hidden backdrop-blur-sm transition-opacity"></div>

    {{-- MAIN CONTENT --}}
    <div class="main-content w-full">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <a href="{{ route('admin.laporan.index') }}" class="text-gray-400 hover:text-indigo-600 transition"><i class="fas fa-arrow-left"></i></a>
                    <span class="text-[10px] font-black text-gray-300 uppercase tracking-[0.2em]">Koreksi Data Laporan</span>
                </div>
                <h1 class="text-3xl font-black text-gray-800 tracking-tight">Edit Laporan #{{ $laporan->id }}</h1>
            </div>
            <div class="flex items-center gap-3 bg-white px-5 py-2.5 rounded-2xl shadow-sm border text-xs font-bold text-gray-400 uppercase tracking-widest">
                <i class="fas fa-edit text-indigo-500"></i> Mode Penyuntingan
            </div>
        </div>

        <div class="card-edit">
            <form method="POST" action="{{ route('admin.laporan.update', $laporan->id) }}" class="space-y-10">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-12 gap-y-8">

                    {{-- INFORMASI KEJADIAN --}}
                    <div class="lg:col-span-2">
                        <h2 class="section-title">
                            <i class="fas fa-info-circle mr-2 text-indigo-500"></i> Detail Informasi
                        </h2>
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Judul Laporan
                                </label>
                                <input type="text" value="{{ $laporan->judul_laporan }}"
                                       name="judul_laporan" class="w-full border-gray-300 rounded-md shadow-sm" >
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Deskripsi
                                </label>
                                <textarea name="deskripsi" class="w-full border-gray-300 rounded-md shadow-sm" rows="4" >{{ $laporan->deskripsi }}</textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Lokasi Kejadian
                                </label>
                                <input type="text" value="{{ $laporan->lokasi_kejadian }}"
                                       name="lokasi_kejadian" class="w-full border-gray-300 rounded-md shadow-sm" >
                            </div>
                        </div>
                    </div>

                    {{-- KATEGORI & STATUS --}}
                    <div class="space-y-6">
                        <h2 class="section-title">
                            <i class="fas fa-tags mr-2 text-indigo-500"></i> Klasifikasi
                        </h2>
                        <div>
                            <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1">
                                Pilih Kategori
                            </label>
                            <select id="kategori" name="kategori" class="w-full border-gray-300 rounded-md shadow-sm">
                                <option value="Pencurian" {{ $laporan->kategori == 'Pencurian' ? 'selected' : '' }}>Pencurian</option>
                                <option value="Tawuran" {{ $laporan->kategori == 'Tawuran' ? 'selected' : '' }}>Tawuran</option>
                                <option value="Kekerasan" {{ $laporan->kategori == 'Kekerasan' ? 'selected' : '' }}>Kekerasan</option>
                                <option value="Penipuan" {{ $laporan->kategori == 'Penipuan' ? 'selected' : '' }}>Penipuan</option>
                                <option value="Pelecehan" {{ $laporan->kategori == 'Pelecehan' ? 'selected' : '' }}>Pelecehan</option>
                                <option value="Lain-lain" {{ $laporan->kategori == 'Lain-lain' ? 'selected' : '' }}>Lain-lain</option>
                            </select>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <h2 class="section-title">
                            <i class="fas fa-tasks mr-2 text-indigo-500"></i> Status Laporan
                        </h2>
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                                Status Laporan
                            </label>
                            <select id="status" name="status" class="w-full border-gray-300 rounded-md shadow-sm">
                                <option value="pending" {{ $laporan->status == 'pending' ? 'selected' : '' }}>🕒 Pending</option>
                                <option value="proses" {{ $laporan->status == 'proses' ? 'selected' : '' }}>🚧 Proses</option>
                                <option value="selesai" {{ $laporan->status == 'selesai' ? 'selected' : '' }}>✅ Selesai</option>
                            </select>
                        </div>
                    </div>

                </div>

                {{-- TOMBOL AKSI --}}
                <div class="pt-10 border-t flex flex-col md:flex-row justify-end items-center gap-4">
                    <a href="{{ route('admin.laporan.index') }}"
                       class="w-full md:w-auto px-10 py-4 bg-gray-100 text-gray-500 font-bold rounded-2xl hover:bg-gray-200 transition text-[10px] uppercase tracking-widest text-center">
                        Batalkan
                    </a>
                    <button type="submit"
                            class="w-full md:w-auto px-12 py-4 bg-indigo-600 text-white font-black rounded-2xl shadow-xl shadow-indigo-100 hover:bg-indigo-700 transition-all active:scale-95 text-[10px] uppercase tracking-[0.2em]">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<footer class="py-12 text-center text-gray-400 text-[10px] font-bold uppercase tracking-[0.3em]">
    Crime Alert Security System &bull; Administrative Portal {{ date('Y') }}
</footer>

</body>
</html>
