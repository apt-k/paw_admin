@extends('admin.layout.master')

@section('content')

<style>
.form-box {
    max-width: 500px;
    margin: 40px auto;
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,.08);
}

.form-box h3 {
    text-align: center;
    margin-bottom: 20px;
    color: #4f7385;
}

.form-box label {
    font-weight: bold;
}

.form-box input, .form-box textarea {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 15px;
    border-radius: 6px;
    border: 1px solid #ccc;
}

.btn-save {
    background: #4f7385;
    color: white;
    padding: 10px 16px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
}

.btn-save:hover {
    background: #3d5f70;
}

.btn-cancel {
    background: #aaa;
    color: white;
    padding: 10px 16px;
    border-radius: 6px;
    text-decoration: none;
}
</style>

<div class="form-box">
    <h3>Tambah Layanan</h3>

    <form action="{{ route('pelayanan.store') }}" method="POST">
        @csrf

        <label>Nama Layanan</label>
        <input type="text" name="nama_pelayanan" required> 

        <label>Deskripsi</label>
        <textarea name="deskripsi" rows="4" required></textarea>

        <label>Harga</label>
        <input type="number" name="harga" required>

        <button type="submit" class="btn-save">Simpan</button>
        <a href="{{ route('pelayanan.index') }}" class="btn-cancel">Kembali</a>
    </form>
</div>

@endsection
