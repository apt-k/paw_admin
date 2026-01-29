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
        Schema::table('bookings', function (Blueprint $table) {
            // 1. Hapus foreign key lama
            $table->dropForeign(['konsumen_id']);

            // 2. Hapus kolom konsumen_id
            $table->dropColumn('konsumen_id');

            // 3. Tambah kolom hewan_id
            $table->unsignedBigInteger('hewan_id')->after('kode_booking');

            // 4. Tambah foreign key baru ke tabel hewans
            $table->foreign('hewan_id')
                  ->references('id')
                  ->on('hewans')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // rollback: hapus hewan_id
            $table->dropForeign(['hewan_id']);
            $table->dropColumn('hewan_id');

            // kembalikan konsumen_id
            $table->unsignedBigInteger('konsumen_id')->after('kode_booking');

            $table->foreign('konsumen_id')
                  ->references('id')
                  ->on('konsumens')
                  ->onDelete('cascade');
        });
    }
};
