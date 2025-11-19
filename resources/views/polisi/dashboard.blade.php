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

@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ session('error') }}',
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
            Berikut adalah semua laporan masuk yang dapat Anda tangani:
        </p>

        <!-- LIST LAPORAN -->
        @if ($laporans->isEmpty())
            <div class="bg-blue-100 text-blue-700 p-3 rounded">
                Tidak ada laporan tersedia.
            </div>
        @else
            <div class="space-y-4">
                @foreach ($laporans as $laporan)
                    <div class="p-4 border rounded-lg bg-gray-50 hover:bg-gray-100 transition">

                        <div class="flex justify-between items-start">
                            <div>
                                <!-- JUDUL -->
                                <p class="font-semibold text-gray-800 text-lg">
                                    {{ $laporan->judul_laporan }}
                                </p>

                                <!-- TANGGAL -->
                                <p class="text-sm text-gray-500">
                                    {{ $laporan->created_at->format('d M Y H:i') }}
                                </p>

                                <!-- STATUS POLISI -->
                                <div class="mt-2">
                                    @if ($laporan->polisi_id === null)
                                        <span class="px-3 py-1 text-sm rounded bg-yellow-200 text-yellow-800">
                                            Belum Ditangani
                                        </span>
                                    @elseif ($laporan->polisi_id == $polisi->id)
                                        <span class="px-3 py-1 text-sm rounded bg-blue-200 text-blue-800">
                                            Ditangani Anda
                                        </span>
                                    @else
                                        <span class="px-3 py-1 text-sm rounded bg-red-200 text-red-800">
                                            Telah di tangani oleh {{ $laporan->polisi->jabatan }} {{ $laporan->polisi->nama }}
                                        </span>
                                    @endif
                                </div>

                            </div>

                            <!-- BUTTONS -->
                            <div class="space-x-2">

                                <!-- DETAIL -->
                                <a href="{{ route('polisi.laporan.show', $laporan->id) }}"
                                   class="px-3 py-2 text-sm bg-gray-600 text-white rounded hover:bg-gray-700">
                                    Detail
                                </a>

                                <!-- TOMBOL TANGANI -->
                                @if ($laporan->polisi_id === null)
                                    <form action="{{ route('polisi.laporan.tangani', $laporan->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button class="px-3 py-2 text-sm bg-blue-600 text-white rounded hover:bg-blue-700">
                                            Tangani
                                        </button>
                                    </form>
                                @endif

                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>

</div>

</body>
</html>
