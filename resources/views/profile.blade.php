<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Admin - Klinik Bidan Yossy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="min-h-screen p-4 md:p-8" style="background-color: #FEF7E5;">

    <div class="max-w-2xl mx-auto space-y-6">

        <!-- Tombol Kembali ke Dashboard -->
        <div>
            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 font-bold text-sm text-gray-700 hover:text-gray-900 transition">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>

        <!-- Card Profil Utama -->
        <div class="bg-white rounded-[35px] border-[5px] p-8 shadow-xl text-center relative overflow-hidden" style="border-color: #0E8388;">
            
            <!-- Ornamen Background Header -->
            <div class="h-24 w-full absolute top-0 left-0 -z-0 opacity-20" style="background-color: #0E8388;"></div>

            <div class="relative z-10">
                <!-- Foto Profil Default ala Instagram / Icon User -->
                <div class="w-28 h-28 mx-auto rounded-full bg-white border-4 p-1 shadow-md flex items-center justify-center mb-4" style="border-color: #0E8388;">
                    <div class="w-full h-full rounded-full bg-gray-100 flex items-center justify-center text-gray-400">
                        <i class="fa-solid fa-user text-5xl"></i>
                    </div>
                </div>

                <h1 class="text-2xl font-black text-gray-900">{{ Auth::user()->name ?? 'Admin Klinik' }}</h1>
                <p class="text-xs font-bold uppercase tracking-wider mt-0.5" style="color: #0E8388;">Administrator Klinik Bidan Yossy</p>

                <!-- Detail Email & Informasi Akun -->
                <div class="mt-8 bg-gray-50 rounded-2xl p-5 border border-gray-100 text-left space-y-4">
                    <div class="flex items-center justify-between border-b border-gray-200 pb-3">
                        <span class="text-xs font-bold text-gray-400 uppercase">Nama Lengkap</span>
                        <span class="text-sm font-extrabold text-gray-800">{{ Auth::user()->name ?? '-' }}</span>
                    </div>

                    <div class="flex items-center justify-between border-b border-gray-200 pb-3">
                        <span class="text-xs font-bold text-gray-400 uppercase">Email Terdaftar</span>
                        <span class="text-sm font-extrabold text-gray-800">{{ Auth::user()->email ?? '-' }}</span>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-gray-400 uppercase">Peran / Role</span>
                        <span class="bg-teal-100 text-teal-800 text-[10px] font-black px-3 py-1 rounded-full uppercase">
                            Admin System
                        </span>
                    </div>
                </div>

                <!-- Tombol Keluar -->
                <div class="mt-8">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full bg-red-400 hover:bg-red-500 text-white font-black py-3 rounded-2xl text-sm shadow-md transition cursor-pointer">
                            <i class="fa-solid fa-right-from-bracket mr-1.5"></i> KELUAR DARI AKUN
                        </button>
                    </form>
                </div>

            </div>

        </div>

    </div>

</body>
</html>