<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Akun Admin - Klinik Bidan Yossy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4" style="background-color: #FEF7E5;">

    <div class="w-full max-w-md bg-white rounded-[40px] border-[5px] p-6 md:p-8 shadow-xl" style="border-color: #0E8388;">
        
        <!-- Logo ImgBB Asli -->
        <div class="mb-3 text-center">
            <img src="https://i.ibb.co.com/PzNV2Yyx/Screenshot-2026-07-30-103908-removebg-preview.png" alt="Mom Sweet Baby" class="h-20 mx-auto object-contain mb-1">
            <h1 class="text-xl font-black text-gray-900 tracking-tight">Buat Akun Admin</h1>
            <p class="text-xs font-bold mt-0.5" style="color: #0E8388;">Klinik Bidan Yossy</p>
        </div>

        <!-- Menampilkan Error Validasi jika ada -->
        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-300 text-red-700 px-4 py-2.5 rounded-2xl text-xs font-bold">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Register -->
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- Nama Lengkap -->
            <div>
                <label class="block text-xs font-extrabold text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                    class="w-full px-4 py-3 rounded-2xl border border-gray-200 text-sm font-semibold focus:outline-none focus:ring-2 focus:border-transparent"
                    placeholder="Nama Admin">
            </div>

            <!-- Email -->
            <div>
                <label class="block text-xs font-extrabold text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                    class="w-full px-4 py-3 rounded-2xl border border-gray-200 text-sm font-semibold focus:outline-none focus:ring-2 focus:border-transparent"
                    placeholder="admin@klinik.com">
            </div>

            <!-- Kata Sandi -->
            <div>
                <label class="block text-xs font-extrabold text-gray-700 mb-1">Kata Sandi</label>
                <input type="password" name="password" required autocomplete="new-password"
                    class="w-full px-4 py-3 rounded-2xl border border-gray-200 text-sm font-semibold focus:outline-none focus:ring-2 focus:border-transparent"
                    placeholder="••••••••">
            </div>

            <!-- Konfirmasi Kata Sandi -->
            <div>
                <label class="block text-xs font-extrabold text-gray-700 mb-1">Konfirmasi Kata Sandi</label>
                <input type="password" name="password_confirmation" required autocomplete="new-password"
                    class="w-full px-4 py-3 rounded-2xl border border-gray-200 text-sm font-semibold focus:outline-none focus:ring-2 focus:border-transparent"
                    placeholder="••••••••">
            </div>

            <!-- Tombol Submit -->
            <button type="submit" class="w-full text-white font-extrabold py-3.5 rounded-2xl text-sm shadow-md hover:opacity-95 transition cursor-pointer mt-2" style="background-color: #0E8388;">
                DAFTAR AKUN
            </button>
        </form>

        <!-- Link ke Login -->
        <div class="text-center mt-5">
            <p class="text-xs font-semibold text-gray-500">
                Sudah Punya Akun? 
                <a href="{{ route('login') }}" class="font-bold underline ml-1" style="color: #0E8388;">Masuk</a>
            </p>
        </div>

    </div>

</body>
</html>