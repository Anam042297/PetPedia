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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('tracking_id')->unique();
            $table->string('name');
            $table->string('city');
            $table->string('address');
            $table->string('phone_no');
            $table->string('payment_method');
            $table->enum('status', ['pending', 'completed', 'shipped', 'cancelled'])->default('pending');
            $table->decimal('total_amount', 8, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
