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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();

            // Foreign key ke bookings
            $table->unsignedBigInteger('booking_id');
            $table->foreign('booking_id')
                  ->references('id')->on('bookings')
                  ->onDelete('cascade');

            // Foreign key ke hewans
            $table->unsignedBigInteger('hewan_id');
            $table->foreign('hewan_id')
                  ->references('id')->on('hewans') // pastikan nama tabel sesuai
                  ->onDelete('cascade');

            // Foreign key ke pelayanans
            $table->unsignedBigInteger('pelayanan_id');
            $table->foreign('pelayanan_id')
                  ->references('id')->on('pelayanans') // pastikan nama tabel sesuai
                  ->onDelete('cascade');

            $table->date('tanggal_booking');
            $table->enum('status', ['done', 'canceled']);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
