@extends('admin.layout.master')

@section('title', 'Done')

@section('content')

<div class="flex items-center justify-between mb-4">
    <h2 class="text-xl font-bold">Booking Selesai</h2>

    <div class="flex space-x-2">
        <a href="{{ route('booking.booking') }}"
           class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
           Booking Baru
        </a>
        <a href="{{ route('booking.process') }}"
           class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
           Process
        </a>
        <a href="{{ route('booking.doneList') }}"
           class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 transition">
           Done
        </a>
    </div>
</div>

@if (session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
        {{ session('success') }}
    </div>
@endif

<table class="w-full bg-white rounded shadow">
    <thead>
        <tr class="border-b bg-gray-100">
            <th class="p-3 text-left">Nama Hewan</th>
            <th class="p-3 text-left">Layanan</th>
            <th class="p-3 text-left">Tanggal Booking</th>
            <th class="p-3 text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data as $item)
        <tr class="border-b hover:bg-gray-50">

            <td class="p-3 {{ $item->confirmed ? 'font-bold text-green-700' : '' }}">
                {{ $item->hewan->nama_hewan ?? '-' }}
            </td>

            <td class="p-3 {{ $item->confirmed ? 'font-bold text-green-700' : '' }}">
                {{ $item->pelayanan->nama_pelayanan ?? '-' }}
            </td>

            <td class="p-3 {{ $item->confirmed ? 'font-bold text-green-700' : '' }}">
                {{ \Carbon\Carbon::parse($item->tanggal_booking)->format('d/m/Y') }}
            </td>

            <td class="p-3 text-center">
                @if ($item->confirmed)
                    <span class="inline-flex items-center gap-1 text-green-600 font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                        Siap diambil pemilik
                    </span>
                @else
                    <form method="POST"
                          action="{{ route('booking.confirm', $item->id) }}"
                          class="inline">
                        @csrf
                        <button class="text-gray-500 hover:text-green-600 font-bold">
                            Konfirmasi
                        </button>
                    </form>
                @endif
            </td>

        </tr>
        @empty
        <tr>
            <td colspan="4" class="p-4 text-center text-gray-500">
                Tidak ada data booking selesai
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection
