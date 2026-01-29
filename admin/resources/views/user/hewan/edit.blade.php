@extends('user.layout.master')

@section('title', 'Edit Hewan')

@section('content')

<div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">

    <h2 class="text-xl font-bold mb-6">
        Edit Hewan
    </h2>

    <form method="POST" action="{{ route('hewan.update', $hewan->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-1">Nama Hewan</label>
            <input type="text"
                   name="nama_hewan"
                   value="{{ $hewan->nama_hewan }}"
                   required
                   class="w-full border rounded-lg px-4 py-2">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Jenis</label>
            <input type="text"
                   value="{{ ucfirst($hewan->jenis_hewan) }}"
                   disabled
                   class="w-full border rounded-lg px-4 py-2 bg-gray-100">
        </div>

        <div class="mb-6">
            <label class="block mb-1">Ras</label>
            <input type="text"
                   name="ras"
                   value="{{ $hewan->ras }}"
                   class="w-full border rounded-lg px-4 py-2">
        </div>

        <button class="bg-amber-500 text-white px-6 py-2 rounded-lg">
            Update
        </button>

    </form>

</div>

@endsection
