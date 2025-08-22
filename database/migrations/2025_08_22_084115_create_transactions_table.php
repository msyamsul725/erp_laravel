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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id(); // id bigint auto increment
            $table->foreignId('location_id')
                ->constrained('locations') // referensi ke tabel locations
                ->onDelete('cascade');    // kalau location dihapus, transaksi ikut hilang
            $table->foreignId('part_id')
                ->constrained('parts')    // referensi ke tabel parts
                ->onDelete('cascade');    // kalau part dihapus, transaksi ikut hilang
            $table->timestamps(); // created_at & updated_at otomatis

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
