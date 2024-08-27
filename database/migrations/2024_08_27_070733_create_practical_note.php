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
        Schema::create('practical_note', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('practical_id');
            $table->string('note');
            $table->foreign('practical_id')->references('id')->on('practical');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('practical_note');
    }
};
