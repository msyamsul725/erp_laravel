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
        Schema::create('head_location', function (Blueprint $table) {
            $table->id();
            $table->string('location_name')->nullable();
            $table->smallInteger('max_lantai')->default(0);
            $table->smallInteger('max_rak')->default(0);
            $table->timestamps(); // Laravel otomatis handle created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('head_location');
    }
};
