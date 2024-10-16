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
        Schema::create('car_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->nullable();
            $table->enum('status', ['new', 'processing', 'shipped', 'Delivered' ,'cancelled'])->default('new');
            $table->string('currency')->nullable();
            $table->decimal('shipping_amount', 10, 2)->nullable();
            $table->text('shipping_method')->nullable();
            $table->text('note')->nullable();
            $table->unsignedBigInteger('electric_car_id');
            $table->foreign('electric_car_id')->references('id')->on('electric_cars')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_orders');
    }
};
