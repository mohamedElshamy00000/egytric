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
        Schema::table('products', function (Blueprint $table) {
            // quantity
            $table->string('quantity')->default(1);
            $table->json('features')->nullable(); // المواصفات (تم تغييرها إلى json وجعلها nullable)
            $table->boolean('free_delivery')->default(false); // توصيل مجاني
            $table->boolean('free_return')->default(false); // إرجاع مجاني
            $table->boolean('cash_on_delivery')->default(false); // الدفع عند الاستلام
            $table->boolean('installment_plan')->default(false); // خطة تقسيط
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
