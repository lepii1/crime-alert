<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Pengaturan Akun - Admin Crime Alert</title>

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

        .profile-card { background: #fff; border-radius: 24px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #edf2f7; transition: 0.3s; }
        .profile-card:hover { box-shadow: 0 20px 25px -5px rgba(0,0,0,0.05); }

        .section-header { @apply flex items-center gap-3 mb-8 border-b pb-4; }
        .section-title { @apply text-lg font-black text-gray-800 uppercase tracking-tight; }
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
                <a href="{{ route('admin.laporan.index') }}"><i class="fas fa-bell mr-3 w-5 text-center"></i> Laporan Masuk</a>
                <a href="{{ route('admin.laporan.reports') }}"><i class="fas fa-chart-bar mr-3 w-5 text-center"></i> Analisis Visual</a>
                <a href="{{ route('profile.edit') }}" class="active"><i class="fas fa-cog mr-3 w-5 text-center"></i> Pengaturan</a>
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
                    <span class="text-[10px] font-black text-gray-300 uppercase tracking-[0.2em]">Manajemen Identitas</span>
                </div>
                <h1 class="text-3xl font-black text-gray-800 tracking-tight">Pengaturan Profil</h1>
                <p class="text-gray-500 font-medium">Perbarui informasi akun dan keamanan Anda.</p>
            </div>
            <div class="flex items-center gap-3 bg-white px-5 py-2.5 rounded-2xl shadow-sm border text-xs font-bold text-gray-400 uppercase tracking-widest">
                <i class="fas fa-user-shield text-indigo-500"></i> Akun Terverifikasi
            </div>
        </div>

        <div class="max-w-5xl space-y-10">

            {{-- KARTU 1: Informasi Profil --}}
            <div class="profile-card p-8 sm:p-10">
                <div class="section-header">
                    <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-user-edit"></i>
                    </div>
                    <h2 class="section-title">Informasi Dasar</h2>
                </div>
                <div class="max-w-2xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- KARTU 2: Update Password --}}
            <div class="profile-card p-8 sm:p-10">
                <div class="section-header">
                    <div class="w-10 h-10 bg-yellow-50 text-yellow-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-key"></i>
                    </div>
                    <h2 class="section-title">Keamanan Sandi</h2>
                </div>
                <div class="max-w-2xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- KARTU 3: Delete Account (Hazard Zone) --}}
            <div class="profile-card p-8 sm:p-10 border-red-100 bg-red-50/10">
                <div class="section-header border-red-100">
                    <div class="w-10 h-10 bg-red-50 text-red-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-trash-alt"></i>
                    </div>
                    <h2 class="section-title text-red-800">Zona Berbahaya</h2>
                </div>
                <div class="max-w-2xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</div>

<footer class="py-12 text-center text-gray-400 text-[10px] font-bold uppercase tracking-[0.3em]">
    Crime Alert Security System &bull; Identity Protection {{ date('Y') }}
</footer>

</body>
</html>
