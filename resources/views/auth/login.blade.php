<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Admin - Klinik Bidan Yossy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4" style="background-color: #FEF7E5;">

    <div class="w-full max-w-sm bg-white rounded-[35px] border-[6px] p-6 shadow-xl text-center" style="border-color: #0E8388;">
        
        <!-- Logo Header ImgBB -->
        <div class="flex justify-center mb-2">
            <img src="https://i.ibb.co.com/PzNV2Yyx/Screenshot-2026-07-30-103908-removebg-preview.png" alt="Mom Sweet Baby" class="h-28 object-contain">
        </div>

        <h2 class="text-xl font-extrabold text-gray-900 mb-0.5">Masuk Admin</h2>
        <p class="text-xs font-bold mb-5" style="color: #0E8388;">Klinik Bidan Yossy</p>

        @if (session('status'))
            <div class="mb-4 text-xs text-green-600 font-semibold">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-3 text-left">
            @csrf

            <div>
                <label for="email" class="block text-xs font-bold text-gray-600 mb-1">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    placeholder="***@gmail.com"
                    class="w-full px-3.5 py-2 text-sm bg-gray-200/70 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#0E8388] text-gray-700 placeholder-gray-400 font-medium">
                @error('email')
                    <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-xs font-bold text-gray-600 mb-1">Kata Sandi</label>
                <input id="password" type="password" name="password" required
                    placeholder="*******"
                    class="w-full px-3.5 py-2 text-sm bg-gray-200/70 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#0E8388] text-gray-700 placeholder-gray-400 font-medium">
                @error('password')
                    <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div class="pt-2">
                <button type="submit" 
                    class="w-full py-2.5 text-white font-extrabold text-sm rounded-xl transition duration-200 shadow-md hover:opacity-90 active:scale-[0.99]"
                    style="background-color: #0E8388;">
                    Masuk
                </button>
            </div>
        </form>

        <div class="mt-4 text-xs font-medium text-gray-600">
            Belum Punya Akun Admin? 
            <a href="{{ route('register') }}" class="font-bold hover:underline" style="color: #0E8388;">
                Daftar
            </a>
        </div>

    </div>

</body>
</html>