<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Edit Laporan - Crime Alert</title>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Alpine.js untuk interaksi sidebar di mobile -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        /* CSS Tema Dashboard */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
        }
        .flex-container {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR RESPONSIVE (Code ini memastikan konsistensi tema) */
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 20px 0;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            z-index: 50;
            transition: transform 0.3s ease-in-out;
            transform: translateX(-100%);
        }
        @media (min-width: 1024px) {
            .sidebar {
                transform: translateX(0);
            }
        }
        .sidebar-open {
            transform: translateX(0) !important;
        }
        .sidebar-header {
            display: flex;
            align-items: center;
            padding: 0 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 20px;
        }
        .sidebar-header h2 {
            font-size: 1.2rem;
            font-weight: 600;
            padding-left: 10px;
        }
        .sidebar-nav ul {
            list-style: none;
            padding: 0;
        }
        .sidebar-nav a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #ecf0f1;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .sidebar-nav a:hover, .sidebar-nav a.active, .sidebar-nav form button:hover {
            background-color: #34495e;
            border-left: 3px solid #e74c3c;
        }
        .sidebar-nav a i, .sidebar-nav form button i {
            margin-right: 10px;
            font-size: 18px;
        }
        .sidebar-nav form button {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #ecf0f1;
            background: none;
            border: none;
            cursor: pointer;
            width: 100%;
            text-align: left;
        }
        .sidebar-content {
            display: flex;
            flex-direction: column;
            height: 100%;
            justify-content: space-between;
        }

        /* KONTEN UTAMA RESPONSIVE */
        .main-content {
            padding: 30px;
            flex-grow: 1;
            margin-left: 0;
        }
        @media (min-width: 1024px) {
            .main-content {
                margin-left: 250px;
            }
        }
        .edit-header {
            font-size: 2rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 30px;
        }

        /* FORM INPUT STYLING (Merujuk pada @tailwindcss/forms) */
        .form-input-style {
            /* Menggantikan w-full border-gray-300 rounded-md shadow-sm */
            @apply w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50;
        }
        .card-edit {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            padding: 24px;
        }
    </style>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body x-data="{ open: false }">

{{-- TOMBOL HAMBURGER --}}
<div @click="open = true"
     class="lg:hidden fixed top-3 right-1 m-4 p-2 bg-indigo-600 text-white rounded-lg shadow-lg cursor-pointer z-[60]">
    <i class="fas fa-bars"></i>
</div>

<div class="flex-container">

    {{-- SIDEBAR --}}
    <div class="sidebar" :class="{'sidebar-open': open}">
        <div class="sidebar-content">
            <div>
                {{-- Tombol Tutup (Hanya di Mobile) --}}
                <div class="lg:hidden absolute top-0 right-0 m-4 p-2 text-white cursor-pointer" @click="open = false">
                    <i class="fas fa-times text-xl"></i>
                </div>

                <div class="sidebar-header">
                    <i class="fas fa-exclamation-circle" style="color: #e74c3c; font-size: 24px;"></i>
                    <h2>CRIME ALERT</h2>
                </div>

                <nav class="sidebar-nav">
                    <ul>
                        <li><a href="{{ route('admin.dashboard') }}" @click="open = false"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                        <li><a href="{{ route('admin.laporan.index') }}" class="active" @click="open = false"><i class="fas fa-bell"></i> Laporan Masuk</a></li>
                        <li><a href="{{ route('admin.laporan.reports') }}" @click="open = false"><i class="fas fa-chart-bar"></i> Reports</a></li>
                        <li><a href="{{ route('profile.edit') }}" @click="open = false"><i class="fas fa-cog"></i> Settings</a></li>
                    </ul>
                </nav>
            </div>

            {{-- LOGOUT --}}
            <div class="p-4 pt-0">
                <form method="POST" action="{{ route('logout') }}" @click="open = false">
                    @csrf
                    <button type="submit">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- OVERLAY --}}
    <div x-show="open"
         @click="open = false"
         class="fixed inset-0 bg-black opacity-50 z-40 lg:hidden"
         style="display: none;">
    </div>

    {{-- KONTEN UTAMA --}}
    <div class="main-content">
        <h1 class="edit-header">
            {{ __('Edit Status Laporan') }}
        </h1>

        <div class="max-w-4xl mx-auto">
            <div class="card-edit">

                <form method="POST" action="{{ route('admin.laporan.update', $laporan->id) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

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

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                            Status Laporan
                        </label>
                        <select id="status" name="status" class="w-full border-gray-300 rounded-md shadow-sm">
                            <option value="pending" {{ $laporan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="proses" {{ $laporan->status == 'proses' ? 'selected' : '' }}>Proses</option>
                            <option value="selesai" {{ $laporan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>

                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('admin.laporan.index') }}"
                           class="inline-block px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                            Batal
                        </a>
                        <button type="submit"
                                class="inline-block px-4 py-2 bg-yellow-500 text-black rounded-lg hover:bg-yellow-600 transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
</body>
</html>
