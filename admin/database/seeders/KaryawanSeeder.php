<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Karyawan;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $karyawans = [
            [
                'nama' => 'Santi',
                'spesialis' => 'cat',
                'no_hp' => '081234567890',
            ],
            [
                'nama' => 'Exel',
                'spesialis' => 'dog',
                'no_hp' => '082345678901',
            ],
            [
                'nama' => 'Wahyu',
                'spesialis' => 'cat',
                'no_hp' => '083456789012',
            ],
        ];

        foreach ($karyawans as $k) {
            Karyawan::create($k);
        }
    }
}
