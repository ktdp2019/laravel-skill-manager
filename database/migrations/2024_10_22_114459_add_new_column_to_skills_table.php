<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('skills', function (Blueprint $table) {
    //         $table->unsignedBigInteger('category_id');
    // // Create the new foreign key constraint
    // $table->foreign('category_id')
    //       ->references('skill_category_id')
    //       ->on('skill_category');
        });

        // DB::table('skills')->update([
        //     'category_id' => DB::raw('category_id_old'),
        // ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('skills', function (Blueprint $table) {
            // $table->dropColumn('category_id');
            // $table->dropColumn('category_id_old');
        });
    }
};
