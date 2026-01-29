<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserSettingController extends Controller
{
    // Halaman setting user
    public function index()
    {
        $user = Auth::user();
        return view('user.setting', compact('user'));
    }

    // foto profil
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();
        $folder = public_path('profile/user/' . $user->id);

        // Buat folder jika belum ada
        if (!file_exists($folder)) {
            mkdir($folder, 0755, true);
        }

        // Hapus foto lama jika ada
        if ($user->photo && file_exists($folder . '/' . $user->photo)) {
            unlink($folder . '/' . $user->photo);
        }

        // Simpan foto baru
        $filename = time() . '_' . $request->photo->getClientOriginalName();
        $request->photo->move($folder, $filename);

        $user->photo = $filename;
        $user->save();

        return back()->with('success', 'Foto profil berhasil diperbarui!');
    }

    // informasi akun
    public function updateInfo(Request $request)
    {
        $request->validate([
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $user->no_hp = $request->no_hp;
        $user->alamat = $request->alamat;
        $user->save();

        return back()->with('success', 'Informasi akun berhasil diperbarui!');
    }

    // password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:6',
        ]);

        $user = Auth::user(); // Ambil user yang sedang login

        // Cek password lama
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->with('error', 'Password lama salah.');
        }

        // Update password
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Logout user agar session lama hilang
        Auth::logout(); 
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Password berhasil diubah, silakan login lagi.');
}
}
