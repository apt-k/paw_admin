<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hewan extends Model
{
    protected $fillable = ['konsumen_id','nama_hewan','jenis_hewan','ras'];

    public function konsumen()
    {
        return $this->belongsTo(User::class, 'konsumen_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
