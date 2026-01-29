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
       Schema::create('messages', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel konsumen (users)
            $table->unsignedBigInteger('konsumen_id')->nullable(); 
            
            $table->text('pesan');                // Pertanyaan konsumen
            $table->enum('status', ['pending','replied'])->default('pending');
            $table->text('balasan')->nullable();  // Balasan admin
            
            $table->timestamps();

            // Foreign key
            $table->foreign('konsumen_id')
                  ->references('id')
                  ->on('konsumens') // atau 'users' kalau pakai tabel users
                  ->onDelete('set null'); // kalau konsumen dihapus, pesan tetap ada tapi konsumen_id null
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
