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
        Schema::create('helpmes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('city');
            $table->string('area');
            $table->boolean('use_car_to_travel');
            $table->string('property_type');
            $table->json('selected_brands');
            $table->decimal('price_range', 10, 2);
            $table->text('comment');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
        // Pivot table for brands relationship
        Schema::create('help_request_brands', function (Blueprint $table) {
            $table->id();
            $table->foreignId('helpme_id')->constrained('helpmes')->onDelete('cascade');
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('help_request_brands');
        Schema::dropIfExists('helpmes');
    }
};
