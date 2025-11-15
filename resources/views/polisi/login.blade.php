<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Polisi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md border border-gray-200">
    <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">Login Polisi</h2>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('polisi.login.submit') }}">
        @csrf

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
            <div class="relative">
                <span class="absolute left-3 top-3 text-gray-400">📧</span>
                <input type="email" name="email" id="email"
                       class="w-full pl-10 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                       value="{{ old('email') }}" required>
            </div>
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
            <div class="relative">
                <span class="absolute left-3 top-3 text-gray-400">🔒</span>
                <input type="password" name="password" id="password"
                       class="w-full pl-10 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                       required>
            </div>
        </div>

        <!-- Remember Me -->
        <div class="flex items-center mb-4">
            <input type="checkbox" name="remember" id="remember"
                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
            <label for="remember" class="ml-2 text-gray-600 text-sm">Ingat Saya</label>
        </div>

        <!-- Submit Button -->
        <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
            Masuk
        </button>

        <p class="text-center text-sm text-gray-600 mt-4">
            Belum punya akun?
            <a href="{{ route('polisi.register') }}" class="text-blue-600 hover:underline">
                Daftar di sini
            </a>
        </p>
    </form>
</div>

</body>
</html>
