<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class FaqController extends Controller
{
     // Menampilkan halaman admin FAQ
    public function index()
    {
        $pending = Message::where('status','pending')->with('konsumen')->get();
        $replied = Message::where('status','replied')->with('konsumen')->orderBy('updated_at','desc')->get();

        return view('admin.faq', compact('pending','replied'));
    }

    // Balas pesan
    public function reply(Request $request, $id)
    {
        $request->validate([
            'balasan' => 'required'
        ]);

        $msg = Message::findOrFail($id);
        $msg->balasan = $request->balasan;
        $msg->status = 'replied';
        $msg->save();

        return redirect()->back()->with('success','Pesan berhasil dibalas');
    }
}
