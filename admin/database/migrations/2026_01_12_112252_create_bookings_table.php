<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('kode_booking')->unique();

            $table->foreignId('konsumen_id')->constrained()->cascadeOnDelete();
            $table->foreignId('pelayanan_id')->constrained()->cascadeOnDelete();
            $table->foreignId('karyawan_id')->nullable()->constrained()->nullOnDelete();

            $table->date('tanggal_booking');

            $table->enum('status', ['booking','process','done','canceled'])
                ->default('booking');
            

            $table->decimal('harga', 12, 2);
            $table->decimal('total', 12, 2);

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
