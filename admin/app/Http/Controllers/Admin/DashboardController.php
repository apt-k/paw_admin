<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    

    public function index()
    {
        $admin = Auth::guard('admin')->user();

        $booking = Booking::where('status', 'booking')->count();
        $process = Booking::where('status', 'process')->count();
        $done    = Booking::where('status', 'done')->count();

        // jumlah booking per bulan (pakai tanggal_booking)
        $monthlyBooking = Booking::selectRaw(
                'MONTH(tanggal_booking) as bulan, COUNT(*) as total'
            )
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        // pendapatan per bulan
        $monthlyRevenue = Booking::where('status', 'done')
            ->selectRaw(
                'MONTH(tanggal_booking) as bulan, SUM(total) as total'
            )
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        return view('admin.dashboard', compact(
            'admin',
            'booking',
            'process',
            'done',
            'monthlyBooking',
            'monthlyRevenue'
        ));
    }
}
