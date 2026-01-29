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
        Schema::table('karyawans', function (Blueprint $table) {

            // hapus kolom lama
            if (Schema::hasColumn('karyawans', 'jabatan')) {
                $table->dropColumn('jabatan');
            }

            // tambah kolom baru
            $table->enum('spesialis', ['dog', 'cat'])
                  ->after('nama');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('karyawans', function (Blueprint $table) {

            // hapus spesialis
            if (Schema::hasColumn('karyawans', 'spesialis')) {
                $table->dropColumn('spesialis');
            }

            // kembalikan jabatan
            $table->string('jabatan')->after('nama');
        });
    }
};
