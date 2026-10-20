<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Antrean - Klinik Bidan Yossy</title>
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

    <div class="w-full max-w-md bg-white rounded-[40px] border-[6px] p-6 shadow-2xl text-center" style="border-color: #0E8388;">
        <!-- Logo Header ImgBB -->
        <div class="flex justify-center mb-1">
            <img src="https://i.ibb.co.com/PzNV2Yyx/Screenshot-2026-07-30-103908-removebg-preview.png" alt="Mom Sweet Baby" class="h-28 object-contain">
        </div>

        <h2 class="text-2xl font-black text-gray-900 tracking-wide uppercase mb-0.5">BOOKING ANTREAN</h2>
        <p class="text-xs font-bold mb-2" style="color: #0E8388;">Klinik Bidan Yossy</p>
        <p class="text-[11px] text-gray-400 max-w-xs mx-auto mb-5 leading-tight font-medium">
            Silahkan isi data diri Anda untuk mendapatkan nomor urut antrean pemeriksaan secara real-time.
        </p>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded-xl mb-4 text-xs text-left">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('booking.store') }}" method="POST" class="space-y-3 text-left">
            @csrf

            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1 flex items-center gap-1.5">
                    <i class="fa-solid fa-user text-gray-400"></i> Nama Lengkap Pasien
                </label>
                <input type="text" name="nama_pasien" value="{{ old('nama_pasien') }}" required
                    placeholder="Contoh : Siti Aminah"
                    class="w-full px-4 py-2.5 text-sm bg-gray-200/70 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#0E8388] text-gray-800 placeholder-gray-400 font-medium">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1 flex items-center gap-1.5">
                    <i class="fa-solid fa-phone text-gray-400"></i> Nomor WhatsApp Aktif
                </label>
                <input type="text" name="no_wa" value="{{ old('no_wa') }}" required
                    placeholder="Contoh : 081234567*"
                    class="w-full px-4 py-2.5 text-sm bg-gray-200/70 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#0E8388] text-gray-800 placeholder-gray-400 font-medium">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1 flex items-center gap-1.5">
                    <i class="fa-solid fa-stethoscope text-gray-400"></i> Keperluan / Keluhan Medis
                </label>
                <input type="text" name="keperluan" value="{{ old('keperluan') }}" required
                    placeholder="Contoh : Imunisasi, Suntik KB, CEK"
                    class="w-full px-4 py-2.5 text-sm bg-gray-200/70 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#0E8388] text-gray-800 placeholder-gray-400 font-medium">
            </div>

            <div class="pt-3">
                <button type="submit" 
                    class="w-full py-3 text-white font-extrabold text-sm rounded-xl transition duration-200 shadow-md hover:opacity-90 active:scale-[0.99]"
                    style="background-color: #0E8388;">
                    Ambil Antrean Sekarang
                </button>
            </div>
        </form>

    </div>

</body>
</html>