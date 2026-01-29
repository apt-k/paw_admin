<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $fillable = ['nama', 'spesialis', 'no_hp'];

    //RELASI KE HEWAN
    public function hewans()
    {
        return $this->hasMany(Hewan::class);
    }

}

