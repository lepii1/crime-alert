{{--<!DOCTYPE html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}

{{--    <title>Laporan #{{ $laporan->id }} - Crime Alert</title>--}}

{{--    <!-- Tailwind CSS -->--}}
{{--    @vite(['resources/css/app.css', 'resources/js/app.js'])--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>--}}

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
{{--        .status-badge {--}}
{{--            padding: 4px 10px;--}}
{{--            border-radius: 9999px;--}}
{{--            font-size: 0.85rem;--}}
{{--            font-weight: 600;--}}
{{--        }--}}
{{--        .status-pending { background-color: #fde68a; color: #b45309; }--}}
{{--        .status-proses { background-color: #bfdbfe; color: #1e40af; }--}}
{{--        .status-selesai { background-color: #d1fae5; color: #065f46; }--}}

{{--        .card-detail {--}}
{{--            background-color: #ffffff;--}}
{{--            border-radius: 12px;--}}
{{--            box-shadow: 0 4px 12px rgba(0,0,0,0.05);--}}
{{--            padding: 24px;--}}
{{--        }--}}
{{--        .main-content-wrapper {--}}
{{--            max-width: 4xl;--}}
{{--            margin-left: auto;--}}
{{--            margin-right: auto;--}}
{{--            padding-left: 1rem;--}}
{{--            padding-right: 1rem;--}}
{{--        }--}}
{{--        /* Perbaikan Tampilan Gambar */--}}
{{--        .evidence-container {--}}
{{--            max-width: 500px; /* Batasi lebar maksimal agar tidak terlalu besar */--}}
{{--            margin: 0 auto;   /* Posisikan di tengah */--}}
{{--            background-color: #f8fafc;--}}
{{--            border-radius: 12px;--}}
{{--            overflow: hidden;--}}
{{--            border: 1px solid #e2e8f0;--}}
{{--        }--}}
{{--        .evidence-img {--}}
{{--            width: 100%;--}}
{{--            height: auto;--}}
{{--            object-fit: contain; /* Foto tidak terpotong, tetap dalam proporsi asli */--}}
{{--            display: block;--}}
{{--        }--}}
{{--    </style>--}}

{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">--}}
{{--</head>--}}
{{--<body>--}}

{{-- HEADER/NAVIGASI ATAS --}}
{{--<header class="header shadow-lg">--}}
{{--    <div class="main-content-wrapper py-4 flex justify-between items-center">--}}
{{--        <div class="flex items-center">--}}
{{--            <i class="fas fa-exclamation-circle mr-3 header-logo text-2xl"></i>--}}
{{--            <h1 class="text-xl font-semibold uppercase">CRIME ALERT - LAPORAN #{{ $laporan->id }}</h1>--}}
{{--        </div>--}}

{{--        <div class="flex items-center space-x-4">--}}
{{--            <a href="{{ route('user.dashboard') }}" class="px-3 py-2 bg-gray-600 text-white rounded-lg font-semibold hover:bg-gray-700 transition text-sm whitespace-nowrap">--}}
{{--                <i class="fas fa-arrow-left mr-1"></i> Dashboard--}}
{{--            </a>--}}

{{--            <form method="POST" action="{{ route('logout') }}">--}}
{{--                @csrf--}}
{{--                <button type="submit" class="text-sm hover:text-gray-300 transition whitespace-nowrap">--}}
{{--                    <i class="fas fa-sign-out-alt mr-1"></i> Logout--}}
{{--                </button>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</header>--}}

{{--<main class="py-12">--}}
{{--    <div class="main-content-wrapper">--}}

{{--        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center md:text-left">Detail Laporan #{{ $laporan->id }}</h1>--}}

{{--        <div class="card-detail space-y-8">--}}

{{--            @if (session('success'))--}}
{{--                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 shadow-sm">--}}
{{--                    {{ session('success') }}--}}
{{--                </div>--}}
{{--            @endif--}}

{{--            --}}{{-- HEADER INFO --}}
{{--            <div class="flex flex-col md:flex-row justify-between items-start md:items-center border-b pb-4 gap-4">--}}
{{--                <div>--}}
{{--                    <h2 class="text-2xl font-bold text-gray-900">{{ $laporan->judul_laporan }}</h2>--}}
{{--                    <p class="text-sm text-gray-500 mt-1">--}}
{{--                        <i class="far fa-calendar-alt mr-1"></i> Dilaporkan pada {{ \Carbon\Carbon::parse($laporan->tgl_lapor)->format('d F Y') }}--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--                <span class="status-badge status-{{ strtolower($laporan->status ?? 'pending') }}">--}}
{{--                    {{ ucfirst($laporan->status ?? 'pending') }}--}}
{{--                </span>--}}
{{--            </div>--}}

{{--            --}}{{-- FOTO BUKTI KEJADIAN (YANG DIRAPIKAN) --}}
{{--            <div class="pt-2 text-center md:text-left">--}}
{{--                <h3 class="text-xs font-bold text-gray-400 mb-4 uppercase tracking-widest">--}}
{{--                    <i class="fas fa-image mr-1"></i> Bukti Lampiran Foto--}}
{{--                </h3>--}}
{{--                @if($laporan->bukti_kejadian)--}}
{{--                    <div class="evidence-container shadow-md">--}}
{{--                        <img src="{{ asset('storage/' . $laporan->bukti_kejadian) }}" alt="Bukti Kejadian" class="evidence-img">--}}
{{--                    </div>--}}
{{--                @else--}}
{{--                    <div class="w-full h-40 bg-gray-100 rounded-xl flex items-center justify-center text-gray-400 border border-dashed">--}}
{{--                        <div class="text-center">--}}
{{--                            <i class="fas fa-image text-3xl mb-2"></i>--}}
{{--                            <p class="text-xs italic">Tidak ada foto bukti terlampir.</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            </div>--}}

{{--            --}}{{-- DETAIL UTAMA --}}
{{--            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 pt-6 border-t">--}}
{{--                <div class="bg-gray-50 p-4 rounded-lg">--}}
{{--                    <h3 class="text-xs font-bold text-gray-400 uppercase mb-1">Kategori</h3>--}}
{{--                    <p class="text-gray-800 font-semibold">{{ $laporan->kategori ?? '-' }}</p>--}}
{{--                </div>--}}
{{--                <div class="bg-gray-50 p-4 rounded-lg">--}}
{{--                    <h3 class="text-xs font-bold text-gray-400 uppercase mb-1">ID Laporan</h3>--}}
{{--                    <p class="text-gray-800 font-semibold">#{{ $laporan->id }}</p>--}}
{{--                </div>--}}
{{--                <div class="bg-gray-50 p-4 rounded-lg">--}}
{{--                    <h3 class="text-xs font-bold text-gray-400 uppercase mb-1">IP Terlapor</h3>--}}
{{--                    <p class="text-gray-800 font-mono text-sm">{{ $laporan->ip_terlapor ?? '-' }}</p>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            --}}{{-- DESKRIPSI --}}
{{--            <div class="pt-4">--}}
{{--                <h3 class="text-sm font-bold text-gray-700 mb-3">Deskripsi Lengkap</h3>--}}
{{--                <div class="bg-gray-50 rounded-xl text-gray-700 text-base leading-relaxed whitespace-pre-wrap border-l-4 border-indigo-200">--}}
{{--                    {{ $laporan->deskripsi ?? 'Tidak ada deskripsi.' }}--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="pt-4">--}}
{{--                 <h3 class="text-sm font-bold text-gray-700 mb-3">Lokasi Kejadian</h3>--}}
{{--                 <div class="bg-gray-50 rounded-xl text-gray-700 text-base leading-relaxed whitespace-pre-wrap border-l-4 border-indigo-200">--}}
{{--                    {{ $laporan->lokasi_kejadian ?? 'Tidak ada keterangan lokasi.' }}--}}
{{--                 </div>--}}
{{--            </div>--}}

{{--            --}}{{-- STATUS PETUGAS PENANGANAN --}}
{{--            <div class="pt-6 border-t border-gray-100">--}}
{{--                <h3 class="text-lg font-bold text-gray-700 mb-4 flex items-center">--}}
{{--                    <i class="fas fa-user-shield mr-2 text-indigo-600"></i> Status Penanganan--}}
{{--                </h3>--}}

{{--                @if ($laporan->polisi)--}}
{{--                    <div class="bg-indigo-50 border-l-4 border-indigo-600 p-5 rounded-r-lg">--}}
{{--                        <div class="flex items-start">--}}
{{--                            <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 mr-4">--}}
{{--                                <i class="fas fa-id-badge text-xl"></i>--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                                <p class="font-bold text-indigo-900 mb-0.5">--}}
{{--                                    {{ $laporan->polisi->nama ?? 'Petugas Khusus' }}--}}
{{--                                </p>--}}
{{--                                <p class="text-indigo-600 text-xs font-semibold uppercase tracking-wider">{{ $laporan->polisi->jabatan ?? 'Petugas Penanganan' }}</p>--}}
{{--                                <p class="text-sm text-indigo-500 mt-3 italic bg-white inline-block px-2 py-1 rounded border border-indigo-100">--}}
{{--                                    "Laporan ini sedang dalam proses tindak lanjut oleh petugas berwenang."--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @else--}}
{{--                    <div class="bg-yellow-50 border-l-4 border-yellow-600 p-5 rounded-r-lg shadow-sm">--}}
{{--                        <div class="flex items-center">--}}
{{--                            <i class="fas fa-clock text-yellow-600 mr-3 text-xl"></i>--}}
{{--                            <div>--}}
{{--                                <p class="font-bold text-yellow-800">Menunggu Penugasan</p>--}}
{{--                                <p class="text-sm text-yellow-700 mt-1">Sistem sedang memproses antrian petugas terdekat untuk menangani laporan Anda.</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            </div>--}}

{{--            --}}{{-- TOMBOL KEMBALI --}}
{{--            <div class="pt-8 border-t border-gray-100 flex justify-center md:justify-end">--}}
{{--                <a href="{{ route('user.dashboard') }}"--}}
{{--                   class="px-8 py-3 bg-gray-800 text-white rounded-xl hover:bg-black transition font-bold shadow-lg transform active:scale-95">--}}
{{--                    <i class="fas fa-chevron-left mr-2"></i> Kembali ke Dashboard--}}
{{--                </a>--}}
{{--            </div>--}}
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
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Detail Laporan #{{ $laporan->id }} - Crime Alert</title>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            min-height: 100vh;
        }
        /* Theme Colors */
        .header {
            background-color: #2c3e50;
            color: #ecf0f1;
        }
        .header-logo {
            color: #e74c3c;
        }

        /* Status Badges - Consistent with Dashboard */
        .status-badge {
            padding: 5px 15px;
            border-radius: 9999px;
            font-size: 1rem;
            font-weight: 600;
        }
        .status-pending { background-color: #fef3c7; color: #92400e; }
        .status-proses { background-color: #dbeafe; color: #1e40af; }
        .status-selesai { background-color: #d1fae5; color: #065f46; }

        /* Detail Elements */
        .card-detail {
            @apply bg-white rounded-3xl shadow-xl p-8 max-w-5xl mx-auto;
        }
        .info-block {
            @apply p-5 bg-gray-50 rounded-2xl border border-gray-100 transition-all hover:shadow-md hover:bg-white;
        }
        .label-text {
            @apply block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1;
        }
        .value-text {
            @apply text-sm font-bold text-gray-800;
        }

        /* Nav Item Styles */
        .nav-item {
            @apply flex items-center px-4 py-2 rounded-xl transition-all duration-200 text-sm font-medium hover:bg-white/10;
        }

        /* Image Display */
        .evidence-container {
            @apply bg-gray-50 rounded-2xl overflow-hidden border border-gray-100 shadow-lg;
        }
        .evidence-img {
            @apply object-contain max-h-[250px] block;
        }

        .main-content-wrapper {
            max-width: 4xl;
            margin-left: auto;
            margin-right: auto;
            padding-left: 1rem;
            padding-right: 1rem;
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body x-data="{ mobileMenu: false }">

{{-- HEADER --}}
<header class="header shadow-lg sticky top-0 z-50">
    <div class="main-content-wrapper py-4 flex justify-between items-center">
        <div class="flex items-center group">
            <a href="{{ url('/') }}" class="flex items-center">
                <i class="fas fa-exclamation-circle mr-3 header-logo text-3xl group-hover:scale-110 transition-transform"></i>
                <span class="text-white text-xl font-semibold"> CRIME ALERT - DETAIL</span>
            </a>
        </div>

        <div class="flex items-center space-x-3">
            <a href="{{ route('user.dashboard') }}" class="px-4 py-2 bg-gray-600 text-white rounded-xl font-bold text-xs hover:bg-gray-700 transition uppercase tracking-wider hidden sm:flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Dashboard
            </a>

            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="p-2.5 text-gray-400 hover:text-white transition-colors">
                    <i class="fas fa-sign-out-alt text-lg"></i>
                </button>
            </form>

        </div>
    </div>

</header>

<main class="py-12 px-6">
    <div class="card-detail">

        {{-- HEADER INFO --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center border-b pb-8 mb-8 gap-6">
            <div>
                <span class="label-text mb-2">Rincian Laporan Resmi</span>
                <h2 class="text-3xl font-black text-gray-900 capitalize tracking-tight">{{ $laporan->judul_laporan }}</h2>
                <p class="text-gray-500 font-medium mt-1">
                    <i class="far fa-calendar-alt mr-2 text-indigo-500"></i> Dilaporkan pada {{ \Carbon\Carbon::parse($laporan->tgl_lapor)->format('d F Y') }}
                </p>
            </div>
            <div class="flex flex-col items-end gap-2">
                <span class="text-[9px] font-black text-gray-300 uppercase tracking-[0.2em]">Status Investigasi</span>
                <span class="status-badge status-{{ strtolower($laporan->status ?? 'pending') }}">
                    {{ $laporan->status ?? 'pending' }}
                </span>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-xl mb-8 flex items-center shadow-sm">
                <i class="fas fa-check-circle mr-3"></i>
                <p class="text-sm font-bold">{{ session('success') }}</p>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            {{-- KOLOM KIRI: BUKTI VISUAL --}}
            <div class="lg:col-span-1">
                <h3 class="label-text mb-4 flex items-center">
                    <i class="fas fa-camera mr-2 text-indigo-500"></i> Bukti Lampiran Foto
                </h3>

                @if($laporan->bukti_kejadian)
                    <div class="evidence-container">
                        <img src="{{ asset('storage/' . $laporan->bukti_kejadian) }}" alt="Bukti Kejadian" class="evidence-img">
                        <div class="p-3 bg-white border-t border-gray-100 text-center">
                            <a href="{{ asset('storage/' . $laporan->bukti_kejadian) }}" target="_blank" class="text-[9px] font-bold text-indigo-500 hover:underline uppercase tracking-widest">
                                <i class="fas fa-search-plus mr-1"></i> Lihat Ukuran Penuh
                            </a>
                        </div>
                    </div>
                @else
                    <div class="w-full aspect-square bg-gray-50 rounded-2xl flex flex-col items-center justify-center text-gray-300 border-2 border-dashed border-gray-200">
                        <i class="fas fa-image text-5xl mb-3"></i>
                        <p class="text-[10px] font-bold uppercase tracking-tighter">Tidak ada foto terlampir</p>
                    </div>
                @endif
            </div>

            {{-- KOLOM KANAN: DATA & DESKRIPSI --}}
            <div class="lg:col-span-2 space-y-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="info-block">
                        <span class="label-text">Kategori Kejadian</span>
                        <div class="flex items-center">
                            <i class="fas fa-tag mr-2 text-indigo-400 text-xs"></i>
                            <p class="value-text text-indigo-600 uppercase">{{ $laporan->kategori ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="info-block">
                        <span class="label-text">Identitas Laporan</span>
                        <div class="flex items-center">
                            <i class="fas fa-fingerprint mr-2 text-gray-400 text-xs"></i>
                            <p class="value-text">ID #{{ $laporan->id }}</p>
                        </div>
                    </div>
                    <div class="info-block sm:col-span-2">
                        <span class="label-text">Identifikasi Pelapor (Audit Sistem)</span>
                        <div class="flex items-center">
                            <i class="fas fa-network-wired mr-3 text-gray-300 text-xs"></i>
                            <p class="value-text font-mono text-[11px] text-gray-500">{{ $laporan->ip_terlapor ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="label-text mb-3">Kronologi / Deskripsi Kejadian</h3>
                    <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100 text-sm text-gray-700 flex items-start group hover:border-red-200 transition-colors italic">
                        "{{ $laporan->deskripsi ?? 'Tidak ada deskripsi tersedia.' }}"
                    </div>
                </div>

                <div>
                    <h3 class="label-text mb-3">Lokasi Kejadian</h3>
                    <div class="p-5 bg-gray-50 rounded-2xl border border-gray-100 text-sm text-gray-700 flex items-start group hover:border-red-200 transition-colors">
                        <i class="fas fa-map-marked-alt mr-4 mt-1 text-red-500 group-hover:scale-110 transition-transform"></i>
                        <span class="font-medium leading-relaxed">{{ $laporan->lokasi_kejadian ?? 'Lokasi tidak spesifik dalam keterangan.' }}</span>
                    </div>
                </div>

                {{-- STATUS PETUGAS PENANGANAN --}}
                <div class="pt-6 border-t">
                    <h3 class="text-lg font-black text-gray-800 mb-6 flex items-center tracking-tight">
                        <i class="fas fa-user-shield mr-3 text-indigo-600"></i> Status Penanganan Petugas
                    </h3>

                    @if ($laporan->polisi)
                        <div class="bg-indigo-600 rounded-3xl p-6 text-white shadow-xl flex items-center gap-6 transform hover:scale-[1.01] transition-transform">
                            <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center text-3xl shadow-inner backdrop-blur-sm">
                                <i class="fas fa-id-badge"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold uppercase text-indigo-200 tracking-[0.2em] mb-1">Ditangani Oleh Petugas:</p>
                                <p class="text-2xl font-black leading-none">{{ $laporan->polisi->nama }}</p>
                                <p class="text-xs font-medium text-indigo-100 mt-2 flex items-center">
                                    <span class="bg-white/10 px-2 py-0.5 rounded mr-2 border border-white/10 uppercase tracking-tighter">{{ $laporan->polisi->jabatan ?? 'Petugas Khusus' }}</span>
                                    Investigasi Sedang Berlangsung
                                </p>
                            </div>
                        </div>
                    @else
                        <div class="bg-yellow-50 border-l-8 border-yellow-400 p-6 rounded-2xl flex items-center gap-5 shadow-sm border border-yellow-100">
                            <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center text-yellow-600 text-xl shadow-inner">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <p class="font-bold text-yellow-900 uppercase text-xs tracking-widest">Menunggu Penugasan</p>
                                <p class="text-[11px] text-yellow-700 font-medium mt-1">Laporan Anda telah terdaftar di sistem pusat. Tim kami akan segera menugaskan petugas terdekat untuk menangani kasus ini.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>

<footer class="mt-auto py-8 text-center text-gray-400 text-xs font-medium">
    &copy; {{ date('Y') }} Crime Alert Report System. Seluruh hak cipta dilindungi.
</footer>

</body>
</html>
