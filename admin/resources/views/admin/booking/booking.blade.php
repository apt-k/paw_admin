@extends('admin.layout.master')

@section('title', 'Booking')

@section('content')


<div class="flex items-center justify-between mb-4">
    <h2 class="text-xl font-bold">Data Booking</h2>

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
            {{-- Nama Hewan --}}
            <td class="p-3">
                {{ $item->hewan->nama_hewan ?? '-' }}
            </td>

            {{-- Layanan --}}
            <td class="p-3">
                {{ $item->pelayanan->nama_pelayanan ?? '-' }}
            </td>

            {{-- Tanggal Booking --}}
            <td class="p-3">
                {{ \Carbon\Carbon::parse($item->tanggal_booking)->format('d/m/Y') ?? '-' }}
            </td>

            {{-- Aksi --}}
            <td class="p-3 text-center space-x-2">

                {{-- booking ke process --}}
               <form method="POST"
                    action="{{ route('booking.toProcess', $item->id) }}"
                    class="inline">
                    @csrf
                    <button type="submit"
                            title="Proses"
                            class="text-green-600 hover:scale-110 transition">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                    </button>
                </form>
                <form method="POST"
                    action="{{ route('booking.cancel', $item->id) }}"
                    class="inline"
                    onsubmit="return confirm('Yakin ingin membatalkan booking ini?')">
                    @csrf
                    <button type="submit"
                            title="Cancel"
                            class="text-red-600 hover:scale-110 transition">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="p-4 text-center text-gray-500">
                Tidak ada data booking
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection
