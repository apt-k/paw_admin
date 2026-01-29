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

.form-box input,
.form-box select {
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

.btn-cancel {
    background: #aaa;
    color: white;
    padding: 10px 16px;
    border-radius: 6px;
    text-decoration: none;
}
</style>

<div class="form-box">
    <h3>Tambah Karyawan</h3>

    <form action="{{ route('karyawan.store') }}" method="POST">
        @csrf

        <label>Nama</label>
        <input type="text" name="nama" required>

        <label>Spesialis</label>
        <select name="spesialis" required>
            <option value="">-- Pilih Spesialis --</option>
            <option value="dog">Groomer Anjing</option>
            <option value="cat">Groomer Kucing</option>
        </select>

        <label>No HP</label>
        <input type="text" name="no_hp" required>

        <button class="btn-save">Simpan</button>
        <a href="{{ route('karyawan.index') }}" class="btn-cancel">Batal</a>
    </form>
</div>

@endsection
