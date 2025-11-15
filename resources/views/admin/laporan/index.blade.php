{{--<x-app-layout>--}}
{{--    <x-slot name="header">--}}
{{--        <h2 class="font-semibold text-xl text-gray-800 leading-tight">--}}
{{--            {{ __('Laporan Masuk') }}--}}
{{--        </h2>--}}
{{--    </x-slot>--}}

{{--    <div class="py-12">--}}
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
{{--            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">--}}
{{--                <div class="p-6 text-gray-900">--}}

{{--                    @if (session('success'))--}}
{{--                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 shadow-sm" role="alert">--}}
{{--                            <span class="block sm:inline">{{ session('success') }}</span>--}}
{{--                        </div>--}}
{{--                    @endif--}}

{{--                    <div class="overflow-x-auto border rounded-lg">--}}
{{--                        <table class="min-w-full divide-y divide-gray-200">--}}
{{--                            <thead class="bg-gray-50">--}}
{{--                            <tr>--}}
{{--                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">--}}
{{--                                    Judul--}}
{{--                                </th>--}}
{{--                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">--}}
{{--                                    Pelapor--}}
{{--                                </th>--}}
{{--                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">--}}
{{--                                    Tanggal--}}
{{--                                </th>--}}
{{--                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">--}}
{{--                                    Kategori--}}
{{--                                </th>--}}
{{--                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">--}}
{{--                                    Status--}}
{{--                                </th>--}}
{{--                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">--}}
{{--                                    Aksi--}}
{{--                                </th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody class="bg-white divide-y divide-gray-200">--}}
{{--                            @forelse ($laporan as $item)--}}
{{--                                <tr class="hover:bg-gray-100 transition duration-150">--}}
{{--                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">--}}
{{--                                        {{ $item->judul_laporan }}--}}
{{--                                    </td>--}}
{{--                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">--}}
{{--                                        {{ $item->user->name ?? 'User Dihapus' }}--}}
{{--                                    </td>--}}
{{--                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">--}}
{{--                                        {{ $item->created_at->format('d M Y') }}--}}
{{--                                    </td>--}}
{{--                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">--}}
{{--                                        {{ $item->kategori }}--}}
{{--                                    </td>--}}
{{--                                    <td class="px-6 py-4 whitespace-nowrap text-sm">--}}
{{--                                        <!-- Badge Status -->--}}
{{--                                        @if ($item->status == 'selesai')--}}
{{--                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">--}}
{{--                                                    Selesai--}}
{{--                                                </span>--}}
{{--                                        @elseif ($item->status == 'proses')--}}
{{--                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">--}}
{{--                                                    Proses--}}
{{--                                                </span>--}}
{{--                                        @else--}}
{{--                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">--}}
{{--                                                    Pending--}}
{{--                                                </span>--}}
{{--                                        @endif--}}
{{--                                    </td>--}}
{{--                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">--}}
{{--                                        <!-- Tombol Aksi yang Dibuat Lebih Visual -->--}}
{{--                                        <div class="inline-flex space-x-2">--}}
{{--                                            <a href="{{ route('admin.laporan.show', $item->id) }}"--}}
{{--                                               class="px-2 py-1 text-xs font-medium bg-blue-500 text-white rounded hover:bg-blue-600 transition">--}}
{{--                                                Detail--}}
{{--                                            </a>--}}
{{--                                            <a href="{{ route('admin.laporan.edit', $item->id) }}"--}}
{{--                                               class="px-2 py-1 text-xs font-medium bg-green-500 text-white rounded hover:bg-green-600 transition">--}}
{{--                                                Edit--}}
{{--                                            </a>--}}

{{--                                            <form action="{{ route('admin.laporan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus laporan ini?');" class="inline-block">--}}
{{--                                                @csrf--}}
{{--                                                @method('DELETE')--}}
{{--                                                <button type="submit"--}}
{{--                                                        class="px-2 py-1 text-xs font-medium bg-red-600 text-white rounded hover:bg-red-700 transition">--}}
{{--                                                    Hapus--}}
{{--                                                </button>--}}
{{--                                            </form>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                            @empty--}}
{{--                                <tr>--}}
{{--                                    <td colspan="5" class="px-6 py-8 whitespace-nowrap text-lg text-gray-500 text-center bg-gray-50">--}}
{{--                                        <p class="font-medium">🎉 Tidak ada laporan masuk saat ini.</p>--}}
{{--                                        <p class="text-sm">Saatnya beristirahat! </p>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                            @endforelse--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</x-app-layout>--}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan Masuk') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ kategori: '{{ $selectedKategori ?? $kategoriList->first() }}', status: '{{ $selectedStatus ?? 'semua' }}' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Pesan sukses --}}
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 shadow-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- 🔹 Tab Kategori --}}
                    <div class="flex flex-wrap gap-2 mb-6">
                        <!-- Tombol untuk menampilkan semua kategori -->
                        <a href="{{ route('admin.laporan.index', ['kategori' => 'semua']) }}"
                           class="px-4 py-2 rounded-lg text-sm font-medium
                               {{ $selectedKategori == 'semua' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                            Semua Kejahatan
                        </a>


                        <!-- Tombol kategori dinamis -->
                        @foreach($kategoriList as $kategori)
                            <a href="{{ route('admin.laporan.index', ['kategori' => $kategori]) }}"
                               class="px-4 py-2 rounded-lg text-sm font-medium
                                {{ $selectedKategori == $kategori ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                                {{ $kategori }}
                            </a>
                        @endforeach
                    </div>

                    {{-- 🔹 Tab Status --}}
                    <div class="flex flex-wrap gap-2 mb-6">
                        <template x-for="option in ['semua', 'pending', 'proses', 'selesai']" :key="option">
                            <button
                                class="px-3 py-1.5 text-xs font-medium rounded-full border transition"
                                :class="status === option ? 'bg-indigo-600 text-white border-indigo-600' : 'bg-gray-100 text-gray-700 border-gray-300 hover:bg-indigo-100'"
                                @click="status = option">
                                <span x-text="option === 'semua' ? 'Semua Status' : option.charAt(0).toUpperCase() + option.slice(1)"></span>
                            </button>
                        </template>
                    </div>

                    {{-- 🔹 Tabel Data --}}
                    <div class="overflow-x-auto border rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pelapor</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($laporan as $item)
                                <tr
                                <tr
                                    x-show="(kategori === 'semua' || kategori === '{{ $item->kategori }}')
                                            && (status === 'semua' || status === '{{ $item->status }}')"
                                    class="hover:bg-gray-100 transition duration-150">

                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $item->judul_laporan }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $item->user->name ?? 'User Dihapus' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $item->created_at->format('d M Y') }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->kategori }}</td>
                                    <td class="px-6 py-4 text-sm">
                                        @if ($item->status == 'selesai')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Selesai</span>
                                        @elseif ($item->status == 'proses')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Proses</span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Pending</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-center">
                                        <div class="inline-flex space-x-2">
                                            <a href="{{ route('admin.laporan.show', $item->id) }}" class="px-2 py-1 text-xs bg-blue-500 text-white rounded hover:bg-blue-600">Detail</a>
                                            <a href="{{ route('admin.laporan.edit', $item->id) }}" class="px-2 py-1 text-xs bg-green-500 text-white rounded hover:bg-green-600">Edit</a>
                                            <form action="{{ route('admin.laporan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus laporan ini?');" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-2 py-1 text-xs bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-gray-500 bg-gray-50">
                                        <p class="font-medium">🎉 Tidak ada laporan ditemukan.</p>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
