@extends('user.layout.master')

@section('content')
<div class="max-w-3xl mx-auto mt-10">

    <h2 class="text-2xl font-bold mb-4">FAQ</h2>

    {{-- ================= FLASH MESSAGE ================= --}}
    @if(session('success'))
        <div class="mb-6 flex items-center gap-3
                    bg-green-50 border border-green-200
                    text-green-700 px-4 py-3 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5 13l4 4L19 7" />
            </svg>
            <span class="text-sm font-medium">
                {{ session('success') }}
            </span>
        </div>
    @endif


    {{-- Form input pertanyaan --}}
    <form action="{{ route('faq.store') }}" method="POST" class="flex gap-2 mb-6">
        @csrf
        <input type="text" name="pesan" placeholder="Tulis pertanyaan..." 
               class="flex-1 border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
        <button type="submit" class="p-2 bg-blue-500 rounded-lg text-white hover:bg-blue-600">
            {{-- Icon submit --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </button>
    </form>

    {{-- Daftar FAQ --}}
    <ul class="space-y-4">
        @forelse ($messages as $msg)
            <li class="border rounded-lg p-4">
                <p class="text-sm font-semibold">Q: {{ $msg->pesan }}</p>
                <p class="text-xs text-gray-500">Dikirim oleh: {{ $msg->konsumen->name ?? 'Tidak diketahui' }}</p>
                <p class="text-sm text-green-600 mt-2">A: {{ $msg->balasan }}</p>
            </li>
        @empty
            <p class="text-gray-400">Belum ada FAQ.</p>
        @endforelse
    </ul>
</div>
@endsection
