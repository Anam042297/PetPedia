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
        Schema::create('pet_products', function (Blueprint $table) {
            $table->id();
            $table->string('serial_number');
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->enum('type', ['food', 'accessory']);
            $table->decimal('price', 8, 2);
            $table->unsignedBigInteger('pet_category_id');
            $table->decimal('weight', 8, 2)->nullable();
            $table->string('company')->nullable();
            $table->unsignedInteger('quantity')->default(0);
            $table->timestamps();

            // Define foreign key if needed
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('pet_category_id')->references('id')->on('pet_categories')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pet_products');
    }
};
