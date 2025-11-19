<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @foreach(auth()->user()->notifications as $notif)
                        <div class="p-3 bg-blue-100 rounded my-2">
                            {{ $notif->data['message'] }}
                            (Status: {{ $notif->data['status'] }})
                        </div>
                    @endforeach

                    <p class="mb-4">{{ __("Welcome, Admin! You have full access.") }}</p>

                    <div class="space-y-2">
                        <a href="laporan"
                           class="block p-4 dark:bg-white hover:bg-gray-200 dark:hover:bg-gray-400 rounded-lg transition">
                            Manage Alert
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
