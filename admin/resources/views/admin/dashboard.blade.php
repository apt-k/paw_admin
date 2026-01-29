@extends('admin.layout.master')

@section('title', 'Dashboard')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

    {{-- BOOKING --}}
    <a href="{{ route('booking.booking') }}"
       class="bg-white p-6 rounded-xl shadow-sm border
              hover:ring-2 hover:ring-blue-300 transition block">
        <h3 class="text-sm font-medium text-gray-500 uppercase">
            Booking
        </h3>
        <p class="text-3xl font-bold text-blue-600">
            {{ $booking }}
        </p>
        <p class="text-xs text-gray-400 mt-1">
            Lihat booking baru ->
        </p>
    </a>

    {{-- PROCESS --}}
    <a href="{{ route('booking.process') }}"
       class="bg-white p-6 rounded-xl shadow-sm border
              hover:ring-2 hover:ring-yellow-300 transition block">
        <h3 class="text-sm font-medium text-gray-500 uppercase">
            Process
        </h3>
        <p class="text-3xl font-bold text-yellow-500">
            {{ $process }}
        </p>
        <p class="text-xs text-gray-400 mt-1">
            Sedang diproses ->
        </p>
    </a>

    {{-- DONE --}}
    <a href="{{ route('booking.doneList') }}"
       class="bg-white p-6 rounded-xl shadow-sm border
              hover:ring-2 hover:ring-green-300 transition block">
        <h3 class="text-sm font-medium text-gray-500 uppercase">
            Done
        </h3>
        <p class="text-3xl font-bold text-green-600">
            {{ $done }}
        </p>
        <p class="text-xs text-gray-400 mt-1">
            Booking selesai ->
        </p>
    </a>

</div>

{{-- ================= DIAGRAM BATANG ================= --}}
<div class="bg-white p-6 rounded-xl shadow border">
    <h3 class="font-semibold mb-4">
        Monthly Recap (Januari – Desember)
    </h3>
    <canvas id="monthlyChart"></canvas>
</div>

{{-- ================= CHART JS ================= --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const revenueRaw = @json($monthlyRevenue);

    const labels = [
        'Jan','Feb','Mar','Apr','Mei','Jun',
        'Jul','Agu','Sep','Okt','Nov','Des'
    ];

    const revenueData = labels.map((_, i) => revenueRaw[i + 1] ?? 0);

    new Chart(document.getElementById('monthlyChart'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Pendapatan',
                    data: revenueData,
                    backgroundColor: 'rgba(34,197,94,0.7)'
                }
            ]
        }
    });
</script>


@endsection
