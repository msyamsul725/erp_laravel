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
        Schema::create('locations', function (Blueprint $table) {
            $table->bigIncrements('id'); // PRIMARY KEY auto increment

            $table->string('head_name')->nullable();
            $table->bigInteger('quantity')->nullable();

            $table->timestamps(); // created_at, updated_at

            // FK ke head_locations.id
            $table->foreignId('head_location_id')
                ->nullable()
                ->constrained('head_location')
                ->onDelete('cascade');

            // FK ke users.id
            $table->foreignId('user_id') // lebih idiomatis pakai user_id
                ->nullable()
                ->constrained('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
