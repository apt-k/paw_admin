<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hewan;
use App\Models\Pelayanan;
use App\Models\Booking;
use App\Models\Karyawan;

class UserBookingController extends Controller
{
    public function create(Hewan $hewan)
    {
        $layanans = Pelayanan::all();

        return view('user.booking.create', compact('hewan','layanans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hewan_id'        => 'required|exists:hewans,id',
            'pelayanan_id'    => 'required|exists:pelayanans,id',
            'tanggal_booking' => 'required|date',
        ]);

        $hewan     = Hewan::findOrFail($request->hewan_id);
        $pelayanan = Pelayanan::findOrFail($request->pelayanan_id);

        // otomatis pilih karyawan berdasarkan jenis hewan (dog / cat)
        $karyawan = Karyawan::where('spesialis', $hewan->jenis_hewan)->first();

        if (!$karyawan) {
            return back()->with('error', 'Karyawan untuk jenis hewan ini belum tersedia');
        }

        //  SIMPAN BOOKING 
        Booking::create([
            'kode_booking'    => 'BK-' . time(),
            'hewan_id'        => $hewan->id,
            'pelayanan_id'    => $pelayanan->id,
            'karyawan_id'     => $karyawan->id, // otomatis
            'tanggal_booking' => $request->tanggal_booking,
            'harga'           => $pelayanan->harga,
            'total'           => $pelayanan->harga,
            'status'          => 'booking',
            'confirmed'       => 0,
        ]);

        return redirect()
            ->route('user.dashboard')
            ->with('booking_success', 'Booking anda telah masuk, harap antarkan hewan anda');
    }
}
