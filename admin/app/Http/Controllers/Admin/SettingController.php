<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    // Halaman setting
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.setting', compact('admin'));
    }

    // Update foto profil
    public function updateProfile(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $admin = Auth::guard('admin')->user();
        if (!$admin) {
            return back()->with('error', 'Admin tidak ditemukan');
        }

        // Upload ke: public/profile/admin
        $file = $request->file('photo');
        $name = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('profile/admin'), $name);

        // Simpan ke database
        $admin->foto = $name;
        $admin->save();

        return back()->with('success', 'Foto berhasil diubah');
    }

    // Update password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:5'
        ]);

        $admin = Auth::guard('admin')->user();
        if (!$admin) {
            return back()->with('error', 'Admin tidak ditemukan');
        }

        // Cek password lama
        if (!Hash::check($request->old_password, $admin->password)) {
            return back()->with('error', 'Password lama salah');
        }

        // Simpan password baru
        $admin->password = Hash::make($request->new_password);
        $admin->save();

        // Logout agar session lama hilang
        Auth::guard('admin')->logout();

        return redirect('/login')->with('success', 'Password berhasil diubah, silakan login lagi');
    }

}
