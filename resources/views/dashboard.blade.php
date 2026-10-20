<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Klinik Bidan Yossy</title>
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

    <div class="max-w-6xl mx-auto space-y-6">

        <!-- Frame Header Admin -->
        <div class="bg-white rounded-[30px] border-[5px] p-4 md:p-6 shadow-xl flex flex-col md:flex-row items-center justify-between gap-4" style="border-color: #0E8388;">
            <div class="flex items-center gap-4">
                <img src="https://i.ibb.co.com/PzNV2Yyx/Screenshot-2026-07-30-103908-removebg-preview.png" alt="Mom Sweet Baby" class="h-16 md:h-20 object-contain">
                <div>
                    <h1 class="text-xl md:text-3xl font-black text-gray-900">Dashboard Antrean Admin</h1>
                    <p class="text-sm font-bold" style="color: #0E8388;">Klinik Bidan Yossy</p>
                </div>
            </div>

            <div class="flex items-center gap-6">
                <!-- Tombol Profile -->
                <a href="{{ route('admin.profile') }}" class="text-center hover:opacity-85 transition cursor-pointer">
                    <i class="fa-regular fa-circle-user text-4xl text-gray-800"></i>
                    <p class="text-[10px] font-black uppercase tracking-wider text-gray-700 mt-0.5">PROFILE</p>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-400 hover:bg-red-500 text-white font-black px-6 py-2.5 rounded-2xl text-sm shadow-md transition cursor-pointer">
                        KELUAR
                    </button>
                </form>
            </div>
        </div>

        <!-- Frame Tabel Daftar Antrean -->
        <div class="bg-white rounded-[35px] border-[4px] p-6 shadow-xl" style="border-color: #0E8388;">
            
            <div class="flex items-center gap-3 mb-6">
                <span class="w-4 h-4 rounded-full inline-block" style="background-color: #0E8388;"></span>
                <h2 class="text-lg font-extrabold text-gray-900">Daftar Antrean Hari Ini</h2>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded-xl text-xs mb-4 font-bold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-[11px] font-black text-gray-400 uppercase border-b border-gray-200">
                            <th class="pb-3 px-2">NO</th>
                            <th class="pb-3 px-2">NAMA PASIEN</th>
                            <th class="pb-3 px-2">NO. HP/KEPERLUAN</th>
                            <th class="pb-3 px-2">STATUS</th>
                            <th class="pb-3 px-2 text-center">AKSI PANGGILAN</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm font-bold text-gray-800">
                        @forelse($antreans as $item)
                            @php
                                $isSelesai = in_array(strtolower($item->status), ['selesai', 'dilayani']);
                            @endphp
                            <tr class="hover:bg-gray-50/50">
                                <td class="py-4 px-2 text-base font-black" style="color: #0E8388;">
                                    {{ $item->no_antrean }}
                                </td>

                                <td class="py-4 px-2 font-black text-gray-900">
                                    {{ $item->nama_pasien }}
                                </td>

                                <td class="py-4 px-2 text-xs text-gray-600">
                                    <span class="font-bold text-gray-700">{{ $item->no_wa }}</span> | Keperluan : {{ $item->keperluan }}
                                </td>

                                <td class="py-4 px-2">
                                    @if($isSelesai)
                                        <span class="bg-green-100 text-green-700 text-[10px] font-black px-3 py-1 rounded-full uppercase border border-green-300">
                                            SELESAI
                                        </span>
                                    @else
                                        <span class="bg-amber-100 text-amber-700 text-[10px] font-black px-3 py-1 rounded-full uppercase">
                                            MENUNGGU {{ $item->jumlah_panggil > 0 ? '('.$item->jumlah_panggil.'X)' : '' }}
                                        </span>
                                    @endif
                                </td>

                                <td class="py-4 px-2 text-center space-x-1.5">
                                    @if(!$isSelesai)
                                        <form action="{{ route('admin.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus antrean {{ $item->nama_pasien }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-400 hover:bg-red-500 text-white text-xs font-black px-3.5 py-1.5 rounded-full inline-flex items-center gap-1 shadow-sm transition cursor-pointer">
                                                <i class="fa-solid fa-trash text-[10px]"></i> HAPUS
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.panggil', $item->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-white text-xs font-black px-3.5 py-1.5 rounded-full inline-flex items-center gap-1 shadow-sm transition cursor-pointer hover:opacity-90" style="background-color: #0E8388;">
                                                <i class="fa-solid fa-volume-high text-[10px]"></i> PANGGIL
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.dilayani', $item->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="bg-gray-200 hover:bg-gray-300 text-gray-700 text-xs font-black px-3.5 py-1.5 rounded-full inline-flex items-center gap-1 transition cursor-pointer">
                                                <i class="fa-solid fa-check text-[10px]"></i> SELESAI
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-xs font-extrabold text-gray-400 italic">
                                            <i class="fa-solid fa-check-circle text-green-500 mr-1"></i> Sudah Selesai
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-gray-400 text-xs font-medium">
                                    Belum ada antrean masuk hari ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

    </div>

</body>
</html>