<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Register - Crime Alert</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5; /* Latar belakang yang sama dengan dashboard */
        }
        .register-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .register-card {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px; /* Sedikit lebih lebar karena form lebih panjang */
            padding: 40px;
        }
        .header-icon {
            color: #2c3e50; /* Warna gelap sidebar */
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        .header-text {
            color: #2c3e50;
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
            border-color: #e74c3c; /* Aksen merah */
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
<div class="register-container">
    <div class="register-card">
        <div class="text-center">
            <i class="fas fa-user-plus header-icon"></i>
            <div class="header-text">REGISTRASI AKUN BARU</div>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block font-medium text-sm text-gray-700 mb-1">Nama</label>
                <input id="name" class="input-style" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
                @error('name')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block font-medium text-sm text-gray-700 mb-1">Email</label>
                <input id="email" class="input-style" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
                @error('email')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block font-medium text-sm text-gray-700 mb-1">Password</label>
                <input id="password" class="input-style" type="password" name="password" required autocomplete="new-password" />
                @error('password')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="block font-medium text-sm text-gray-700 mb-1">Konfirmasi Password</label>
                <input id="password_confirmation" class="input-style" type="password" name="password_confirmation" required autocomplete="new-password" />
                @error('password_confirmation')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end mt-6">
                <a class="underline text-sm text-gray-500 hover:text-gray-900 transition mr-4" href="{{ route('login') }}">
                    Sudah punya akun?
                </a>

                <button type="submit" class="submit-button">
                    Daftar
                </button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
