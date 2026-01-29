<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
        ]);

        $this->call(PelayananSeeder::class);

        $this->call(KaryawanSeeder::class);

        $this->call([
            KonsumenSeeder::class,
            HewanSeeder::class,
        ]);

        $this->call([
            MessageSeeder::class,
        ]);

        $this->call([
            BookingSeeder::class,
        ]);
    }
}
