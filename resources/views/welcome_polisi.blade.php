<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Polisi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="w-full max-w-lg bg-white shadow-lg rounded-xl p-8 text-center">

    <h1 class="text-3xl font-bold text-blue-700 mb-4">
        👮 Sistem Polisi - Selamat Datang
    </h1>

    <p class="text-gray-600 mb-6">
        Akses dashboard polisi untuk memeriksa laporan yang telah ditugaskan.
    </p>

    <div class="space-y-3">

        {{-- Jika login sebagai polisi --}}
        @if(Auth::guard('polisi')->check())
            <a
                href="{{ route('polisi.dashboard') }}"
                class="block w-full py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold transition"
            >
                Masuk ke Dashboard
            </a>

            <form action="{{ route('polisi.logout') }}" method="POST">
                @csrf
                <button
                    class="block w-full py-3 bg-red-500 hover:bg-red-600 text-white rounded-lg font-semibold transition mt-2"
                >
                    Logout
                </button>
            </form>

            {{-- Jika belum login --}}
        @else
            <a
                href="{{ route('polisi.login') }}"
                class="block w-full py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold transition"
            >
                Login Polisi
            </a>

            <a
                href="{{ route('polisi.register') }}"
                class="block w-full py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-semibold transition"
            >
                Register Polisi
            </a>
        @endif

    </div>

</div>

</body>
</html>
