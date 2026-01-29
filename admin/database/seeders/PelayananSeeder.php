<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pelayanan;

class PelayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $layanan = [
            [
                'nama_pelayanan' => 'Grooming Basic',
                'deskripsi' => 'Perawatan dasar meliputi mandi, pengeringan, pembersihan telinga, dan pemotongan kuku',
                'harga' => 50000,
            ],
            [
                'nama_pelayanan' => 'Grooming Premium',
                'deskripsi' => 'Perawatan lengkap termasuk sisir bulu mati, pembersihan gigi ringan, dan perawatan bulu',
                'harga' => 100000,
            ],
            [
                'nama_pelayanan' => 'Grooming Special',
                'deskripsi' => 'Perawatan eksklusif dengan spa, vitamin bulu, anti kutu, dan styling khusus',
                'harga' => 200000,
            ],
        ];

        foreach ($layanan as $l) {
            Pelayanan::create($l);
        }
    }
}
