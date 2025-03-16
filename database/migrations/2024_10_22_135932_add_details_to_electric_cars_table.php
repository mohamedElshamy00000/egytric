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
        Schema::table('electric_cars', function (Blueprint $table) {

            // معلومات الشحن المنزلي
            $table->string('home_charger_type')->nullable(); // نوع الشاحن المنزلي
            $table->integer('home_charging_power')->nullable(); // قدرة الشحن المنزلي بالكيلوواط
            $table->integer('home_charging_time_hours')->nullable(); // وقت الشحن المنزلي بالساعات
            $table->boolean('includes_home_charger')->default(false); // هل يشمل شاحن منزلي

            // معلومات البطارية
            $table->string('battery_type')->nullable(); // نوع البطارية
            $table->integer('battery_modules')->nullable(); // عدد وحدات البطارية
            $table->integer('battery_cells')->nullable(); // عدد خلايا البطارية
            $table->decimal('battery_voltage', 6, 1)->nullable(); // فولتية البطارية
            $table->integer('battery_cycles')->nullable(); // عدد دورات الشحن المتوقعة
            $table->string('battery_warranty')->nullable(); // ضمان البطارية
            $table->decimal('battery_degradation_rate', 4, 2)->nullable(); // معدل تدهور البطارية السنوي
            $table->decimal('battery_thermal_management', 4, 1)->nullable(); // نظام إدارة حرارة البطارية

            // معلومات الأمان
            $table->integer('airbag_count')->nullable(); // عدد الوسائد الهوائية
            $table->string('crash_test_rating')->nullable(); // تصنيف اختبار التصادم
            $table->boolean('has_pedestrian_alert')->default(false); // نظام تنبيه المشاة
            $table->boolean('has_battery_protection')->default(false); // نظام حماية البطارية
            $table->boolean('has_lane_departure')->default(false); // نظام مغادرة المسار
            $table->boolean('has_blind_spot')->default(false); // نظام كشف النقاط العمياء
            $table->boolean('has_emergency_brake')->default(false); // نظام الفرامل الطارئ

            // الأبعاد والوزن
            $table->integer('length_mm')->nullable(); // الطول بالملم
            $table->integer('width_mm')->nullable(); // العرض بالملم
            $table->integer('wheelbase_mm')->nullable(); // قاعدة العجلات بالملم
            $table->decimal('ground_clearance_mm', 6, 1)->nullable(); // الارتفاع عن الأرض
            $table->integer('cargo_volume_l')->nullable(); // حجم صندوق الأمتعة باللتر
            $table->decimal('curb_weight_kg', 7, 1)->nullable(); // وزن السيارة فارغة
            $table->decimal('gross_weight_kg', 7, 1)->nullable(); // الوزن الإجمالي المسموح
            $table->decimal('payload_capacity_kg', 6, 1)->nullable(); // سعة الحمولة
            $table->integer('seating_capacity')->nullable(); // عدد المقاعد

            $table->json('charging_ports')->nullable(); // أنواع منافذ الشحن المتوفرة
            $table->boolean('has_fast_charging')->default(false); // دعم الشحن السريع
            // معلومات الأداء الإضافية
            $table->decimal('power_consumption_kwh_100km', 4, 1)->nullable(); // استهلاك الطاقة لكل 100 كم
            $table->integer('regenerative_levels')->nullable(); // مستويات الكبح التجديدي
            $table->decimal('max_regenerative_power', 5, 1)->nullable(); // أقصى قدرة للكبح التجديدي

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('electric_cars', function (Blueprint $table) {
            //
        });
    }
};
