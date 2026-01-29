<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = [
        'booking_id',
        'hewan_id',
        'pelayanan_id',
        'tanggal_booking',
        'status'
    ];

    // Relasi ke booking
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    // Relasi ke hewan
    public function hewan()
    {
        return $this->belongsTo(Hewan::class, 'hewan_id');
    }

    // Relasi ke pelayanan
    public function pelayanan()
    {
        return $this->belongsTo(Pelayanan::class, 'pelayanan_id');
    }
}
