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
        Schema::create('parts', function (Blueprint $table) {
            $table->id(); // bigint auto increment primary key
            $table->string('part_number')->unique(); // text UNIQUE
            $table->string('part_name')->nullable(); // varchar, boleh null
            $table->smallInteger('stock')->default(0); // smallint
            $table->smallInteger('minimum')->default(0); // smallint
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parts');
    }
};
