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
        Schema::create('practicle', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("title");
            $table->boolean('completed')->default(false);
            $table->integer('serial_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('practicle');
    }
};
