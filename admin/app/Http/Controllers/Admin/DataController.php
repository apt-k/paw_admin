<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Karyawan;
use App\Models\User;
use App\Models\Pelayanan;
use App\Models\Hewan;
use App\Models\Booking;


class DataController extends Controller
{
//karyawan
    // INDEX
    public function karyawan()
    {
        $karyawan = Karyawan::all();
        return view('admin.data.karyawan.index', compact('karyawan'));
    }

    // CREATE
    public function createKaryawan()
    {
        return view('admin.data.karyawan.create');
    }

    // STORE
    public function storeKaryawan(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'spesialis' => 'required|in:dog,cat',
            'no_hp'     => 'required|string|max:20',
        ]);

        Karyawan::create([
            'nama'      => $request->nama,
            'spesialis' => $request->spesialis,
            'no_hp'     => $request->no_hp,
        ]);

        return redirect()->route('karyawan.index')
            ->with('success', 'Data karyawan berhasil ditambahkan');
    }

    // EDIT
    public function editKaryawan($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('admin.data.karyawan.edit', compact('karyawan'));
    }

    // UPDATE
    public function updateKaryawan(Request $request, $id)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'spesialis' => 'required|in:dog,cat',
            'no_hp'     => 'required|string|max:20',
        ]);

        $karyawan = Karyawan::findOrFail($id);

        $karyawan->update([
            'nama'      => $request->nama,
            'spesialis' => $request->spesialis,
            'no_hp'     => $request->no_hp,
        ]);

        return redirect()->route('karyawan.index')
            ->with('success', 'Data karyawan berhasil diupdate');
    }

    
    // DELETE
    public function deleteKaryawan($id)
    {
        Karyawan::findOrFail($id)->delete();

        return redirect()->route('karyawan.index')
            ->with('success', 'Data karyawan berhasil dihapus');
    }

//hewan
    public function hewan()
    {
        $hewans = Hewan::with('konsumen')->get();
        return view('admin.data.hewan', compact('hewans'));
    }

// Pelayanan

    // INDEX
    public function pelayanan()
    {
        $pelayanan = Pelayanan::all();
        return view('admin.data.pelayanan.index', compact('pelayanan'));
    }

    // CREATE
    public function createPelayanan()
    {
        return view('admin.data.pelayanan.create');
    }

    // STORE
    public function storePelayanan(Request $request)
    {
        $request->validate([
            'nama_pelayanan' => 'required',
            'deskripsi'    => 'required',
            'harga'        => 'required|numeric',
        ]);

        Pelayanan::create($request->all());

        return redirect()->route('pelayanan.index')
            ->with('success', 'Data pelayanan berhasil ditambahkan');
    }

    // EDIT
    public function editPelayanan($id)
    {
        $pelayanan = Pelayanan::findOrFail($id);
        return view('admin.data.pelayanan.edit', compact('pelayanan'));
    }

    // UPDATE
    public function updatePelayanan(Request $request, $id)
    {
        $request->validate([
            'nama_pelayanan' => 'required',
            'deskripsi'    => 'required',
            'harga'        => 'required|numeric',
        ]);

        $pelayanan = Pelayanan::findOrFail($id);
        $pelayanan->update($request->all());

        return redirect()->route('pelayanan.index')
            ->with('success', 'Data pelayanan berhasil diupdate');
    }

    // DELETE
    public function deletePelayanan($id)
    {
        Pelayanan::findOrFail($id)->delete();

        return redirect()->route('pelayanan.index')
            ->with('success', 'Data pelayanan berhasil dihapus');
    }
}
