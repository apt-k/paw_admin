@extends('user.layout.master')

@section('title', 'Tambah Hewan')

@section('content')

<div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">

    <h2 class="text-xl font-bold mb-6">
        Tambah Hewan ({{ ucfirst($jenis) }})
    </h2>

    <form method="POST" action="{{ route('user.hewan.store') }}">
        @csrf

        {{-- JENIS HEWAN (AUTO) --}}
        <input type="hidden" name="jenis_hewan" value="{{ $jenis }}">

        {{-- NAMA HEWAN --}}
        <div class="mb-4">
            <label class="block mb-1 font-medium">Nama Hewan</label>
            <input
                type="text"
                name="nama_hewan"
                class="w-full border rounded-lg px-4 py-2"
                required>
        </div>

        {{-- RAS --}}
        <div class="mb-6">
            <label class="block mb-1 font-medium">Ras</label>
            <input
                type="text"
                name="ras"
                placeholder="Contoh: Golden Retriever / Persia"
                class="w-full border rounded-lg px-4 py-2">
        </div>

        {{-- BUTTON --}}
        <div class="flex justify-end gap-3">
            <a href="/user/dashboard"
               class="px-4 py-2 border rounded-lg">
                Batal
            </a>

            <button
                type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                Simpan
            </button>
        </div>

    </form>

</div>

@endsection
