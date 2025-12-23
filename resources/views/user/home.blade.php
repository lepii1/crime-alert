{{--<!DOCTYPE html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--    <title>Community Feed - Crime Alert</title>--}}
{{--    @vite(['resources/css/app.css', 'resources/js/app.js'])--}}
{{--    <style>--}}
{{--        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');--}}
{{--        body {--}}
{{--            font-family: 'Poppins', sans-serif;--}}
{{--            background-color: #f0f2f5;--}}
{{--            margin: 0;--}}
{{--            min-height: 100vh;--}}
{{--        }--}}
{{--        .header {--}}
{{--            background-color: #2c3e50;--}}
{{--            color: #ecf0f1;--}}
{{--        }--}}
{{--        .header-logo {--}}
{{--            color: #e74c3c;--}}
{{--        }--}}
{{--        .nav-link {--}}
{{--            @apply px-3 py-2 rounded-lg transition text-sm font-medium;--}}
{{--        }--}}
{{--        .nav-link:hover {--}}
{{--            background-color: rgba(255, 255, 255, 0.1);--}}
{{--        }--}}
{{--        .nav-link.active {--}}
{{--            background-color: rgba(255, 255, 255, 0.2);--}}
{{--            color: #fff;--}}
{{--        }--}}
{{--        .status-badge {--}}
{{--            @apply px-2 py-1 rounded-full text-[10px] font-bold uppercase;--}}
{{--        }--}}
{{--        .report-card {--}}
{{--            @apply bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden transition hover:shadow-md;--}}
{{--        }--}}
{{--        .main-content-wrapper {--}}
{{--            max-width: 7xl;--}}
{{--            margin-left: auto;--}}
{{--            margin-right: auto;--}}
{{--            padding-left: 1rem;--}}
{{--            padding-right: 1rem;--}}
{{--        }--}}
{{--    </style>--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">--}}
{{--</head>--}}
{{--<body>--}}
{{--<header class="header shadow-lg">--}}
{{--    <div class="main-content-wrapper py-4 flex justify-between items-center">--}}
{{--        <div class="flex items-center">--}}
{{--            <ul>--}}
{{--                <li><a href="{{ url('/') }}"><i class="fas fa-exclamation-circle mr-3 header-logo text-2xl"></i> <span class="text-white text-xl font-semibold"> CRIME ALERT - BERANDA</span></a></li>--}}
{{--            </ul>--}}
{{--            <h1 class="text-xl font-semibold sm:hidden">DASHBOARD</h1>--}}
{{--        </div>--}}

{{--        <div class="flex items-center space-x-4">--}}
{{--            <a href="{{route('user.dashboard') }}" class="px-3 py-2 bg-gray-600 text-white rounded-lg font-semibold hover:bg-gray-700 transition text-sm">--}}
{{--                Dashboard--}}
{{--            </a>--}}

{{--            <a href="{{ route('laporan.create') }}" class="px-3 py-2 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition text-sm whitespace-nowrap">--}}
{{--                <i class="fas fa-plus  mr-1"></i> Buat Laporan--}}
{{--            </a>--}}

{{--            --}}{{-- LOGOUT --}}
{{--            <form method="POST" action="{{ route('logout') }}">--}}
{{--                @csrf--}}
{{--                <button type="submit" class="text-sm hover:text-gray-300 transition whitespace-nowrap">--}}
{{--                    <i class="fas fa-sign-out-alt mr-1"></i> Logout--}}
{{--                </button>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</header>--}}

{{--<main class="py-10">--}}
{{--    <div class="max-w-7xl mx-auto px-6">--}}
{{--        <div class="mb-8">--}}
{{--            <h2 class="text-2xl font-bold text-gray-800">Laporan Komunitas</h2>--}}
{{--            <p class="text-sm text-gray-500">Melihat kejadian terkini yang dilaporkan oleh warga sekitar.</p>--}}
{{--        </div>--}}

{{--        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">--}}
{{--            @forelse($laporans as $laporan)--}}
{{--                <div class="report-card flex flex-col">--}}
{{--                    <div class="h-48 bg-gray-200 relative overflow-hidden">--}}
{{--                        @if($laporan->bukti_kejadian)--}}
{{--                            <img src="{{ asset('storage/' . $laporan->bukti_kejadian) }}" class="w-full h-full object-cover">--}}
{{--                        @else--}}
{{--                            <div class="flex items-center justify-center h-full text-gray-400"><i class="fas fa-image text-3xl"></i></div>--}}
{{--                        @endif--}}
{{--                        <div class="absolute top-3 left-3">--}}
{{--                            <span class="status-badge bg-white shadow-sm text-gray-700">{{ $laporan->kategori }}</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="p-5 flex-grow">--}}
{{--                        <div class="flex items-center justify-between mb-2">--}}
{{--                            <span class="text-[10px] text-gray-400 font-bold uppercase">{{ \Carbon\Carbon::parse($laporan->tgl_lapor)->format('d M Y') }}</span>--}}
{{--                            <span class="text-[10px] font-bold {{ $laporan->status == 'selesai' ? 'text-green-500' : 'text-yellow-500' }} uppercase">{{ $laporan->status }}</span>--}}
{{--                        </div>--}}
{{--                        <h3 class="font-bold text-gray-800 mb-2 line-clamp-1">{{ $laporan->judul_laporan }}</h3>--}}
{{--                        <p class="text-xs text-gray-600 line-clamp-2 mb-4">{{ $laporan->deskripsi }}</p>--}}
{{--                        <p class="text-xs text-gray-600 line-clamp-2 mb-4">{{ $laporan->lokasi_kejadian }}</p>--}}
{{--                        <div class="pt-4 border-t flex items-center justify-between">--}}
{{--                            <div class="flex items-center">--}}
{{--                                <div class="w-6 h-6 bg-indigo-100 rounded-full flex items-center justify-center text-[10px] font-bold text-indigo-600 mr-2">--}}
{{--                                    {{ substr($laporan->user->name, 0, 1) }}--}}
{{--                                </div>--}}
{{--                                <span class="text-[11px] font-medium text-gray-500">{{ $laporan->user->name }}</span>--}}
{{--                            </div>--}}
{{--                            <a href="{{ route('laporan.show', $laporan->id) }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800">Detail <i class="fas fa-arrow-right ml-1"></i></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @empty--}}
{{--                <div class="col-span-full py-20 text-center bg-white rounded-xl shadow-sm border border-dashed border-gray-300">--}}
{{--                    <p class="text-gray-400">Belum ada laporan yang dibagikan.</p>--}}
{{--                </div>--}}
{{--            @endforelse--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</main>--}}
{{--</body>--}}
{{--</html>--}}

    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Community Feed - Crime Alert</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; background-color: #f0f2f5; margin: 0; min-height: 100vh; }
        .header { background-color: #2c3e50; color: #ecf0f1; }
        .header-logo { color: #e74c3c; }
        .status-badge { @apply px-2 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider shadow-sm; }
        .report-card { @apply bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1; }
        .nav-item { @apply flex items-center px-4 py-2 rounded-xl transition-all duration-200 text-sm font-medium hover:bg-white/10; }
        .nav-item.active { @apply bg-white/20 text-white font-bold; }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body x-data="{ mobileMenu: false }">

<header class="header shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto py-4 px-6 flex justify-between items-center">
        <div class="flex items-center group">
            <a href="{{ url('/') }}" class="flex items-center">
                <i class="fas fa-exclamation-circle mr-3 header-logo text-3xl group-hover:rotate-12 transition-transform"></i>
                <span class="text-white text-xl font-extrabold tracking-tight hidden sm:block uppercase">Crime Alert</span>
            </a>
        </div>

        <nav class="hidden lg:flex items-center space-x-2">
            <a href="{{ route('user.home') }}" class="nav-item active"><i class="fas fa-rss mr-2 text-xs"></i> Feed Beranda</a>
            <a href="{{ route('user.dashboard') }}" class="nav-item"><i class="fas fa-th-large mr-2 text-xs"></i> Dashboard</a>
        </nav>

        <div class="flex items-center space-x-3">
            <a href="{{ route('laporan.create') }}" class="bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-widest transition-all shadow-lg active:scale-95 hidden sm:flex items-center">
                <i class="fas fa-plus-circle mr-2"></i> Buat Laporan
            </a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="p-2.5 text-gray-400 hover:text-white transition-colors"><i class="fas fa-sign-out-alt text-lg"></i></button>
            </form>
            <button @click="mobileMenu = !mobileMenu" class="lg:hidden p-2 text-white"><i class="fas fa-bars text-xl"></i></button>
        </div>
    </div>

    <div x-show="mobileMenu" x-cloak class="lg:hidden bg-[#34495e] border-t border-white/10 p-4 space-y-2">
        <a href="{{ route('user.home') }}" class="block p-3 text-white font-bold bg-white/10 rounded-lg">Beranda</a>
        <a href="{{ route('user.dashboard') }}" class="block p-3 text-white font-medium hover:bg-white/10 rounded-lg">Dashboard Saya</a>
    </div>
</header>

<main class="py-12">
    <div class="max-w-7xl mx-auto px-6">
        <div class="mb-10 text-center md:text-left">
            <h2 class="text-3xl font-extrabold text-gray-800 tracking-tight">Laporan Komunitas</h2>
            <p class="text-gray-500 font-medium mt-1">Pantau situasi keamanan terkini di sekitar Anda.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($laporans as $laporan)
                <div class="report-card flex flex-col">
                    <div class="h-52 bg-gray-200 relative overflow-hidden group">
                        @if($laporan->bukti_kejadian)
                            <img src="{{ asset('storage/' . $laporan->bukti_kejadian) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        @else
                            <div class="flex flex-col items-center justify-center h-full text-gray-400 bg-gray-100">
                                <i class="fas fa-image text-4xl mb-2"></i>
                                <span class="text-[10px] font-bold uppercase">Tanpa Foto Bukti</span>
                            </div>
                        @endif
                        <div class="absolute top-4 left-4">
                            <span class="bg-black/60 backdrop-blur-md text-white px-3 py-1 rounded-lg text-[10px] font-bold uppercase">
                                {{ $laporan->kategori }}
                            </span>
                        </div>
                    </div>
                    <div class="p-6 flex-grow flex flex-col">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-[10px] text-gray-400 font-bold uppercase tracking-tighter">
                                <i class="far fa-calendar-alt mr-1"></i> {{ \Carbon\Carbon::parse($laporan->tgl_lapor)->format('d M Y') }}
                            </span>
                            <span class="status-badge {{ $laporan->status == 'selesai' ? 'bg-green-100 text-green-600' : 'bg-yellow-100 text-yellow-600' }}">
                                {{ $laporan->status }}
                            </span>
                        </div>
                        <h3 class="font-bold text-gray-800 mb-2 text-lg line-clamp-1 capitalize">{{ $laporan->judul_laporan }}</h3>
                        <p class="text-xs text-gray-500 line-clamp-2 leading-relaxed italic mb-4">"{{ $laporan->deskripsi }}"</p>

                        @if($laporan->lokasi_kejadian)
                            <div class="flex items-start mb-4 text-xs text-gray-600">
                                <i class="fas fa-map-marker-alt mt-1 mr-2 text-red-500"></i>
                                <span class="line-clamp-1">{{ $laporan->lokasi_kejadian }}</span>
                            </div>
                        @endif

                        <div class="mt-auto pt-4 border-t flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center text-xs font-bold text-indigo-600 mr-2 border border-indigo-200">
                                    {{ substr($laporan->user->name, 0, 1) }}
                                </div>
                                <span class="text-xs font-bold text-gray-700">{{ $laporan->user->name }}</span>
                            </div>
                            <a href="{{ route('laporan.show', $laporan->id) }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 flex items-center transition">
                                DETAIL <i class="fas fa-chevron-right ml-1.5 text-[8px]"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-24 text-center bg-white rounded-2xl border-2 border-dashed border-gray-200">
                    <i class="fas fa-folder-open text-gray-200 text-6xl mb-4"></i>
                    <p class="text-gray-400 font-bold uppercase tracking-widest text-sm">Belum ada laporan publik</p>
                </div>
            @endforelse
        </div>
    </div>
</main>
<footer class="py-8 text-center text-gray-400 text-xs font-medium border-t bg-white mt-12">
    &copy; {{ date('Y') }} Crime Alert Report. Seluruh hak cipta dilindungi.
</footer>
</body>
</html>
