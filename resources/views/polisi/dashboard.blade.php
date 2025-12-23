<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Polisi - Crime Alert</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; background-color: #f0f2f5; margin: 0; }

        .sidebar { width: 250px; background-color: #1a202c; color: #ecf0f1; height: 100vh; position: fixed; left: 0; top: 0; z-index: 50; transition: 0.3s; transform: translateX(-100%); }
        @media (min-width: 1024px) { .sidebar { transform: translateX(0); } }
        .sidebar-open { transform: translateX(0) !important; }
        .sidebar-nav a { display: flex; align-items: center; padding: 12px 20px; color: #cbd5e0; text-decoration: none; border-left: 4px solid transparent; }
        .sidebar-nav a:hover, .sidebar-nav a.active { background-color: #2d3748; color: #fff; border-left: 4px solid #3182ce; }

        .main-content { padding: 30px; margin-left: 0; transition: 0.3s; }
        @media (min-width: 1024px) { .main-content { margin-left: 250px; } }

        .card-report { background: #fff; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.02); transition: 0.3s; border: 1px solid #edf2f7; }
        .card-report:hover { transform: translateY(-2px); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); border-color: #3182ce; }

        .status-pill { padding: 4px 10px; border-radius: 9999px; font-size: 0.7rem; font-weight: 700; text-transform: uppercase; }
        .badge-none { background-color: #fef3c7; color: #92400e; }
        .badge-mine { background-color: #dbeafe; color: #1e40af; }
        .badge-others { background-color: #f7fafc; color: #4a5568; border: 1px solid #e2e8f0; }
    </style>
</head>
<body x-data="{ open: false }">

{{-- ALERTS --}}
@if (session('success'))
    <script>Swal.fire({ icon: 'success', title: 'Berhasil', text: '{{ session('success') }}', timer: 2000, showConfirmButton: false });</script>
@endif

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
                <span class="font-bold text-lg tracking-wider uppercase">Panel POLISI</span>
            </div>
            <nav class="sidebar-nav mt-4 flex-grow">
                <a href="{{ route('polisi.dashboard') }}" class="active"><i class="fas fa-th-large mr-3"></i> Dashboard</a>
                <a href="{{ route('polisi.profil') }}"><i class="fas fa-user-circle mr-3"></i> Profil Saya</a>
            </nav>
            <div class="p-4 border-t border-gray-800">
                <form method="POST" action="{{ route('polisi.logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full text-left p-3 hover:bg-gray-800 rounded-lg text-red-400 font-medium">
                        <i class="fas fa-sign-out-alt mr-3"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div x-show="open" @click="open = false" class="fixed inset-0 bg-black/50 z-40 lg:hidden"></div>

    {{-- MAIN CONTENT --}}
    <div class="main-content w-full">
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">Halo, {{ $polisi->nama }}</h1>
            <p class="text-gray-500 mt-1 font-medium">Pantau dan tangani laporan masuk hari ini.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @forelse ($laporans as $laporan)
                <div class="card-report flex flex-col">
                    <div class="p-6 flex-grow">
                        <div class="flex justify-between items-start mb-4">
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ $laporan->created_at->diffForHumans() }}</span>
                            @if ($laporan->polisi_id === null)
                                <span class="status-pill badge-none">Tersedia</span>
                            @elseif ($laporan->polisi_id == $polisi->id)
                                <span class="status-pill badge-mine">Tugas Anda</span>
                            @else
                                <span class="status-pill badge-others">Ditangani Polisi Lain</span>
                            @endif
                        </div>

                        <h3 class="text-lg font-bold text-gray-900 leading-tight mb-2 line-clamp-1">{{ $laporan->judul_laporan }}</h3>
                        <p class="text-gray-600 text-sm line-clamp-2 mb-4 leading-relaxed italic">{{ $laporan->deskripsi }}</p>
                        <p class="text-gray-600 text-sm line-clamp-2 mb-4 leading-relaxed italic">{{ $laporan->lokasi_kejadian }}</p>
                        <div class="flex items-center text-xs text-gray-500 font-medium">
                            <i class="fas fa-tag mr-2 text-blue-500"></i> {{ $laporan->kategori }}
                        </div>
                    </div>

                    <div class="p-4 bg-gray-50 rounded-b-xl border-t flex justify-between items-center">
                        <a href="{{ route('polisi.laporan.show', $laporan->id) }}" class="text-sm font-bold text-blue-600 hover:text-blue-800 transition">
                            LIHAT DETAIL
                        </a>

                        @if ($laporan->polisi_id === null)
                            <form action="{{ route('polisi.laporan.tangani', $laporan->id) }}" method="POST">
                                @csrf
                                <button class="bg-blue-600 hover:bg-blue-700 text-white text-[10px] font-extrabold px-4 py-2 rounded-lg shadow-md transition uppercase tracking-tighter">
                                    Tangani Sekarang
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 bg-white rounded-2xl border-2 border-dashed border-gray-200 flex flex-col items-center">
                    <i class="fas fa-folder-open text-gray-300 text-5xl mb-4"></i>
                    <p class="text-gray-400 font-bold uppercase tracking-widest text-sm">Tidak ada laporan tersedia</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</body>
</html>
