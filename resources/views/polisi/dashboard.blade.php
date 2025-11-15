<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Polisi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100 min-h-screen">

@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
            timer: 2000,
            showConfirmButton: false
        });
    </script>
@endif


<!-- NAVBAR -->
@include('polisi.navbar')

<!-- CONTENT -->
<div class="max-w-4xl mx-auto mt-8">
    <div class="bg-white shadow rounded-xl p-6">

        <h2 class="text-2xl font-semibold mb-2">
            Selamat datang, {{ $polisi->nama }}
        </h2>

        <p class="text-gray-600 mb-4">
            Berikut adalah daftar laporan yang ditugaskan kepada Anda:
        </p>

        <!-- LIST LAPORAN -->
        @if ($laporans->isEmpty())
            <div class="bg-blue-100 text-blue-700 p-3 rounded">
                Tidak ada laporan yang ditugaskan saat ini.
            </div>
        @else
            <div class="space-y-3">
                @foreach ($laporans as $laporan)
                    <a href="{{ route('polisi.laporan.show', $laporan->id) }}"
                       class="block p-4 border rounded-lg hover:bg-gray-50 transition">

                        <p class="font-semibold text-gray-800">
                            {{ $laporan->judul }}
                        </p>

                        <p class="text-sm text-gray-500">
                            {{ $laporan->created_at->format('d M Y H:i') }}
                        </p>

                    </a>
                @endforeach
            </div>
        @endif

    </div>

</div>

</body>
</html>
