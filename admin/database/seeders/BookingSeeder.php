<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // BOOKING 1
        Booking::create([
            'kode_booking'   => 'BK-001',
            'hewan_id'       => 1,
            'pelayanan_id'  => 1,
            'karyawan_id'   => 1,
            'tanggal_booking' => '2026-01-20',
            'tanggal_ambil'   => '2026-01-20',
            'status'        => 'booking',
            'harga'         => 50000,
            'total'         => 50000,
        ]);

        // BOOKING 2
        Booking::create([
            'kode_booking'   => 'BK-002',
            'hewan_id'       => 2,
            'pelayanan_id'  => 2,
            'karyawan_id'   => 2,
            'tanggal_booking' => '2026-01-21',
            'tanggal_ambil'   => '2026-01-21',
            'status'        => 'process',
            'harga'         => 80000,
            'total'         => 80000,
        ]);

        // BOOKING 3 (SELESAI)
        Booking::create([
            'kode_booking'   => 'BK-003',
            'hewan_id'       => 3,
            'pelayanan_id'  => 3,
            'karyawan_id'   => 1,
            'tanggal_booking' => '2026-01-18',
            'tanggal_ambil'   => '2026-01-18',
            'status'        => 'done',
            'harga'         => 120000,
            'total'         => 120000,
        ]);
    }
}
