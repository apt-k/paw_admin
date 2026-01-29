<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class NotificationController extends Controller
{
    // Tampilkan daftar notifikasi
    public function index()
    {
        $user = Auth::user();
        $notifications = $user->notifications()
                              ->orderBy('created_at', 'desc')
                              ->get();

        return view('user.notifications', compact('notifications'));
    }

    // Tandai notifikasi sudah dibaca
    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);

        if ($notification->user_id == Auth::id()) {
            $notification->is_read = true;
            $notification->save();
        }

        return back();
    }
}
