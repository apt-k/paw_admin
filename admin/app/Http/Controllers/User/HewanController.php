<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Hewan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HewanController extends Controller
{
    public function create($jenis)
    {
        return view('user.hewan.create', compact('jenis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_hewan' => 'required|string|max:100',
            'jenis_hewan' => 'required|in:dog,cat',
            'ras' => 'nullable|string|max:100',
        ]);

        Hewan::create([
            'konsumen_id' => Auth::id(),
            'nama_hewan' => $request->nama_hewan,
            'jenis_hewan' => $request->jenis_hewan,
            'ras' => $request->ras,
        ]);

        return redirect('/user/dashboard')
            ->with('hewan_success', 'Hewan berhasil ditambahkan 🐾');
    }

    public function edit(Hewan $hewan)
    {
        return view('user.hewan.edit', compact('hewan'));
    }

    public function update(Request $request, Hewan $hewan)
    {
        $request->validate([
            'nama_hewan' => 'required|string|max:100',
            'ras' => 'nullable|string|max:100',
        ]);

        $hewan->update([
            'nama_hewan' => $request->nama_hewan,
            'ras' => $request->ras,
        ]);

        return redirect('/user/dashboard')
            ->with('hewan_success', 'Data hewan berhasil diupdate');
    }

    public function destroy(Hewan $hewan)
    {
        $hewan->delete();

        return redirect('/user/dashboard')
            ->with('hewan_success', 'Data hewan berhasil dihapus');
    }

}
