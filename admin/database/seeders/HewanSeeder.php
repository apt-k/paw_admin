<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Hewan;

class HewanSeeder extends Seeder
{
    public function run()
    {
        // Ambil konsumen yang sudah dibuat
        $reva = User::where('email', 'reva@gmail.com')->first();
        $apta = User::where('email', 'apta@gmail.com')->first();
        $dara = User::where('email', 'dara@gmail.com')->first();

        // Tambahkan hewan untuk masing-masing konsumen
        Hewan::create([
            'konsumen_id' => $reva->id,
            'nama_hewan' => 'Willo',
            'jenis_hewan' => 'Anjing',
            'ras' => 'Pitbull',

        ]);

        Hewan::create([
            'konsumen_id' => $apta->id,
            'nama_hewan' => 'Bubu',
            'jenis_hewan' => 'Kucing',
            'ras' => 'Himalaya',
        ]);

        Hewan::create([
            'konsumen_id' => $apta->id,
            'nama_hewan' => 'Lino',
            'jenis_hewan' => 'Kucing',
            'ras' => 'Persia',

        ]);

        Hewan::create([
            'konsumen_id' => $dara->id,
            'nama_hewan' => 'Ciyo',
            'jenis_hewan' => 'Kucing',
            'ras' => 'Anggora',

        ]);
    }
}
