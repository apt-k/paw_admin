@extends('user.layout.master')

@section('title', 'Home')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-8 space-y-10">

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

    @if(session('error'))
        <div class="mb-6 flex items-center gap-3
                    bg-red-50 border border-red-200
                    text-red-700 px-4 py-3 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 8v4m0 4h.01" />
            </svg>
            <span class="text-sm font-medium">
                {{ session('error') }}
            </span>
        </div>
    @endif


   {{-- Notifikasi booking --}}
    @if(session('booking_success'))
        <div class="flex items-center gap-3 bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-lg">
            {{ session('booking_success') }}
        </div>
    @endif

    {{-- Notifikasi hewan --}}
    @if(session('hewan_success'))
        <div class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
            {{ session('hewan_success') }}
        </div>
    @endif

    {{-- ================= WELCOME ================= --}}
    <div>
        <h1 class="text-2xl font-bold text-gray-800">
            Selamat Datang, {{ auth()->user()->nama_pemilik }}
        </h1>
        <p class="text-gray-500 mt-1">
            Kami siap melayani Anda dengan sepenuh hati.
        </p>
    </div>


    {{-- ================= PILIH TAMBAH HEWAN ================= --}}
    <div class="bg-white rounded-xl shadow border p-8">
        <h3 class="font-semibold text-lg mb-6 text-center">
            Tambah Data Hewan
        </h3>

        <div class="flex justify-center gap-16">
            {{-- DOG --}}
            <a href="{{ route('user.hewan.create', 'dog') }}"
               class="flex flex-col items-center group">
                <div class="w-32 h-32 rounded-full overflow-hidden
                            bg-blue-100 shadow
                            group-hover:ring-4 group-hover:ring-blue-300 transition">
                    <img src="{{ asset('images/dog.jpg') }}"
                         class="w-full h-full object-cover">
                </div>
                <span class="mt-4 font-semibold text-gray-700">Dog</span>
            </a>

            {{-- CAT --}}
            <a href="{{ route('user.hewan.create', 'cat') }}"
               class="flex flex-col items-center group">
                <div class="w-32 h-32 rounded-full overflow-hidden
                            bg-orange-100 shadow
                            group-hover:ring-4 group-hover:ring-orange-300 transition">
                    <img src="{{ asset('images/cat.jpg') }}"
                         class="w-full h-full object-cover">
                </div>
                <span class="mt-4 font-semibold text-gray-700">Cat</span>
            </a>
        </div>
    </div>


    {{-- ================= DATA HEWAN ================= --}}
    <div class="bg-white rounded-xl shadow border p-6">
        <h3 class="font-semibold text-lg mb-4">
            Data Hewan Anda
        </h3>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-100 text-gray-600">
                    <tr>
                        <th class="py-3 px-4 text-left">Nama</th>
                        <th class="py-3 px-4 text-left">Jenis</th>
                        <th class="py-3 px-4 text-left">Ras</th>
                        <th class="py-3 px-4 text-left">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($hewans as $hewan)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="py-3 px-4">{{ $hewan->nama_hewan }}</td>
                            <td class="py-3 px-4 capitalize">{{ $hewan->jenis_hewan }}</td>
                            <td class="py-3 px-4">{{ $hewan->ras ?? '-' }}</td>
                            <td class="py-3 px-4 flex gap-3 items-center">

                                {{-- GROOMING --}}
                                <a href="{{ route('booking.create', $hewan->id) }}"
                                class="px-4 py-2 text-sm rounded-lg
                                        bg-blue-600 text-white
                                        hover:bg-blue-700 transition">
                                    Grooming
                                </a>

                                {{-- EDIT --}}
                                <a href="{{ route('hewan.edit', $hewan->id) }}"
                                title="Edit"
                                class="w-9 h-9 flex items-center justify-center
                                        rounded-lg bg-amber-50 text-amber-600
                                        hover:bg-amber-100 transition">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5"
                                        fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M11 5h2M5 21h14M16.5 3.5l4 4L8 20H4v-4L16.5 3.5z"/>
                                    </svg>
                                </a>

                                {{-- DELETE --}}
                                <form action="{{ route('hewan.destroy', $hewan->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus data hewan ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        title="Hapus"
                                        class="w-9 h-9 flex items-center justify-center
                                            rounded-lg bg-red-50 text-red-600
                                            hover:bg-red-100 transition">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-5 h-5"
                                            fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M19 7l-.9 12.1A2 2 0 0116.1 21H7.9a2 2 0 01-2-1.9L5 7m3-3h8m-1 0v2H9V4"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4"
                                class="py-6 text-center text-gray-400">
                                Belum ada data hewan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


    {{-- ================= FAQ ================= --}}
    <div class="bg-white rounded-xl shadow border p-6">
        <div class="flex items-center gap-3 mb-4">
            <h3 class="font-semibold text-lg">FAQ</h3>
            @if($unreadMessage > 0)
                <span class="w-3 h-3 bg-red-500 rounded-full"></span>
            @endif
        </div>

        {{-- Form input pertanyaan --}}
        <form action="{{ route('faq.store') }}" method="POST" class="flex items-center gap-2 mb-6">
            @csrf
            <input type="text" name="pesan" placeholder="Tulis pertanyaan..." 
                class="flex-1 border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            <button type="submit" class="p-2 bg-blue-500 rounded-lg text-white hover:bg-blue-600">
                {{-- Icon submit bisa pakai SVG --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </button>
        </form>

        {{-- List FAQ --}}
        <ul class="space-y-4">
            @forelse ($messages as $msg)
                <li class="border rounded-lg p-4">
                    <p class="text-sm font-semibold">
                        Q: {{ $msg->pesan }}
                    </p>

                    @if($msg->balasan)
                        <p class="text-sm text-green-600 mt-2">
                            A: {{ $msg->balasan }}
                        </p>
                    @else
                        <p class="text-xs text-gray-400 mt-2">
                            Menunggu balasan admin
                        </p>
                    @endif
                </li>
            @empty
                <p class="text-sm text-gray-400">
                    Belum ada pesan
                </p>
            @endforelse
        </ul>
    </div>
</div>

@endsection
