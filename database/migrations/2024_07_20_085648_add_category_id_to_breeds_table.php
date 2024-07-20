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
        Schema::table('breeds', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->after('id'); // Adjust 'after' parameter as needed

            // If you have a categories table and want to add a foreign key constraint:
            $table->foreign('category_id')->references('id')->on('catagories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('breeds', function (Blueprint $table) {
            //
        });
    }
};
