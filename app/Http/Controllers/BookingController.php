<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // Halaman Form Booking Pasien
    public function index()
    {
        return view('booking.index');
    }

    // Proses Simpan Booking Baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_pasien' => 'required|string|max:255',
            'no_wa'       => 'required|string|max:20',
            'keperluan'   => 'required|string|max:255',
        ]);

        // Hitung antrean hari ini dan Format dengan 3 digit (A-001, A-002, dst) yang otomatis reset tiap tanggal baru
        $countToday = Booking::whereDate('created_at', now()->today())->count();
        $noAntrean  = 'A-' . str_pad($countToday + 1, 3, '0', STR_PAD_LEFT);

        $booking = Booking::create([
            'no_antrean'     => $noAntrean,
            'nama_pasien'    => $request->nama_pasien,
            'no_wa'          => $request->no_wa,
            'keperluan'      => $request->keperluan,
            'status'         => 'menunggu',
            'jumlah_panggil' => 0,
        ]);

        return redirect()->route('booking.tiket', $booking->id);
    }

    // Halaman Tiket Antrean Pasien
    public function tiket($id)
    {
        $booking = Booking::findOrFail($id);
        return view('booking.tiket', compact('booking'));
    }

    // API Cek Status Antrean (Untuk Realtime Audio di Tiket)
    public function checkStatus($id)
    {
        $booking = Booking::findOrFail($id);

        return response()->json([
            'status'         => strtolower($booking->status),
            'jumlah_panggil' => $booking->jumlah_panggil,
            'no_antrean'     => $booking->no_antrean,
            'nama_pasien'    => $booking->nama_pasien,
        ]);
    }

    // Halaman Dashboard Admin
    public function dashboard()
    {
        $antreans = Booking::orderBy('created_at', 'asc')->get();
        return view('dashboard', compact('antreans'));
    }

    // Aksi Panggil Pasien
    public function panggil($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->increment('jumlah_panggil');
        
        // Update status ke dipanggil jika masih menunggu
        if (strtolower($booking->status) == 'menunggu') {
            $booking->status = 'dipanggil'; // Jika di DB peka huruf besar: 'Dipanggil' / 'DIPANGGIL'
            $booking->save();
        }

        return redirect()->back()->with('success', 'Antrean ' . $booking->no_antrean . ' dipanggil.');
    }

    // Aksi Selesai / Dilayani (DIEDIT AGAR TIDAK ERROR CHECK CONSTRAINT)
   public function dilayani($id)
{
    $booking = Booking::findOrFail($id);
    $booking->status = 'dilayani'; // <--- Ubah jadi 'dilayani'
    $booking->save();

    return redirect()->back()->with('success', 'Antrean berhasil diselesaikan.');
}

    // Aksi Hapus Antrean
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->back()->with('success', 'Antrean berhasil dihapus.');
    }
}