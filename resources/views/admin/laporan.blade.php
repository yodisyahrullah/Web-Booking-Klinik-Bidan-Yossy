<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kunjungan Pasien - Klinik Bidan Yossy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="min-h-screen p-4 md:p-8" style="background-color: #FEF7E5;">

    <div class="max-w-6xl mx-auto space-y-6">
        
        <!-- Header Laporan -->
        <div class="bg-white rounded-[30px] border-[5px] p-6 shadow-xl flex items-center justify-between" style="border-color: #0E8388;">
            <div>
                <h1 class="text-2xl font-black text-gray-900">Laporan Rekapitulasi Pasien</h1>
                <p class="text-sm font-bold" style="color: #0E8388;">Klinik Bidan Yossy</p>
            </div>
            <a href="{{ route('dashboard') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold px-4 py-2 rounded-xl text-xs transition">
                <i class="fa-solid fa-arrow-left mr-1"></i> Kembali ke Dashboard
            </a>
        </div>

        <!-- Card Filter Tanggal -->
        <div class="bg-white rounded-[35px] border-[4px] p-6 shadow-xl" style="border-color: #0E8388;">
            
            <form action="{{ route('admin.laporan') }}" method="GET" class="flex flex-col md:flex-row items-center justify-between gap-4 mb-6 bg-gray-50 p-4 rounded-2xl border border-gray-200">
                <div class="flex items-center gap-3 w-full md:w-auto">
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-500 mb-1">Dari Tanggal</label>
                        <input type="date" name="start_date" value="{{ request('start_date') }}" class="bg-white border border-gray-300 text-xs rounded-xl px-3 py-2 font-bold focus:ring-2 focus:ring-[#0E8388]">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-500 mb-1">Sampai Tanggal</label>
                        <input type="date" name="end_date" value="{{ request('end_date') }}" class="bg-white border border-gray-300 text-xs rounded-xl px-3 py-2 font-bold focus:ring-2 focus:ring-[#0E8388]">
                    </div>
                    <div class="self-end">
                        <button type="submit" class="text-white text-xs font-black px-4 py-2 rounded-xl shadow-sm transition hover:opacity-90" style="background-color: #0E8388;">
                            <i class="fa-solid fa-filter mr-1"></i> FILTER
                        </button>
                    </div>
                </div>

                @if(request('start_date') || request('end_date'))
                    <div class="self-end">
                        <a href="{{ route('admin.laporan') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 text-xs font-black px-4 py-2 rounded-xl transition shadow-sm inline-block">
                            RESET FILTER
                        </a>
                    </div>
                @endif
            </form>

            <!-- Tabel Data Laporan -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-[11px] font-black text-gray-400 uppercase border-b border-gray-200">
                            <th class="pb-3 px-2">NO. ANTREAN</th>
                            <th class="pb-3 px-2">TANGGAL & WAKTU</th>
                            <th class="pb-3 px-2">NAMA PASIEN</th>
                            <th class="pb-3 px-2">NO. WA / KEPERLUAN</th>
                            <th class="pb-3 px-2">STATUS</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm font-bold text-gray-800">
                        @forelse($laporans as $item)
                            <tr class="hover:bg-gray-50/50">
                                <td class="py-4 px-2 font-black" style="color: #0E8388;">{{ $item->no_antrean }}</td>
                                <td class="py-4 px-2 text-xs text-gray-600">{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                <td class="py-4 px-2 font-black text-gray-900">{{ $item->nama_pasien }}</td>
                                <td class="py-4 px-2 text-xs text-gray-600">{{ $item->no_wa }} | {{ $item->keperluan }}</td>
                                <td class="py-4 px-2">
                                    <span class="bg-gray-100 text-gray-700 text-[10px] font-black px-3 py-1 rounded-full uppercase">
                                        {{ $item->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-gray-400 text-xs font-medium">
                                    Tidak ada data laporan pada rentang tanggal tersebut.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $laporans->withQueryString()->links() }}
            </div>

        </div>

    </div>

</body>
</html>