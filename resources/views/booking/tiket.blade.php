<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket Antrean - Klinik Bidan Yossy</title>
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

    <div class="w-full max-w-md bg-white rounded-[40px] border-[5px] p-6 text-center shadow-xl relative z-10" style="border-color: #0E8388;">
        
        <!-- Logo ImgBB -->
        <div class="mb-2">
            <img src="https://i.ibb.co.com/PzNV2Yyx/Screenshot-2026-07-30-103908-removebg-preview.png" alt="Mom Sweet Baby" class="h-16 mx-auto object-contain">
        </div>

        <h1 class="text-xl font-black text-gray-900">Tiket Antrean Anda</h1>
        <p class="text-xs font-semibold text-gray-400 mb-4">Simpan atau tunjukkan layar ini saat di klinik</p>

        <!-- Frame Nomor Antrean -->
        <div class="bg-white border-2 rounded-[25px] p-5 mb-4 shadow-sm" style="border-color: #0E8388;">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">Nomor Antrean</p>
            <p class="text-5xl font-black my-1.5" style="color: #0E8388;">{{ $booking->no_antrean }}</p>
            <p class="text-sm font-black text-gray-800">Nama Pasien : {{ $booking->nama_pasien }}</p>
            <p class="text-xs font-semibold text-gray-500 mt-0.5">Keperluan : {{ $booking->keperluan }}</p>
        </div>

        <!-- Tombol Suara Ditaruh Di Atas Status agar Bebas Diklik -->
        <button id="btn-suara" onclick="aktifkanSuara()" class="w-full text-white font-extrabold py-3.5 rounded-2xl text-sm shadow-md hover:opacity-95 transition flex items-center justify-center gap-2 cursor-pointer relative z-30 mb-4" style="background-color: #0E8388;">
            <i class="fa-solid fa-bullhorn text-base"></i> Aktifkan Suara Panggilan
        </button>

        <!-- Status Antrean -->
        <div class="bg-gray-100 rounded-2xl p-3.5">
            <p class="text-[11px] font-bold text-gray-500">Status Antrean Saat Ini :</p>
            <p id="status-badge" class="text-sm font-black uppercase mt-0.5 text-amber-600">
                {{ $booking->status }}
            </p>
        </div>

    </div>

    <!-- Script Realtime & Audio Panggilan -->
    <script>
        let suaraAktif = false;
        let lastPanggilCount = {{ $booking->jumlah_panggil }};
        const bookingId = {{ $booking->id }};

        function aktifkanSuara() {
            suaraAktif = true;
            const btn = document.getElementById('btn-suara');
            btn.innerHTML = '<i class="fa-solid fa-check-circle text-base"></i> Suara Aktif & Terhubung';
            btn.style.backgroundColor = '#10B981'; // Hijau tanda aktif
            
            if ('speechSynthesis' in window) {
                const utterance = new SpeechSynthesisUtterance("Suara antrean diaktifkan");
                utterance.lang = 'id-ID';
                window.speechSynthesis.speak(utterance);
            }
        }

        function panggilSuara(noAntrean, nama) {
            if (!suaraAktif || !('speechSynthesis' in window)) return;
            
            const text = `Nomor antrean, ${noAntrean}, atas nama, ${nama}, silakan menuju ruang pemeriksaan.`;
            const utterance = new SpeechSynthesisUtterance(text);
            utterance.lang = 'id-ID';
            utterance.rate = 0.9;
            window.speechSynthesis.speak(utterance);
        }

        // Cek status secara real-time tiap 3 detik
        setInterval(() => {
            fetch(`/booking/check-status/${bookingId}`)
                .then(response => response.json())
                .then(data => {
                    const badge = document.getElementById('status-badge');
                    
                    if (data.status === 'selesai' || data.status === 'dilayani') {
                        badge.innerHTML = 'SELESAI';
                        badge.className = 'text-sm font-black uppercase mt-0.5 text-green-600';
                    } else if (data.status === 'dipanggil') {
                        badge.innerHTML = 'DIPANGGIL (' + data.jumlah_panggil + 'X)';
                        badge.className = 'text-sm font-black uppercase mt-0.5 text-blue-600';
                    } else {
                        badge.innerHTML = 'MENUNGGU' + (data.jumlah_panggil > 0 ? ' ('+data.jumlah_panggil+'X)' : '');
                        badge.className = 'text-sm font-black uppercase mt-0.5 text-amber-600';
                    }

                    if (data.jumlah_panggil > lastPanggilCount) {
                        lastPanggilCount = data.jumlah_panggil;
                        panggilSuara(data.no_antrean, data.nama_pasien);
                    }
                })
                .catch(err => console.error('Error fetching status:', err));
        }, 3000);
    </script>
</body>
</html>