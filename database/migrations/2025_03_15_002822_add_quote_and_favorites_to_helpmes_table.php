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
        Schema::table('helpmes', function (Blueprint $table) {
            $table->boolean('is_quote_request')->default(false);
            $table->foreignId('car_id')->nullable()->constrained('electric_cars')->onDelete('set null');
            $table->boolean('is_favorite')->default(false);
            $table->timestamp('quote_requested_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('helpmes', function (Blueprint $table) {
            $table->dropColumn(['is_quote_request', 'car_id', 'is_favorite', 'quote_requested_at']);
        });
    }
};
