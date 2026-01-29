<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['konsumen_id','pesan','status','balasan'];

    public function konsumen()
    {
        return $this->belongsTo(User::class, 'konsumen_id'); // atau Konsumen::class
    }
}
