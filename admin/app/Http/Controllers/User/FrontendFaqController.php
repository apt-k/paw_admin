<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class FrontendFaqController extends Controller
{
    // Halaman FAQ
    public function index()
    {
        // Hanya tampilkan pesan yang sudah dibalas
        $messages = Message::where('status', 'replied')->latest()->get();

        return view('faq', compact('messages'));
    }

    // Simpan pertanyaan baru
    public function store(Request $request)
    {
        $request->validate([
            'pesan' => 'required|string|max:255',
        ]);

        Message::create([
            'pesan' => $request->pesan,
            'status' => 'pending', // menunggu balasan admin
            'konsumen_id' => auth()->id(), // otomatis tersambung ke user login
        ]);

        return redirect()->back()->with('success', 'Pertanyaan berhasil dikirim!');
    }
}
