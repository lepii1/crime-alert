{{--<!DOCTYPE html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--    <title>{{ config('app.name', 'Crime Alert') }}</title>--}}

{{--    <!-- Tailwind CSS -->--}}
{{--    @vite(['resources/css/app.css', 'resources/js/app.js'])--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>--}}

{{--    <style>--}}
{{--        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap');--}}

{{--        body {--}}
{{--            font-family: 'Poppins', sans-serif;--}}
{{--            background-color: #f0f2f5;--}}
{{--            color: #333;--}}
{{--        }--}}

{{--        /* Navigasi */--}}
{{--        .nav-header {--}}
{{--            background-color: #2c3e50; /* Warna Sidebar Admin */--}}
{{--            box-shadow: 0 4px 12px rgba(0,0,0,0.1);--}}
{{--        }--}}
{{--        .nav-logo-icon {--}}
{{--            color: #e74c3c; /* Aksen Merah */--}}
{{--        }--}}

{{--        /* Hero Section */--}}
{{--        .hero-section {--}}
{{--            background-image: url('https://placehold.co/1200x400/2c3e50/e74c3c?text=Crime+Alert');--}}
{{--            background-size: cover;--}}
{{--            background-position: center;--}}
{{--            height: 400px;--}}
{{--            display: flex;--}}
{{--            align-items: center;--}}
{{--            justify-content: center;--}}
{{--            color: white;--}}
{{--            text-align: center;--}}
{{--            position: relative;--}}
{{--            z-index: 1;--}}
{{--        }--}}
{{--        .hero-overlay {--}}
{{--            position: absolute;--}}
{{--            top: 0;--}}
{{--            left: 0;--}}
{{--            right: 0;--}}
{{--            bottom: 0;--}}
{{--            background-color: rgba(0, 0, 0, 0.4);--}}
{{--            z-index: 2;--}}
{{--        }--}}
{{--        .hero-content {--}}
{{--            z-index: 3;--}}
{{--            max-width: 800px;--}}
{{--        }--}}
{{--        .hero-content h1 {--}}
{{--            font-size: 3em;--}}
{{--            font-weight: 800;--}}
{{--            margin: 0;--}}
{{--            text-shadow: 2px 2px 5px rgba(0,0,0,0.7);--}}
{{--        }--}}
{{--        .hero-content p {--}}
{{--            font-size: 1.5em;--}}
{{--            margin: 10px 0 20px;--}}
{{--            font-weight: 400;--}}
{{--        }--}}

{{--        .features-section {--}}
{{--            padding: 80px 20px;--}}
{{--            background-color: white;--}}
{{--            text-align: center;--}}
{{--        }--}}
{{--        .features-section h2 {--}}
{{--            color: #2c3e50;--}}
{{--            font-weight: 700;--}}
{{--            font-size: 2.2em;--}}
{{--            margin-bottom: 40px;--}}
{{--        }--}}
{{--        .feature-item {--}}
{{--            padding: 20px;--}}
{{--            border-radius: 10px;--}}
{{--            transition: transform 0.3s, box-shadow 0.3s;--}}
{{--        }--}}
{{--        .feature-item:hover {--}}
{{--            transform: translateY(-5px);--}}
{{--            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);--}}
{{--        }--}}
{{--        .feature-icon {--}}
{{--            color: #e74c3c;--}}
{{--            font-size: 3.5em;--}}
{{--            margin-bottom: 15px;--}}
{{--        }--}}

{{--        .cta-section {--}}
{{--            background-color: #2c3e50;--}}
{{--            color: white;--}}
{{--            padding: 60px 20px;--}}
{{--            text-align: center;--}}
{{--        }--}}
{{--        .cta-section button {--}}
{{--            background-color: #e74c3c;--}}
{{--            color: white;--}}
{{--            border: none;--}}
{{--            padding: 15px 40px;--}}
{{--            font-size: 1.2em;--}}
{{--            cursor: pointer;--}}
{{--            border-radius: 8px;--}}
{{--            font-weight: 600;--}}
{{--            transition: background-color 0.3s;--}}
{{--            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);--}}
{{--        }--}}
{{--        .cta-section button:hover {--}}
{{--            background-color: #c0392b;--}}
{{--        }--}}

{{--        footer {--}}
{{--            background-color: #333;--}}
{{--            color: #ccc;--}}
{{--            text-align: center;--}}
{{--            padding: 20px;--}}
{{--            font-size: 0.9em;--}}
{{--        }--}}
{{--    </style>--}}

{{--    <!-- Font Awesome for icons -->--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">--}}
{{--</head>--}}
{{--<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex flex-col min-h-screen">--}}

{{--<nav class="nav-header fixed w-full top-0 z-40 py-4 shadow-md">--}}
{{--    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">--}}
{{--        <div class="flex items-center">--}}
{{--            <i class="fas fa-exclamation-triangle mr-3 nav-logo-icon text-2xl"></i>--}}
{{--            <span class="text-white text-xl font-semibold">CRIME ALERT</span>--}}
{{--        </div>--}}

{{--        @if (Route::has('login'))--}}
{{--            <div class="flex items-center space-x-4">--}}
{{--                @auth--}}
{{--                    --}}{{-- Jika sudah login --}}
{{--                    @if (Auth::user()->role === 'admin')--}}
{{--                        <a href="{{ url('/admin/dashboard') }}" class="text-white hover:text-gray-300 transition text-sm">Dashboard Admin</a>--}}
{{--                    @else--}}
{{--                        <a href="{{ url('/user/dashboard') }}" class="text-white hover:text-gray-300 transition text-sm">Dashboard Saya</a>--}}
{{--                    @endif--}}
{{--                @else--}}
{{--                    --}}{{-- Belum Login --}}
{{--                    <a href="{{ route('login') }}" class="px-4 py-2 text-white border border-white rounded-lg hover:bg-white hover:text-black transition text-sm">--}}
{{--                        Log in--}}
{{--                    </a>--}}

{{--                    @if (Route::has('register'))--}}
{{--                        <a href="{{ route('register') }}" class="px-4 py-2 bg-[#e74c3c] text-white rounded-lg hover:bg-[#c0392b] transition text-sm font-medium">--}}
{{--                            Register--}}
{{--                        </a>--}}
{{--                    @endif--}}
{{--                @endauth--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    </div>--}}
{{--</nav>--}}

{{--<main class="flex-grow pt-[80px]"> --}}{{-- Padding top disesuaikan dengan tinggi nav --}}

{{--    --}}{{-- SECTION 1: HERO --}}
{{--    <section class="hero-section">--}}
{{--        <div class="hero-overlay"></div>--}}
{{--        <div class="hero-content">--}}
{{--            <h1>Lindungi Diri Anda dan Komunitas</h1>--}}
{{--            <p>Dapatkan peringatan kejahatan di sekitar Anda dan laporkan insiden dengan cepat dan rahasia.</p>--}}

{{--            @guest--}}
{{--                <a href="{{ route('register') }}">--}}
{{--                    <button class="bg-[#e74c3c] text-white px-8 py-3 rounded-lg font-semibold hover:bg-[#c0392b] transition mt-4">--}}
{{--                        Mulai Sekarang--}}
{{--                    </button>--}}
{{--                </a>--}}
{{--            @endguest--}}
{{--            @auth--}}
{{--                <a href="{{ url('/user/dashboard') }}">--}}
{{--                    <button class="bg-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition mt-4">--}}
{{--                        Lihat Dashboard Anda--}}
{{--                    </button>--}}
{{--                </a>--}}
{{--            @endauth--}}
{{--        </div>--}}
{{--    </section>--}}

{{--    --}}{{-- SECTION 2: FEATURES --}}
{{--    <section class="features-section">--}}
{{--        <h2>Fitur Utama Crime Alert</h2>--}}
{{--        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-7xl mx-auto">--}}

{{--            <div class="feature-item">--}}
{{--                <i class="fas fa-bell feature-icon"></i>--}}
{{--                <h3>Laporkan Kejahatan</h3>--}}
{{--                <p class="text-gray-600">Kirim laporan insiden secara cepat dan anonim langsung ke petugas yang berwenang.</p>--}}
{{--            </div>--}}

{{--            <div class="feature-item">--}}
{{--                <i class="fas fa-map-marker-alt feature-icon"></i>--}}
{{--                <h3>Pelacakan Real-Time</h3>--}}
{{--                <p class="text-gray-600">Lacak status laporan Anda dan lihat perkembangan penanganan oleh pihak kepolisian.</p>--}}
{{--            </div>--}}

{{--            <div class="feature-item">--}}
{{--                <i class="fas fa-chart-line feature-icon"></i>--}}
{{--                <h3>Analisis Tren</h3>--}}
{{--                <p class="text-gray-600">Admin dapat menganalisis data dan tren kejahatan untuk peningkatan keamanan wilayah.</p>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--    </section>--}}

{{--    --}}{{-- SECTION 3: CALL TO ACTION --}}
{{--    <section class="cta-section">--}}
{{--        <h2>Siap Melindungi Diri dan Komunitas Anda?</h2>--}}
{{--        <p class="mb-6">Daftar sekarang untuk mendapatkan akses penuh ke sistem pelaporan dan peringatan kejahatan.</p>--}}

{{--        <a href="{{ route('register') }}">--}}
{{--            <button>Daftar Akun Gratis</button>--}}
{{--        </a>--}}
{{--    </section>--}}


{{--</main>--}}

{{--<footer class="w-full py-4 text-center text-xs text-[#ccc]">--}}
{{--    &copy; {{ date('Y') }} Crime Alert. All rights reserved.--}}
{{--</footer>--}}

{{--</body>--}}
{{--</html>--}}

    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Crime Alert') }}</title>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- SweetAlert2 untuk Konfirmasi SOS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            color: #333;
        }

        /* Navigasi */
        .nav-header {
            background-color: #2c3e50;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .nav-logo-icon {
            color: #e74c3c;
        }

        /* Hero Section */
        .hero-section {
            background-image: linear-gradient(rgba(44, 62, 80, 0.8), rgba(44, 62, 80, 0.9)),
            url('https://images.unsplash.com/photo-1500673922987-e212871fec22?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            min-height: 550px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            position: relative;
            z-index: 1;
        }
        .hero-content {
            z-index: 3;
            max-width: 800px;
            padding: 40px 20px;
        }
        .hero-content h1 {
            font-size: 3em;
            font-weight: 800;
            margin: 20px 0 10px;
            text-shadow: 2px 2px 5px rgba(0,0,0,0.7);
        }

        /* --- STYLE TOMBOL SOS BARU --- */
        .sos-wrapper {
            position: relative;
            display: inline-block;
            margin-bottom: 10px;
        }
        .btn-sos-main {
            @apply flex flex-col items-center justify-center bg-red-600 text-white w-40 h-40 md:w-52 md:h-52 rounded-full
            shadow-[0_0_50px_rgba(231,76,60,0.5)] transition-all active:scale-90 border-[10px] border-white/10
            hover:bg-red-700 relative z-10;
        }
        .pulse-ring {
            @apply absolute inset-0 rounded-full bg-red-600 opacity-40 animate-ping;
        }
        /* ---------------------------- */

        .features-section {
            padding: 80px 20px;
            background-color: white;
            text-align: center;
        }
        .features-section h2 {
            color: #2c3e50;
            font-weight: 700;
            font-size: 2.2em;
            margin-bottom: 40px;
        }
        .feature-item {
            padding: 20px;
            border-radius: 10px;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .feature-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .feature-icon {
            color: #e74c3c;
            font-size: 3.5em;
            margin-bottom: 15px;
        }

        .cta-section {
            background-color: #2c3e50;
            color: white;
            padding: 60px 20px;
            text-align: center;
        }
        .cta-section button {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 15px 40px;
            font-size: 1.2em;
            cursor: pointer;
            border-radius: 8px;
            font-weight: 600;
            transition: background-color 0.3s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }
        .cta-section button:hover {
            background-color: #c0392b;
        }

        footer {
            background-color: #333;
            color: #ccc;
            text-align: center;
            padding: 20px;
            font-size: 0.9em;
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body x-data="{ isSending: false }" class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex flex-col min-h-screen">

<nav class="nav-header fixed w-full top-0 z-40 py-4 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <div class="flex items-center">
            <i class="fas fa-exclamation-triangle mr-3 nav-logo-icon text-2xl"></i>
            <span class="text-white text-xl font-semibold">CRIME ALERT</span>
        </div>

        @if (Route::has('login'))
            <div class="flex items-center space-x-4">
                @auth
                    @if (Auth::user()->role === 'admin')
                        <a href="{{ url('/admin/dashboard') }}" class="text-white hover:text-gray-300 transition text-sm font-bold uppercase tracking-widest">Dashboard Admin</a>
                    @else
                        <a href="{{ url('/user/dashboard') }}" class="text-white hover:text-gray-300 transition text-sm font-bold uppercase tracking-widest">Dashboard Saya</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 text-white border border-white rounded-lg hover:bg-white hover:text-black transition text-sm font-bold uppercase tracking-widest">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-[#e74c3c] text-white rounded-lg hover:bg-[#c0392b] transition text-sm font-bold uppercase tracking-widest">
                            Register
                        </a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</nav>

<main class="flex-grow pt-[80px]">

    {{-- SECTION 1: HERO DENGAN TOMBOL SOS --}}
    <section class="hero-section">
        <div class="hero-content">

            {{-- TOMBOL SOS BARU --}}
            <div class="sos-wrapper">
                <div class="pulse-ring"></div>
                <button @click="triggerPublicSOS()" :disabled="isSending" class="btn-sos-main group">
                    <template x-if="!isSending">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-bell text-4xl md:text-5xl mb-2 animate-bounce"></i>
                            <span class="text-xl md:text-2xl font-black tracking-[0.2em]">S O S</span>
                        </div>
                    </template>
                    <template x-if="isSending">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-spinner fa-spin text-4xl mb-2"></i>
                            <span class="text-[10px] font-bold uppercase tracking-widest">Mengirim...</span>
                        </div>
                    </template>
                </button>
            </div>

            <h1>Lindungi Diri Anda dan Komunitas</h1>
            <p class="text-gray-200">Keadaan darurat? Tekan tombol SOS di atas untuk mengirim lokasi GPS Anda langsung ke pihak keamanan.</p>

            <div class="flex justify-center gap-4 mt-6">
                @guest
                    <a href="{{ route('register') }}" class="bg-[#e74c3c] text-white px-8 py-3 rounded-lg font-bold hover:bg-[#c0392b] transition uppercase tracking-widest text-xs">
                        Mulai Sekarang
                    </a>
                @else
                    <a href="{{ url('/user/dashboard') }}" class="bg-indigo-600 text-white px-8 py-3 rounded-lg font-bold hover:bg-indigo-700 transition uppercase tracking-widest text-xs">
                        Lihat Dashboard Anda
                    </a>
                @endauth
            </div>
        </div>
    </section>

    {{-- SECTION 2: FEATURES --}}
    <section class="features-section">
        <h2 class="uppercase tracking-tighter">Fitur Utama Crime Alert</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-7xl mx-auto px-6">

            <div class="feature-item">
                <i class="fas fa-bell feature-icon"></i>
                <h3 class="font-bold text-gray-800 uppercase text-sm tracking-widest mb-2">Laporkan Kejahatan</h3>
                <p class="text-gray-500 text-sm">Kirim laporan insiden secara cepat dan anonim langsung ke petugas yang berwenang.</p>
            </div>

            <div class="feature-item">
                <i class="fas fa-map-marker-alt feature-icon"></i>
                <h3 class="font-bold text-gray-800 uppercase text-sm tracking-widest mb-2">Pelacakan Real-Time</h3>
                <p class="text-gray-500 text-sm">Lacak status laporan Anda dan lihat perkembangan penanganan oleh pihak kepolisian.</p>
            </div>

            <div class="feature-item">
                <i class="fas fa-chart-line feature-icon"></i>
                <h3 class="font-bold text-gray-800 uppercase text-sm tracking-widest mb-2">Analisis Tren</h3>
                <p class="text-gray-500 text-sm">Admin dapat menganalisis data dan tren kejahatan untuk peningkatan keamanan wilayah.</p>
            </div>

        </div>
    </section>

    {{-- SECTION 3: CALL TO ACTION --}}
    <section class="cta-section">
        <h2 class="font-black uppercase tracking-tight mb-2 text-2xl">Siap Melindungi Diri dan Komunitas?</h2>
        <p class="text-gray-300 text-sm mb-8">Daftar sekarang untuk mendapatkan akses penuh ke sistem pelaporan dan peringatan kejahatan.</p>

        <a href="{{ route('register') }}">
            <button class="uppercase tracking-[0.2em] text-[10px] font-black">Daftar Akun Gratis</button>
        </a>
    </section>

</main>

<footer class="w-full py-6 text-center text-[10px] text-[#777] font-bold uppercase tracking-[0.3em]">
    &copy; {{ date('Y') }} Crime Alert Security Protocol &bull; All rights reserved.
</footer>

<script>
    function triggerPublicSOS() {
        Swal.fire({
            title: 'Kirim Sinyal Darurat?',
            text: "Laporan akan dikirim sebagai 'Laporan Anonim' menggunakan koordinat GPS Anda saat ini.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e74c3c',
            cancelButtonColor: '#2c3e50',
            confirmButtonText: 'YA, SAYA BUTUH BANTUAN',
            cancelButtonText: 'BATALKAN'
        }).then((result) => {
            if (result.isConfirmed) {
                this.isSending = true;
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition((position) => {
                        fetch("{{ route('public.sos') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                latitude: position.coords.latitude,
                                longitude: position.coords.longitude
                            })
                        })
                            .then(res => res.json())
                            .then(data => {
                                this.isSending = false;
                                Swal.fire('Berhasil!', 'Pusat komando telah menerima koordinat Anda. Tetap tenang, bantuan sedang dikerahkan.', 'success');
                            })
                            .catch(err => {
                                this.isSending = false;
                                Swal.fire('Error', 'Gagal terhubung dengan server pusat.', 'error');
                            });
                    }, () => {
                        this.isSending = false;
                        Swal.fire('Gagal', 'Sistem membutuhkan izin lokasi untuk mengirim bantuan ke posisi Anda.', 'error');
                    });
                } else {
                    this.isSending = false;
                    Swal.fire('Gagal', 'Browser Anda tidak mendukung pelacakan GPS.', 'error');
                }
            }
        });
    }
</script>

</body>
</html>
