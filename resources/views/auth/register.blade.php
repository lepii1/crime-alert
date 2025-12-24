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
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            overflow-x: hidden;
        }

        /* Latar belakang yang lebih menggambarkan situasi kejahatan/darurat (Police Lights/Crime Scene style) */
        .register-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            background-image: url('https://i.pinimg.com/1200x/ed/df/6e/eddf6e18ee2095d459133f14799fa50e.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .register-card {
            background-color: #ffffff;
            border-radius: 30px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6);
            width: 100%;
            max-width: 480px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .submit-button {
            background-color: #e74c3c;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: background-color 0.3s;
            box-shadow: 0 4px 6px rgba(231, 76, 60, 0.3);
            width: 100%;
        }

        .submit-button:hover {
            background-color: #c0392b;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<div class="register-container">
    <div class="register-card">
        {{-- Foto Visual dari asset kedua yang Anda kirim --}}
        <div class="card-image"></div>

        <div class="p-10">
            <div class="text-center mb-8">
                <img src="https://i.pinimg.com/1200x/5c/d4/47/5cd447a9ae0070153b3071637a0e6c04.jpg" alt="logo" class="w-[10rem] mx-auto mb-4 rounded-full shadow-md"/>
                <h2 class="text-2xl font-black text-gray-800 tracking-tight uppercase">Registrasi Warga</h2>
                <p class="text-xs text-gray-400 font-bold tracking-widest uppercase mt-1">Gabung Melindungi Komunitas</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                {{-- Nama --}}
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Nama Lengkap</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="w-full p-3.5 border border-gray-200 rounded-2xl transition duration-200
                           focus:border-red-500 focus:ring-4 focus:ring-red-100 outline-none text-sm font-medium;" placeholder="Ahmad Aulia Fahlevi">
                    @error('name') <p class="text-[10px] text-red-600 mt-2 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required class="w-full p-3.5 border border-gray-200 rounded-2xl transition duration-200
                           focus:border-red-500 focus:ring-4 focus:ring-red-100 outline-none text-sm font-medium;" placeholder="email@contoh.com">
                    @error('email') <p class="text-[10px] text-red-600 mt-2 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                {{-- Password Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Kata Sandi</label>
                        <div class="relative">
                            <input id="password" type="password" name="password" required
                                   class="w-full p-3.5 border border-gray-200 rounded-2xl transition duration-200
                          focus:border-red-500 focus:ring-4 focus:ring-red-100 outline-none text-sm font-medium"
                                   placeholder="••••••••">
                            <button type="button" onclick="togglePass('password', 'eye-reg')" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-red-500 transition-colors">
                                <svg id="eye-reg" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Konfirmasi</label>
                        <div class="relative">
                            <input id="password_confirmation" type="password" name="password_confirmation" required
                                   class="w-full p-3.5 border border-gray-200 rounded-2xl transition duration-200
                          focus:border-red-500 focus:ring-4 focus:ring-red-100 outline-none text-sm font-medium"
                                   placeholder="••••••••">
                            <button type="button" onclick="togglePass('password_confirmation', 'eye-conf')" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-red-500 transition-colors">
                                <svg id="eye-conf" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    @error('password')
                    <div class="col-span-2">
                        <p class="text-[10px] text-red-600 mt-1 font-bold uppercase">{{ $message }}</p>
                    </div>
                    @enderror
                </div>

                <div class="pt-4">
                    <button type="submit" class="submit-button">
                        Daftar Sekarang <i class="fas fa-paper-plane ml-2"></i>
                    </button>
                </div>

                <div class="text-center pt-4">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="text-red-600 hover:underline ml-1">Masuk Sini</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function togglePass(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);

        // Icon Mata Terbuka
        const eyeOpen = '<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />';

        // Icon Mata Tertutup
        const eyeClosed = '<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />';

        if (input.type === 'password') {
            input.type = 'text';
            icon.innerHTML = eyeClosed;
        } else {
            input.type = 'password';
            icon.innerHTML = eyeOpen;
        }
    }
</script>

</body>
</html>
