<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login - Crime Alert</title>

    <!-- Tailwind CSS (Pastikan Anda sudah mengimpornya atau mengkompilasinya) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5; /* Latar belakang yang sama dengan dashboard */
        }
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .login-card {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            padding: 40px;
        }
        .header-icon {
            color: #e74c3c; /* Warna aksen merah */
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        .header-text {
            color: #2c3e50; /* Warna gelap sidebar */
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 20px;
        }
        .input-style {
            padding: 10px 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            width: 100%;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        .input-style:focus {
            border-color: #e74c3c;
            outline: none;
            box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.2);
        }
        .submit-button {
            background-color: #e74c3c; /* Tombol warna merah aksen */
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: background-color 0.3s;
            box-shadow: 0 4px 6px rgba(231, 76, 60, 0.3);
        }
        .submit-button:hover {
            background-color: #c0392b;
        }

        /* Font Awesome for icons */
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
    </style>
</head>
<body>
<div class="login-container">
    <div class="login-card">
        <div class="text-center">
            <i class="fas fa-exclamation-triangle header-icon"></i>
            <div class="header-text">LOGIN</div>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block font-medium text-sm text-gray-700 mb-1">Email</label>
                <input id="email" class="input-style" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
                @error('email')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block font-medium text-sm text-gray-700 mb-1">Password</label>
                <input id="password" class="input-style" type="password" name="password" required autocomplete="current-password" />
                @error('password')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="block mb-4">
                <label for="remember_me" class="inline-flex items-center" style="padding-right: 100px;">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">Ingat saya</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-500 hover:text-gray-900 transition" href="{{ route('password.request') }}">
                        Lupa password?
                    </a>
                @endif
            </div>

            <div class="flex items-center justify-between mt-6">
                <a class="underline text-sm text-gray-500 hover:text-gray-900 transition mr-4" href="{{ route('register') }}">
                    Belum punya akun?
                </a>

                <button type="submit" class="submit-button">
                    Masuk
                </button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
