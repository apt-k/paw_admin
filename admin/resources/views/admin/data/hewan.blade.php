@extends('admin.layout.master')

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
    font-size: 22px;
    font-weight: bold;
    margin-bottom: 10px;
}

.btn-add {
    display: inline-block;
    margin-bottom: 20px;
    background: #4f7385;
    color: white;
    padding: 8px 16px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: bold;
}

.btn-add:hover {
    background: #3d5f70;
}

.table-karyawan {
    width: 100%;
    border-collapse: collapse;
    border-radius: 10px;
    overflow: hidden;
}

.table-karyawan th {
    background: #4f7385;
    color: white;
    padding: 12px;
    text-align: center;
}

.table-karyawan td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
    text-align: center;
}

.table-karyawan tr:hover {
    background: #f2f6f9;
}

.action-link {
    color: #4f7385;
    text-decoration: none;
    font-weight: bold;
    margin: 0 5px;
}

.action-link:hover {
    text-decoration: underline;
}

.icon-btn {
    background: none;
    border: none;
    cursor: pointer;
    font-weight: bold;
}

.icon-delete {
    color: red;
}
</style>

<div class="data-box">

    <div class="data-title">Data Hewan</div>

    @if(session('success'))
        <div style="background:#d4edda;padding:10px;border-radius:5px;color:#155724;margin-bottom:10px;">
            {{ session('success') }}
        </div>
    @endif

    <table class="table-karyawan">
        <tr>
            <th>No</th>
            <th>Nama Hewan</th>
            <th>Jenis</th>
            <th>Ras</th>
            <th>Nama Pemilik</th>
            <th>Email</th>
            <th>No HP</th>
        </tr>

        @foreach($hewans as $k)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $k->nama_hewan }}</td>
            <td>
                @if($k->jenis_hewan == 'Anjing')
                    dog
                @elseif($k->jenis_hewan == 'Kucing')
                    cat
                @else
                    {{ $k->jenis_hewan }}
                @endif
            </td>
            <td>{{ $k->ras }}</td>
            <td>{{ $k->konsumen->nama_pemilik }}</td>
            <td>{{ $k->konsumen->email }}</td>
            <td>{{ $k->konsumen->no_hp }}</td>
            <td>
            </td>
        </tr>
        @endforeach
    </table>

</div>

@endsection
