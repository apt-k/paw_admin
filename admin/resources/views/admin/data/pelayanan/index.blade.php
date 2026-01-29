@extends('admin.layout.master')

@section('content')

<style>
.data-box {
    max-width: 950px;
    margin: 40px auto;
    background: white;
    border-radius: 14px;
    box-shadow: 0 10px 25px rgba(0,0,0,.08);
    padding: 30px;
}

.data-title {
    text-align: center;
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 25px;
    color: #4f7385;
}

.btn-add {
    display: inline-block;
    margin-bottom: 25px;
    background: #4f7385;
    color: white;
    padding: 10px 22px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: .2s;
}

.btn-add:hover {
    background: #3d5f70;
}

.table-data {
    width: 100%;
    border-collapse: collapse;
    border-radius: 10px;
    overflow: hidden;
}

.table-data th {
    background: #4f7385;
    color: white;
    padding: 14px 12px;
    text-align: center;
    font-weight: 600;
    font-size: 15px;
}

.table-data td {
    padding: 14px 12px;
    border-bottom: 1px solid #e5e7eb;
    text-align: center;
    font-size: 14px;
}

.table-data tr:hover {
    background: #f2f6f9;
}

.nama-layanan {
    font-weight: 600;
    color: #374151;
}

/* DESKRIPSI */
.deskripsi {
    color: #555;
    line-height: 1.5;
}

.harga {
    font-weight: bold;
    color: #2f7a5f;
}

.aksi {
    display: flex;
    justify-content: center;
    gap: 10px;  
}

.btn-edit {
    background: #4f7385;
    color: white;
    padding: 6px 14px;
    border-radius: 6px;
    font-size: 13px;
    text-decoration: none;
    transition: .2s;
}

.btn-edit:hover {
    background: #3d5f70;
}

.btn-delete {
    background: #dc2626;
    color: white;
    padding: 6px 14px;
    border-radius: 6px;
    font-size: 13px;
    border: none;
    cursor: pointer;
    transition: .2s;
}

.btn-delete:hover {
    background: #b91c1c;
}
</style>

<div class="data-box">

    <div class="data-title">Data Layanan</div>

    <center>
        <a href="{{ route('pelayanan.create') }}" class="btn-add">+ Tambah Layanan</a>
    </center>

    @if(session('success'))
        <div style="background:#e6f3ef;padding:12px;border-radius:6px;color:#2f7a5f;margin-bottom:15px;text-align:center;">
            {{ session('success') }}
        </div>
    @endif

    <table class="table-data">
        <thead>
            <tr>
                <th width="60">No</th>
                <th width="200">Nama Layanan</th>
                <th>Deskripsi</th>
                <th width="140">Harga</th>
                <th width="180">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($pelayanan as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>

                <td class="nama-layanan">
                    {{ $p->nama_pelayanan }}
                </td>

                <td class="deskripsi">
                    {{ $p->deskripsi }}
                </td>

                <td class="harga">
                    Rp {{ number_format($p->harga,0,',','.') }}
                </td>

                <td>
                    <div class="aksi">
                        <a href="{{ route('pelayanan.edit', $p->id) }}" class="btn-edit">
                            Edit
                        </a>

                        <form action="{{ route('pelayanan.destroy', $p->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Hapus layanan ini?')" class="btn-delete">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
