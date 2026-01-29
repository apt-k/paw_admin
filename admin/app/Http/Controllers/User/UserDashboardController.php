<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Hewan;
use App\Models\Message;
use App\Models\Booking;

class UserDashboardController extends Controller
{
    public function index()
    {
        // user login
        $user = Auth::user(); // tabel konsumens

        // data hewan
        $hewans = Hewan::where('konsumen_id', $user->id)->get();

        // data booking
        $bookings = Booking::with(['hewan', 'pelayanan'])
            ->whereHas('hewan', function ($q) use ($user) {
                $q->where('konsumen_id', $user->id);
            })
            ->latest()
            ->get();

        $messages = Message::where('konsumen_id', $user->id)->latest()->get();

        // notif pesan
        $unreadMessage = Message::where('konsumen_id', $user->id)
            ->where('status', 'pending')
            ->count();

        return view('user.dashboard', compact(
            'hewans',
            'bookings',
            'messages',
            'unreadMessage'
        ));
    }

}
