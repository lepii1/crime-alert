<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Profile Settings - Crime Alert</title>

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

        /* 1. SIDEBAR RESPONSIVE */
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
            /* Default: Sembunyikan di luar viewport untuk mobile */
            transform: translateX(-100%);
        }
        /* Desktop/Layar Lebar: Selalu tampil */
        @media (min-width: 1024px) {
            .sidebar {
                transform: translateX(0);
            }
        }
        /* Class Alpine untuk membuka sidebar di mobile */
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
        .sidebar-nav form {
            width: 100%;
        }
        .sidebar-nav form button {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #ecf0f1;
            text-decoration: none;
            transition: background-color 0.3s ease;
            background: none;
            border: none;
            cursor: pointer;
            width: 100%;
            text-align: left;
        }

        /* PUSH LOGOUT KE BAWAH */
        .sidebar-content {
            display: flex;
            flex-direction: column;
            height: 100%;
            justify-content: space-between;
        }

        /* 2. KONTEN UTAMA RESPONSIVE */
        .main-content {
            padding: 30px;
            flex-grow: 1;
            /* Mobile: Tanpa margin kiri */
            margin-left: 0;
        }
        /* Desktop/Layar Lebar: Beri margin kiri */
        @media (min-width: 1024px) {
            .main-content {
                margin-left: 250px;
            }
        }

        .profile-header {
            font-size: 2rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 30px;
        }

        /* Styling tambahan untuk kartu profil */
        .profile-card-container {
            max-width: 7xl;
            margin-left: auto;
            margin-right: auto;
            padding-left: 1rem;
            padding-right: 1rem;
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
        }

        /* Responsive Stacking: memastikan kartu profil menumpuk dengan baik di mobile */
        .profile-card-container > div {
            width: 100%;
            margin-bottom: 1.5rem; /* space-y-6 */
        }
        @media (min-width: 768px) {
            .profile-card-container > div {
                max-width: 65%; /* Agar terlihat bagus di desktop */
            }
        }
    </style>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body x-data="{ open: false }">

{{-- TOMBOL HAMBURGER --}}
<div @click="open = true"
     class="lg:hidden fixed top-0 right-0 m-4 p-2 bg-indigo-600 text-white rounded-lg shadow-lg cursor-pointer z-[60]">
    <i class="fas fa-bars"></i>
</div>

<div class="flex-container">

    {{-- SIDEBAR - RESPONSIVE --}}
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
                        <li><a href="{{ route('admin.laporan.index') }}" @click="open = false"><i class="fas fa-bell"></i> Laporan Masuk</a></li>
                        <li><a href="{{ route('admin.laporan.reports') }}" @click="open = false"><i class="fas fa-chart-bar"></i> Reports</a></li>
                        <li><a href="{{ route('profile.edit') }}" class="active" @click="open = false"><i class="fas fa-cog"></i> Settings</a></li>
                    </ul>
                </nav>
            </div>

            {{-- LOGOUT (DORONG KE BAWAH) --}}
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

    {{-- OVERLAY (HANYA DI MOBILE) --}}
    <div x-show="open"
         @click="open = false"
         class="fixed inset-0 bg-black opacity-50 z-40 lg:hidden"
         style="display: none;">
    </div>

    {{-- KONTEN UTAMA --}}
    <div class="main-content">
        <h1 class="profile-header">
            {{ __('Profile Settings') }}
        </h1>

        <div class="profile-card-container space-y-6">

            {{-- KARTU 1: Update Profile Information --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- KARTU 2: Update Password --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- KARTU 3: Delete User --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
