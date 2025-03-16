<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class ElectricCarsTemplateExport implements WithHeadings
{
    /**
     * Define the column headers for the export file.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'brand_id',
            'model',
            'year',
            'condition',
            'body_type',
            'mileage',
            'transmission',
            'drivetrain',
            'range_km',
            'battery_capacity',
            'horsepower',
            'acceleration',
            'top_speed_kmh',
            'mpge_city',
            'mpge_highway',
            'charging_time_ac',
            'charging_time_dc',
            'home_charger_type',
            'home_charging_power',
            'home_charging_time_hours',
            'includes_home_charger',
            'battery_type',
            'battery_modules',
            'battery_cells',
            'battery_voltage',
            'battery_cycles',
            'battery_warranty',
            'battery_degradation_rate',
            'battery_thermal_management',
            'airbag_count',
            'crash_test_rating',
            'has_pedestrian_alert',
            'has_battery_protection',
            'has_lane_departure',
            'has_blind_spot',
            'has_emergency_brake',
            'has_fast_charging',
            'length_mm',
            'width_mm',
            'wheelbase_mm',
            'ground_clearance_mm',
            'cargo_volume_l',
            'curb_weight_kg',
            'gross_weight_kg',
            'payload_capacity_kg',
            'seating_capacity',
            'power_consumption_kwh_100km',
            'regenerative_levels',
            'max_regenerative_power',
            'charging_ports',
            'description',
            'msrp',
            'offer_price',
            'is_available',
            'exterior_color',
            'interior_color',
            'features',
        ];
    }
}
