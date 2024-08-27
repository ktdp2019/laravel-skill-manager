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
        Schema::create('theory_note', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('theory_id');
            $table->string('note');
            $table->foreign('theory_id')->references('id')->on('theory');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('theory_note');
    }
};
