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
        Schema::create('electric_cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained('brands');
            $table->string('slug')->unique();
            $table->string('model');
            $table->year('year'); // السنة
            $table->decimal('msrp', 10, 2); // Manufacturer's Suggested Retail Price
            $table->decimal('offer_price', 10, 2)->nullable();
            $table->integer('range_km')->nullable();
            $table->decimal('battery_capacity', 5, 1); // بالكيلوواط ساعة
            $table->integer('horsepower');
            $table->decimal('acceleration', 3, 1); // 0-60 ميل/ساعة بالثواني
            $table->integer('mpge_city'); // Miles Per Gallon Equivalent (City Driving)
            $table->integer('mpge_highway'); // Miles Per Gallon Equivalent (Highway Driving)
            $table->integer('charging_time_ac'); // بالدقائق
            $table->integer('charging_time_dc'); // بالدقائق
            $table->string('condition'); // حالة السيارة
            $table->string('body_type'); // نوع السيارة
            $table->integer('mileage')->nullable();
            $table->string('transmission'); // نوع التروس
            $table->string('exterior_color'); // لون الخارج
            $table->string('interior_color')->nullable(); // اللون الداخلي (تم تصحيح الإملاء)
            $table->json('features')->nullable(); // المواصفات (تم تغييرها إلى json وجعلها nullable)

            $table->integer('top_speed_kmh')->nullable();
            $table->string('drivetrain')->nullable(); // نوع القوة
            $table->longText('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('electric_cars');
    }
};
