<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Admin - Klinik Bidan Yossy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="min-h-screen p-4 md:p-8" style="background-color: #FEF7E5;">

    <div class="max-w-2xl mx-auto space-y-6">

        <!-- Header -->
        <div class="bg-white rounded-[30px] border-[5px] p-6 shadow-xl flex items-center justify-between" style="border-color: #0E8388;">
            <div>
                <h1 class="text-xl md:text-2xl font-black text-gray-900">Pengaturan Profil Admin</h1>
                <p class="text-sm font-bold" style="color: #0E8388;">Klinik Bidan Yossy</p>
            </div>
            <a href="{{ route('dashboard') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold px-4 py-2 rounded-xl text-xs transition">
                <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
            </a>
        </div>

        <!-- Form Profil -->
        <div class="bg-white rounded-[35px] border-[4px] p-6 md:p-8 shadow-xl" style="border-color: #0E8388;">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-2xl text-xs mb-6 font-bold">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-2xl text-xs mb-6 font-bold">
                    <ul class="list-disc pl-4 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Preview Foto & Upload -->
                <div class="flex flex-col items-center justify-center space-y-4">
                    <div class="w-28 h-28 rounded-full border-4 overflow-hidden shadow-md flex items-center justify-center bg-gray-100" style="border-color: #0E8388;">
                        @if($user->foto)
                            <img src="{{ asset($user->foto) }}" alt="Foto Profil" class="w-full h-full object-cover">
                        @else
                            <i class="fa-solid fa-user text-5xl text-gray-400"></i>
                        @endif
                    </div>
                    
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-500 mb-1 text-center">Ganti Foto Profil</label>
                        <input type="file" name="foto" class="text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-black file:bg-[#0E8388] file:text-white hover:file:opacity-90 cursor-pointer">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-black uppercase text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl px-4 py-3 font-bold focus:ring-2 focus:ring-[#0E8388] focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-black uppercase text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl px-4 py-3 font-bold focus:ring-2 focus:ring-[#0E8388] focus:outline-none">
                </div>

                <div class="pt-4 flex justify-end">
                    <button type="submit" class="text-white font-black px-6 py-3 rounded-2xl text-sm shadow-md transition cursor-pointer hover:opacity-90" style="background-color: #0E8388;">
                        SIMPAN PERUBAHAN
                    </button>
                </div>
            </form>

        </div>

    </div>

</body>
</html>