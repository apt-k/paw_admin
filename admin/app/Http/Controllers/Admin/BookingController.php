<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\History;
use App\Models\Notification;
use Carbon\Carbon;

class BookingController extends Controller
{
    // BOOKING
    public function booking()
    {
        $data = Booking::with(['hewan', 'pelayanan'])
                       ->where('status', 'booking')
                       ->get();

        return view('admin.booking.booking', compact('data'));
    }

    // PROCESS
    public function process()
    {
        $data = Booking::with(['hewan', 'pelayanan'])
                       ->where('status', 'process')
                       ->get();

        return view('admin.booking.process', compact('data'));
    }

    // DONE
    public function done()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $data = Booking::with(['hewan', 'pelayanan'])
                       ->where('status', 'done')
                       ->whereMonth('tanggal_booking', $currentMonth)
                       ->whereYear('tanggal_booking', $currentYear)
                       ->orderBy('tanggal_booking', 'desc')
                       ->get();

        return view('admin.booking.done', compact('data'));
    }

    // booking ke process
    public function toProcess($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'process']);

        // Dapatkan user_id lewat hewan
        $user_id = $booking->hewan->konsumen_id ?? null;
        if ($user_id) {
            Notification::create([
                'user_id' => $user_id,
                'title'   => 'Booking Sedang Diproses',
                'message' => "Booking dengan nama hewan {$booking->hewan->nama_hewan} sedang diproses."
            ]);
        }

        return back()->with('success', 'Booking diproses.');
    }

    // process ke done
    public function toDone($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update([
            'status'    => 'done',
            'confirmed' => 0
        ]);

        $user_id = $booking->hewan->konsumen_id ?? null;
        if ($user_id) {
            Notification::create([
                'user_id' => $user_id,
                'title'   => 'Booking Selesai',
                'message' => "Booking dengan nama hewan {$booking->hewan->nama_hewan} telah selesai."
            ]);
        }

        return back()->with('success', 'Booking selesai.');
    }

    // done ke konfirmasi dan masuk history
    public function confirm($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->confirmed) {
            return redirect()->route('booking.doneList');
        }

        $booking->update(['confirmed' => 1]);

        History::create([
            'booking_id'      => $booking->id,
            'hewan_id'        => $booking->hewan_id,
            'pelayanan_id'    => $booking->pelayanan_id,
            'tanggal_booking' => $booking->tanggal_booking,
            'status'          => 'done',
        ]);

        $user_id = $booking->hewan->konsumen_id ?? null;
        if ($user_id) {
            Notification::create([
                'user_id' => $user_id,
                'title'   => 'Hewan Siap Diambil',
                'message' => "Booking dengan nama hewan {$booking->hewan->nama_hewan} bisa diambil sekarang."
            ]);
        }

        return redirect()->route('booking.doneList')
                         ->with('success', 'Hewan siap diambil oleh pemilik.');
    }

    // booking/process/done ke cancel akan masuk history
    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);

        $booking->update([
            'status'    => 'canceled',
            'confirmed' => false
        ]);

        History::create([
            'booking_id'      => $booking->id,
            'hewan_id'        => $booking->hewan_id,
            'pelayanan_id'    => $booking->pelayanan_id,
            'tanggal_booking' => $booking->tanggal_booking,
            'status'          => 'canceled',
        ]);

        $user_id = $booking->hewan->konsumen_id ?? null;
        if ($user_id) {
            Notification::create([
                'user_id' => $user_id,
                'title'   => 'Booking Dibatalkan',
                'message' => "Booking dengan nama hewan {$booking->hewan->nama_hewan} telah dibatalkan."
            ]);
        }

        return back()->with('success', 'Booking dibatalkan dan dicatat ke history.');
    }

    // Riwayat semua booking selesai/cancel
    public function history()
    {
        $histories = History::with(['hewan', 'pelayanan', 'booking'])
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('admin.booking.history', compact('histories'));
    }
}
