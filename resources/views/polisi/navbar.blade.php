<div class="bg-white shadow p-4 flex justify-between items-center">
    <h1 class="text-xl font-bold text-blue-700 flex items-center gap-2">
        👮 Dashboard Polisi
    </h1>

    <div class="flex items-center gap-3">

        {{-- Tombol Profil --}}
        <a href="{{ route('polisi.profil') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            Profil
        </a>

        {{-- Tombol Logout --}}
        <form action="{{ route('polisi.logout') }}" method="POST">
            @csrf
            <button class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                Logout
            </button>
        </form>
    </div>
</div>
