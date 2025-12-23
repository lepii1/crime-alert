<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil Saya - Crime Alert</title>

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

        /* Profile Specific Styles */
        .card-profile { background: #fff; border-radius: 20px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05); overflow: hidden; max-width: 800px; margin: 0 auto; }
        .info-label { @apply block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1; }
        .info-value { @apply text-base font-semibold text-gray-800; }
        .info-item { @apply p-4 bg-gray-50 rounded-xl border border-gray-100 transition hover:bg-white hover:shadow-md; }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body x-data="{ open: false }">

{{-- MOBILE MENU TOGGLE --}}
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
                <a href="{{ route('polisi.profil') }}" class="active"><i class="fas fa-user-circle mr-3"></i> Profil Saya</a>
            </nav>
            <div class="p-4 border-t border-gray-800">
                <form method="POST" action="{{ route('polisi.logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full text-left p-3 rounded-lg text-red-400 font-medium hover:bg-gray-800 transition">
                        <i class="fas fa-sign-out-alt mr-3"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- OVERLAY MOBILE --}}
    <div x-show="open" @click="open = false" class="fixed inset-0 bg-black/50 z-40 lg:hidden" style="display: none;"></div>

    {{-- MAIN CONTENT --}}
    <div class="main-content w-full">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">Profil Polisi</h1>
                <p class="text-gray-500 text-sm mt-1">Informasi akun resmi Polisi kepolisian</p>
            </div>
            <div class="flex space-x-3" style="padding-right: 35px">
                <a href="{{ route('polisi.edit') }}" class="bg-yellow-500 hover:bg-yellow-600 text-black px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider transition shadow-lg active:scale-95">
                    <i class="fas fa-edit mr-2"></i> Edit Profil
                </a>
            </div>
        </div>

        <div class="card-profile">
            {{-- Bagian Header Visual --}}
            <div class="bg-gradient-to-r from-blue-700 to-blue-500 h-32 relative">
                <div class="absolute -bottom-16 left-8">
                    @if($polisi->avatar)
                        <img src="{{ asset('storage/' . $polisi->avatar) }}" class="w-32 h-32 rounded-3xl object-cover border-4 border-white shadow-2xl bg-white">
                    @else
                        <div class="w-32 h-32 rounded-3xl bg-gray-200 border-4 border-white shadow-2xl flex items-center justify-center text-4xl font-bold text-gray-400">
                            {{ strtoupper(substr($polisi->nama, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <div class="absolute bottom-4 left-44 text-white">
                    <h2 class="text-2xl font-bold leading-none">{{ $polisi->nama }}</h2>
                    <p class="text-blue-100 text-sm mt-1 opacity-90">{{ $polisi->jabatan ?? 'Polisi Lapangan' }}</p>
                </div>
            </div>

            <div class="pt-20 px-8 pb-10">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Detail Akun --}}
                    <div class="info-item">
                        <span class="info-label">Nama Lengkap</span>
                        <div class="flex items-center">
                            <i class="fas fa-user-tag text-blue-500 mr-3 text-sm"></i>
                            <p class="info-value">{{ $polisi->nama }}</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Alamat Email</span>
                        <div class="flex items-center">
                            <i class="fas fa-envelope text-blue-500 mr-3 text-sm"></i>
                            <p class="info-value">{{ $polisi->email }}</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Nomor Telepon / HP</span>
                        <div class="flex items-center">
                            <i class="fas fa-phone-alt text-blue-500 mr-3 text-sm"></i>
                            <p class="info-value">{{ $polisi->no_hp ?? 'Belum Ditentukan' }}</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Jabatan Struktural</span>
                        <div class="flex items-center">
                            <i class="fas fa-shield-alt text-blue-500 mr-3 text-sm"></i>
                            <p class="info-value">{{ $polisi->jabatan ?? 'Polisi Penanganan' }}</p>
                        </div>
                    </div>

                    <div class="info-item md:col-span-2">
                        <span class="info-label">Masa Aktif Akun (Dibuat Pada)</span>
                        <div class="flex items-center">
                            <i class="fas fa-calendar-check text-blue-500 mr-3 text-sm"></i>
                            <p class="info-value">{{ $polisi->created_at->format('d F Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-10 pt-6 border-t border-gray-100 flex flex-col md:flex-row items-center justify-between gap-4">
                    <div class="text-xs text-gray-400 font-medium italic">
                        <i class="fas fa-info-circle mr-1"></i> Pastikan data profil Anda selalu akurat untuk mempermudah koordinasi.
                    </div>
                    <a href="{{ route('polisi.dashboard') }}" class="w-full md:w-auto text-center px-8 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl transition uppercase text-[10px] tracking-widest">
                        Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
