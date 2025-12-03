<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Crime Alert') }}</title>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            color: #333;
        }

        /* Navigasi */
        .nav-header {
            background-color: #2c3e50; /* Warna Sidebar Admin */
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .nav-logo-icon {
            color: #e74c3c; /* Aksen Merah */
        }

        /* Hero Section */
        .hero-section {
            background-image: url('https://placehold.co/1200x400/2c3e50/e74c3c?text=Crime+Alert');
            background-size: cover;
            background-position: center;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            position: relative;
            z-index: 1;
        }
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.4);
            z-index: 2;
        }
        .hero-content {
            z-index: 3;
            max-width: 800px;
        }
        .hero-content h1 {
            font-size: 3em;
            font-weight: 800;
            margin: 0;
            text-shadow: 2px 2px 5px rgba(0,0,0,0.7);
        }
        .hero-content p {
            font-size: 1.5em;
            margin: 10px 0 20px;
            font-weight: 400;
        }

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

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex flex-col min-h-screen">

<nav class="nav-header fixed w-full top-0 z-40 py-4 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <div class="flex items-center">
            <i class="fas fa-exclamation-triangle mr-3 nav-logo-icon text-2xl"></i>
            <span class="text-white text-xl font-semibold">CRIME ALERT</span>
        </div>

        @if (Route::has('login'))
            <div class="flex items-center space-x-4">
                @auth
                    {{-- Jika sudah login --}}
                    @if (Auth::user()->role === 'admin')
                        <a href="{{ url('/admin/dashboard') }}" class="text-white hover:text-gray-300 transition text-sm">Dashboard Admin</a>
                    @else
                        <a href="{{ url('/user/dashboard') }}" class="text-white hover:text-gray-300 transition text-sm">Dashboard Saya</a>
                    @endif
                @else
                    {{-- Belum Login --}}
                    <a href="{{ route('login') }}" class="px-4 py-2 text-white border border-white rounded-lg hover:bg-white hover:text-black transition text-sm">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-[#e74c3c] text-white rounded-lg hover:bg-[#c0392b] transition text-sm font-medium">
                            Register
                        </a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</nav>

<main class="flex-grow pt-[80px]"> {{-- Padding top disesuaikan dengan tinggi nav --}}

    {{-- SECTION 1: HERO --}}
    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Lindungi Diri Anda dan Komunitas</h1>
            <p>Dapatkan peringatan kejahatan di sekitar Anda dan laporkan insiden dengan cepat dan rahasia.</p>

            @guest
                <a href="{{ route('register') }}">
                    <button class="bg-[#e74c3c] text-white px-8 py-3 rounded-lg font-semibold hover:bg-[#c0392b] transition mt-4">
                        Mulai Sekarang
                    </button>
                </a>
            @endguest
            @auth
                <a href="{{ url('/user/dashboard') }}">
                    <button class="bg-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition mt-4">
                        Lihat Dashboard Anda
                    </button>
                </a>
            @endauth
        </div>
    </section>

    {{-- SECTION 2: FEATURES --}}
    <section class="features-section">
        <h2>Fitur Utama Crime Alert</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-7xl mx-auto">

            <div class="feature-item">
                <i class="fas fa-bell feature-icon"></i>
                <h3>Laporkan Kejahatan</h3>
                <p class="text-gray-600">Kirim laporan insiden secara cepat dan anonim langsung ke petugas yang berwenang.</p>
            </div>

            <div class="feature-item">
                <i class="fas fa-map-marker-alt feature-icon"></i>
                <h3>Pelacakan Real-Time</h3>
                <p class="text-gray-600">Lacak status laporan Anda dan lihat perkembangan penanganan oleh pihak kepolisian.</p>
            </div>

            <div class="feature-item">
                <i class="fas fa-chart-line feature-icon"></i>
                <h3>Analisis Tren</h3>
                <p class="text-gray-600">Admin dapat menganalisis data dan tren kejahatan untuk peningkatan keamanan wilayah.</p>
            </div>

        </div>
    </section>

    {{-- SECTION 3: CALL TO ACTION --}}
    <section class="cta-section">
        <h2>Siap Melindungi Diri dan Komunitas Anda?</h2>
        <p class="mb-6">Daftar sekarang untuk mendapatkan akses penuh ke sistem pelaporan dan peringatan kejahatan.</p>

        <a href="{{ route('register') }}">
            <button>Daftar Akun Gratis</button>
        </a>
    </section>


</main>

<footer class="w-full py-4 text-center text-xs text-[#ccc]">
    &copy; {{ date('Y') }} Crime Alert. All rights reserved.
</footer>

</body>
</html>
