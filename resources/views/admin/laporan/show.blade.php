<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Laporan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-4">

                    <div>
                        <h3 class="text-lg font-semibold mb-2">Judul Laporan</h3>
                        <p class="text-gray-700">{{ $laporan->judul_laporan ?? '-' }}</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold mb-2">Deskripsi</h3>
                        <p class="text-gray-700 whitespace-pre-line">{{ $laporan->deskripsi ?? '-' }}</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold mb-2">Tanggal Lapor</h3>
                        <p class="text-gray-700">{{ $laporan->tgl_lapor ?? '-' }}</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold mb-2">Pelapor</h3>
                        <p class="text-gray-700">{{ $laporan->user->name ?? 'Tidak diketahui' }}</p>
                        <p class="text-gray-500 text-sm">{{ $laporan->user->email ?? '' }}</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold mb-2">Status</h3>
                        <span class="px-3 py-1 rounded-full text-black text-sm
                            @if($laporan->status == 'selesai') bg-green-500
                            @elseif($laporan->status == 'proses') bg-yellow-500
                            @else bg-gray-400 @endif">
                            {{ ucfirst($laporan->status ?? 'pending') }}
                        </span>
                    </div>

                    <div class="pt-4">
                        <a href="{{ route('admin.laporan.index') }}"
                           class="inline-block px-4 py-2 bg-blue-600 text-black rounded hover:bg-blue-700">
                            ← Kembali ke Daftar
                        </a>
                        <a href="{{ route('admin.laporan.edit', $laporan->id) }}"
                           class="inline-block px-4 py-2 bg-yellow-500 text-black rounded hover:bg-yellow-600 ml-2">
                            Edit Status
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
