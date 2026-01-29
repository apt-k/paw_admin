<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelayanan extends Model
{
     protected $fillable = ['nama_pelayanan', 'deskripsi', 'harga'];


    //RELASI KE BOOKING
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'pelayanan_id');
    }
}
