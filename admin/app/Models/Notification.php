<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id',   // relasi ke tabel konsumens
        'title',     // judul notifikasi
        'message',   // isi notifikasi
        'is_read',   // status sudah dibaca
    ];

    // RELASI KE USER (KONSUMEN)
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
}
