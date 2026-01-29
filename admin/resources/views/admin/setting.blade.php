@extends('admin.layout.master')

@section('title', 'Setting')

@section('content')

<h2 class="text-2xl font-bold mb-6">Setting Akun</h2>

{{-- ALERT SUCCESS / ERROR --}}
@if(session('success'))
    <div class="mb-4 text-green-600 font-medium">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-4 text-red-600 font-medium">
        {{ session('error') }}
    </div>
@endif

{{-- VALIDATION ERRORS --}}
@if($errors->any())
    <div class="mb-4">
        @foreach ($errors->all() as $error)
            <div class="text-red-600 font-medium">{{ $error }}</div>
        @endforeach
    </div>
@endif

{{-- ================= FOTO ================= --}}
<div class="bg-white p-6 rounded-xl shadow mb-8">
    <h3 class="font-semibold mb-4">Ganti Foto Profil</h3>

    <form action="/setting/profile" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="file" name="photo" required class="mb-4">

        <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Simpan Foto
        </button>
    </form>
</div>

{{-- ================= PASSWORD ================= --}}
<div class="bg-white p-6 rounded-xl shadow">
    <h3 class="font-semibold mb-4">Ganti Password</h3>

    <form action="{{ route('setting.password') }}" method="POST">
        @csrf

        <input type="password" name="old_password"
               placeholder="Password lama"
               class="block mb-3 border p-2 w-full rounded" required>
        @error('old_password')
            <div class="text-red-600 mb-2">{{ $message }}</div>
        @enderror

        <input type="password" name="new_password"
               placeholder="Password baru"
               class="block mb-3 border p-2 w-full rounded" required>
        @error('new_password')
            <div class="text-red-600 mb-2">{{ $message }}</div>
        @enderror

        <button class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
            Ubah Password
        </button>
    </form>
</div>

@endsection
