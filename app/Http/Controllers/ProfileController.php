<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Tampilkan halaman edit profil
    public function edit()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    // Proses update profil & upload foto
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'foto'  => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        // Jika admin mengupload foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto && file_exists(public_path($user->foto))) {
                unlink(public_path($user->foto));
            }

            // Simpan foto ke folder public/uploads/profile
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profile'), $filename);

            $user->foto = 'uploads/profile/' . $filename;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil dan foto berhasil diperbarui!');
    }
}