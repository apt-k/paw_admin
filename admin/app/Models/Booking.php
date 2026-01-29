<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';

    protected $fillable = [
        'kode_booking',
        'hewan_id',
        'pelayanan_id',
        'karyawan_id',
        'tanggal_booking',
        'tanggal_ambil',
        'status',
        'harga',
        'total',
        'confirmed',
    ];

    // RELASI
    public function hewan()
    {
        return $this->belongsTo(Hewan::class);
    }

    public function pelayanan()
    {
        return $this->belongsTo(Pelayanan::class, 'pelayanan_id');
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }

    // Relasi ke history
    public function histories()
    {
        return $this->hasMany(History::class, 'booking_id');
    }
}
