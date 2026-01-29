<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Message;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Message::create([
            'konsumen_id' => 1,
            'pesan' => 'Apakah grooming basic bisa untuk kucing persia?',
            'status' => 'pending',
            'balasan' => null,
        ]);

        Message::create([
            'konsumen_id' => 2,
            'pesan' => 'Berapa lama proses grooming premium?',
            'status' => 'pending',
            'balasan' => null,
        ]);

        // PESAN SUDAH DIBALAS
        Message::create([
            'konsumen_id' => 1,
            'pesan' => 'Apakah bisa booking hari Minggu?',
            'status' => 'replied',
            'balasan' => 'Bisa kak, kami buka setiap hari termasuk Minggu.',
        ]);
    }
}
