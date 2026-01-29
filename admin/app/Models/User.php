<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use Notifiable;

    protected $table = 'konsumens';

    protected $fillable = [
        'nama_pemilik',
        'email',
        'password',
        'no_hp',
        'alamat'
    ];

    protected $hidden = [
        'password',
    ];

    // RELASI KE BOOKING
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'konsumen_id');
    }

    public function hewans()
    {
        return $this->hasMany(Hewan::class, 'konsumen_id');
    }

    public function notifications()
    {
        return $this->hasMany(\App\Models\Notification::class, 'user_id');
    }

}
