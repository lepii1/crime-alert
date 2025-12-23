<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profil - Crime Alert</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

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

        .card-edit { background: #fff; border-radius: 15px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1); overflow: hidden; max-width: 600px; margin: 0 auto; }
        .input-field { border-radius: 5px; @apply w-full mt-1 p-3 border border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all outline-none text-sm; }
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
                <a href="{{ route('polisi.profil') }}" class="active"><i class="fas fa-user-circle mr-3"></i> Profil Saya</a>
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

    <div x-show="open" @click="open = false" class="fixed inset-0 bg-black/50 z-40 lg:hidden"></div>

    {{-- MAIN CONTENT --}}
    <div class="main-content w-full">
        <div class="mb-8 flex items-center justify-between">
            <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">Edit Profil</h1>
            <a href="{{ route('polisi.profil') }}" class="text-sm font-bold text-gray-500 hover:text-gray-800 flex items-center" style="padding-right: 35px">
                <i class="fas fa-arrow-left mr-2"></i> KEMBALI
            </a>
        </div>

        <div class="card-edit">
            <div class="bg-blue-600 h-24"></div>
            <div class="px-8 pb-10 -mt-12">
                <form action="{{ route('polisi.update', $polisi->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="flex justify-center mb-8 relative">
                        @if($polisi->avatar)
                            <img src="{{ asset('storage/'.$polisi->avatar) }}" class="w-32 h-32 rounded-3xl object-cover border-4 border-white shadow-xl">
                        @else
                            <div class="w-32 h-32 rounded-3xl bg-gray-200 border-4 border-white shadow-xl flex items-center justify-center text-4xl font-bold text-gray-400">
                                {{ strtoupper(substr($polisi->nama, 0, 1)) }}
                            </div>
                        @endif
                        <label class="absolute bottom-0 right-1/3 bg-white p-2 rounded-full shadow-lg border cursor-pointer hover:bg-gray-50 transition">
                            <i class="fas fa-camera text-blue-600"></i>
                            <input type="file" name="foto" class="hidden">
                        </label>
                    </div>

                    <div class="space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="text-xs font-bold text-gray-400 uppercase tracking-widest">Nama Lengkap</label>
                                <input type="text" name="nama" value="{{ $polisi->nama }}" class="input-field">
                            </div>
                            <div>
                                <label class="text-xs font-bold text-gray-400 uppercase tracking-widest">Jabatan</label>
                                <input type="text" name="jabatan" value="{{ $polisi->jabatan }}" class="input-field">
                            </div>
                        </div>

                        <div>
                            <label class="text-xs font-bold text-gray-400 uppercase tracking-widest">Alamat Email</label>
                            <input type="email" name="email" value="{{ $polisi->email }}" class="input-field">
                        </div>

                        <div>
                            <label class="text-xs font-bold text-gray-400 uppercase tracking-widest">Nomor Telepon</label>
                            <input type="text" name="telepon" value="{{ $polisi->no_hp }}" class="input-field" placeholder="08xxxx">
                        </div>

                        <div class="pt-6">
                            <button type="submit" class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-2xl shadow-xl transition-all active:scale-95 uppercase tracking-wider text-sm">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
