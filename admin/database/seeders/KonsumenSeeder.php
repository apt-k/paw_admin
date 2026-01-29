<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class KonsumenSeeder extends Seeder
{
    public function run()
    {
        // Contoh data konsumen / hewan
        $data = [
            [
                'nama_pemilik' => 'Reva',
                'email' => 'reva@gmail.com',
                'no_hp' => '081234567890',
                'alamat' => 'Jl. Melati No. 12, Yogyakarta',
                'password' => bcrypt('reva3268'),
            ],
            [
                
                'nama_pemilik' => 'Apta',
                'email' => 'apta@gmail.com',
                'no_hp' => '08533466577',
                'alamat' => 'Jl. Kenanga No. 45, Yogyakarta',
                'password' => bcrypt('apta3266'),
            ],
            [
                
                'nama_pemilik' => 'Dara',
                'email' => 'dara@gmail.com',
                'no_hp' => '081356789012',
                'alamat' => 'Jl. Mawar No. 8, Yogyakarta',
                'password' => bcrypt('dara3247'),
            ],
        ];

        foreach ($data as $konsumens) {
            User::create($konsumens);
        }
    }
}
