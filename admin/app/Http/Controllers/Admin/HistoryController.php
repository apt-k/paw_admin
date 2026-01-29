<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\History;

class HistoryController extends Controller
{
    // Menampilkan halaman history
    public function index()
    {
        $histories = History::with(['booking', 'hewan', 'pelayanan'])
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('admin.history.booking', compact('histories'));
    }

    // Konfirmasi booking masuk history
    public function confirm($id)
    {
        $history = History::findOrFail($id);
    }

    // Cancel booking  masuk history
    public function cancel($id)
    {
        $history = History::findOrFail($id);
    }
}
