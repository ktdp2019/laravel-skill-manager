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
        Schema::table('sprint', function (Blueprint $table) {
            $table->dropForeign(['skill_id']); // Drop the foreign key constraint
            $table->dropColumn('skill_id');  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sprint', function (Blueprint $table) {
            $table->unsignedBigInteger('skill_id');
            $table->foreign('skill_id')->references('id')->on('skills'); 
        });
    }
};
