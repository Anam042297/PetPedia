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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->string('pet_name');
    $table->unsignedBigInteger('catagory_id'); // Use unsignedBigInteger for referencing categories id
    $table->foreign('catagory_id')->references('id')->on('catagories')->onDelete('cascade');
    $table->foreignId('breed_id')->constrained()->onDelete('cascade');
    $table->unsignedInteger('age');
    $table->text('description');
    $table->foreignId('image_id')->constrained()->onDelete('cascade');
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
