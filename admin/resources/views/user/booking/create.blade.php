@extends('user.layout.master')

@section('title', 'Booking Grooming')

@section('content')

<div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">

    <h2 class="text-xl font-bold mb-6">
        Booking Grooming
    </h2>

    <form method="POST" action="{{ route('booking.store') }}">
        @csrf

        {{-- HEWAN --}}
        <input type="hidden" name="hewan_id" value="{{ $hewan->id }}">

        <div class="mb-4">
            <label class="block mb-1">Nama Hewan</label>
            <input type="text"
                   value="{{ $hewan->nama_hewan }}"
                   disabled
                   class="w-full border rounded-lg px-4 py-2 bg-gray-100">
        </div>

        {{-- LAYANAN --}}
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Layanan</label>
            <select name="pelayanan_id" id="pelayanan"
                    class="w-full border rounded-lg p-2" required>
                <option value="">-- Pilih Layanan --</option>
                @foreach ($layanans as $layanan)
                    <option value="{{ $layanan->id }}"
                            data-harga="{{ $layanan->harga }}">
                        {{ $layanan->nama_pelayanan }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Harga</label>
            <input type="text" id="harga_view"
                class="w-full border rounded-lg p-2 bg-gray-100"
                readonly>

            {{-- nilai asli dikirim ke server --}}
            <input type="hidden" name="harga" id="harga">
        </div>

        {{-- TANGGAL --}}
        <div class="mb-6">
            <label class="block mb-1">Tanggal Booking</label>
            <input type="date"
                   name="tanggal_booking"
                   required
                   class="w-full border rounded-lg px-4 py-2">
        </div>
        <h3 class="text-sm text-gray-600 italic">
            * Pembayaran dilakukan saat pengambilan hewan
        </h3>
        <br>
        <button
            class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
            Booking
        </button>
    </form>
<script>
    const pelayanan = document.getElementById('pelayanan');
    const hargaView = document.getElementById('harga_view');
    const hargaInput = document.getElementById('harga');

    pelayanan.addEventListener('change', function () {
        const selected = this.options[this.selectedIndex];
        const harga = selected.getAttribute('data-harga');

        if (harga) {
            hargaView.value = 'Rp ' + Number(harga).toLocaleString('id-ID');
            hargaInput.value = harga;
        } else {
            hargaView.value = '';
            hargaInput.value = '';
        }
    });
</script>
</div>

@endsection
