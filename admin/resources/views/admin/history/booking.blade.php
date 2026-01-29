@extends('admin.layout.master')

@section('title', 'History Booking')

@section('content')

<style>
.data-box {
    max-width: 900px;
    margin: 40px auto;
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,.08);
    padding: 25px;
}

.data-title {
    text-align: center;
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #4f7385;
}

.table-booking {
    width: 100%;
    border-collapse: collapse;
    border-radius: 10px;
    overflow: hidden;
}

.table-booking th {
    background: #4f7385;
    color: white;
    padding: 12px;
    text-align: center;
}

.table-booking td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
    text-align: center;
}

.table-booking tr:hover {
    background: #f2f6f9;
}

.status-done {
    color: #155724;
    background: #d4edda;
    padding: 4px 8px;
    border-radius: 5px;
    font-weight: bold;
}

.status-cancel {
    color: #721c24;
    background: #f8d7da;
    padding: 4px 8px;
    border-radius: 5px;
    font-weight: bold;
}
</style>

<div class="data-box">

    <div class="data-title">History Booking</div>

    <table class="table-booking">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Booking</th>
                <th>Nama Hewan</th>
                <th>Pelayanan</th>
                <th>Status</th>
                <th>Tanggal Booking</th>
            </tr>
        </thead>
        <tbody>
            @forelse($histories as $h)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $h->booking->kode_booking ?? '-' }}</td>
                <td>{{ $h->hewan->nama_hewan ?? '-' }}</td>
                <td>{{ $h->pelayanan->nama_pelayanan ?? '-' }}</td>
                <td>
                    @if($h->status == 'done')
                        <span class="status-done">Done</span>
                    @elseif($h->status == 'canceled')
                        <span class="status-cancel">Canceled</span>
                    @else
                        {{ $h->status }}
                    @endif
                </td>
                <td>{{ \Carbon\Carbon::parse($h->tanggal_booking)->format('d/m/Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-gray-400">Belum ada data history</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection
