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
        Schema::create('goal', function(Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->unsignedBigInteger('skill_id');
            $table->foreign('skill_id')->references('id')->on('skills');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('goal', function (Blueprint $table) {
            $table->dropForeign(['skill_id']); // Drop the foreign key constraint
            $table->dropColumn(['id', 'title', 'start_date', 'end_date', 'skill_id']); // Drop the specified columns
            $table->dropTimestamps(); // Drop the timestamps columns
        });
    }
};
