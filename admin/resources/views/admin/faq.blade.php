@extends('admin.layout.master')

@section('title', 'FAQ')

@section('content')

@if(session('success'))
<div class="bg-green-100 text-green-700 p-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

{{-- PESAN BELUM DIBALAS --}}
@if(count($pending) > 0)
<div class="bg-yellow-100 border-l-4 border-yellow-500 p-4 mb-6 rounded">
    <h2 class="font-bold text-yellow-700 mb-4">📩 Pesan Belum Dibalas</h2>

    <div class="space-y-4">
        @foreach($pending as $u)
        <div class="bg-white p-4 rounded shadow">

            {{-- NAMA KONSUMEN --}}
            <p class="font-semibold text-blue-600">
                {{ $u->konsumen->nama_pemilik ?? 'Konsumen tidak diketahui' }}
            </p>

            {{-- TANGGAL --}}
            <p class="text-xs text-gray-400 mb-2">
                {{ $u->created_at->format('d M Y, H:i') }}
            </p>

            {{-- PESAN --}}
            <p class="text-gray-700 mb-3">
                🐾 {{ $u->pesan }}
            </p>

            {{-- FORM BALAS --}}
            <form action="{{ route('faq.reply',$u->id) }}" method="POST">
                @csrf
                <textarea name="balasan" required
                          class="w-full border rounded p-2 mb-2"
                          placeholder="Tulis balasan admin..."></textarea>

                <button class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600">
                    Kirim Balasan
                </button>
            </form>
        </div>
        @endforeach
    </div>
</div>
@endif


{{-- PESAN SUDAH DIBALAS --}}
@if(count($replied) > 0)
<div class="mt-10">
    <h2 class="text-lg font-bold text-blue-600 mb-4">💬 Riwayat Pesan Konsumen</h2>

    <div class="space-y-4">
        @foreach($replied as $r)
        <div class="bg-white border border-blue-200 rounded p-4 shadow-sm">

            {{-- NAMA KONSUMEN --}}
            <p class="font-semibold text-blue-600">
                {{ $r->konsumen->nama_pemilik ?? 'Konsumen tidak diketahui' }}
            </p>

            {{-- TANGGAL --}}
            <p class="text-xs text-gray-400 mb-2">
                {{ $r->created_at->format('d M Y, H:i') }}
            </p>

            {{-- PESAN --}}
            <p class="text-gray-700">
                🐾 {{ $r->pesan }}
            </p>

            {{-- BALASAN --}}
            <div class="mt-2 bg-blue-50 p-3 rounded">
                <p class="text-sm text-blue-700 font-semibold">Balasan Admin:</p>
                <p class="text-green-700">💬 {{ $r->balasan }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

@endsection
