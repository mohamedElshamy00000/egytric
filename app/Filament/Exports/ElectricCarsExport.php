<?php

namespace App\Filament\Exports;

use App\Models\ElectricCar;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Collection;

class ElectricCarsExport extends Exporter
{
    protected static ?string $model = ElectricCar::class;

    // This will create a template with all columns but no data
    public static function getColumns(): array
    {
        return [
            ExportColumn::make('brand_id'),
            ExportColumn::make('model'),
            ExportColumn::make('year'),
            ExportColumn::make('condition'),
            ExportColumn::make('body_type'),
            ExportColumn::make('mileage'),
            ExportColumn::make('transmission'),
            ExportColumn::make('drivetrain'),
            ExportColumn::make('range_km'),
            ExportColumn::make('battery_capacity'),
            ExportColumn::make('horsepower'),
            ExportColumn::make('acceleration'),
            ExportColumn::make('top_speed_kmh'),
            ExportColumn::make('mpge_city'),
            ExportColumn::make('mpge_highway'),
            ExportColumn::make('charging_time_ac'),
            ExportColumn::make('charging_time_dc'),
            ExportColumn::make('home_charger_type'),
            ExportColumn::make('home_charging_power'),
            ExportColumn::make('home_charging_time_hours'),
            ExportColumn::make('includes_home_charger'),
            ExportColumn::make('battery_type'),
            ExportColumn::make('battery_modules'),
            ExportColumn::make('battery_cells'),
            ExportColumn::make('battery_voltage'),
            ExportColumn::make('battery_cycles'),
            ExportColumn::make('battery_warranty'),
            ExportColumn::make('battery_degradation_rate'),
            ExportColumn::make('battery_thermal_management'),
            ExportColumn::make('airbag_count'),
            ExportColumn::make('crash_test_rating'),
            ExportColumn::make('has_pedestrian_alert'),
            ExportColumn::make('has_battery_protection'),
            ExportColumn::make('has_lane_departure'),
            ExportColumn::make('has_blind_spot'),
            ExportColumn::make('has_emergency_brake'),
            ExportColumn::make('has_fast_charging'),
            ExportColumn::make('length_mm'),
            ExportColumn::make('width_mm'),
            ExportColumn::make('wheelbase_mm'),
            ExportColumn::make('ground_clearance_mm'),
            ExportColumn::make('cargo_volume_l'),
            ExportColumn::make('curb_weight_kg'),
            ExportColumn::make('gross_weight_kg'),
            ExportColumn::make('payload_capacity_kg'),
            ExportColumn::make('seating_capacity'),
            ExportColumn::make('power_consumption_kwh_100km'),
            ExportColumn::make('regenerative_levels'),
            ExportColumn::make('max_regenerative_power'),
            ExportColumn::make('charging_ports'),
            ExportColumn::make('description'),
            ExportColumn::make('msrp'),
            ExportColumn::make('offer_price'),
            ExportColumn::make('is_available'),
            ExportColumn::make('exterior_color'),
            ExportColumn::make('interior_color'),
            ExportColumn::make('features'),
        ];
    }

    // This will return an empty collection for the template, or you can provide the actual data
    public function getRows(): Collection
    {
        return ElectricCar::all()->map(function ($car) {
            return [
                'brand_id' => $car->brand_id,
                'model' => $car->model,
                'year' => $car->year,
                'condition' => $car->condition,
                'body_type' => $car->body_type,
                'mileage' => $car->mileage,
                'transmission' => $car->transmission,
                'drivetrain' => $car->drivetrain,
                'range_km' => $car->range_km,
                'battery_capacity' => $car->battery_capacity,
                'horsepower' => $car->horsepower,
                'acceleration' => $car->acceleration,
                'top_speed_kmh' => $car->top_speed_kmh,
                'mpge_city' => $car->mpge_city,
                'mpge_highway' => $car->mpge_highway,
                'charging_time_ac' => $car->charging_time_ac,
                'charging_time_dc' => $car->charging_time_dc,
                'home_charger_type' => $car->home_charger_type,
                'home_charging_power' => $car->home_charging_power,
                'home_charging_time_hours' => $car->home_charging_time_hours,
                'includes_home_charger' => $car->includes_home_charger,
                'battery_type' => $car->battery_type,
                'battery_modules' => $car->battery_modules,
                'battery_cells' => $car->battery_cells,
                'battery_voltage' => $car->battery_voltage,
                'battery_cycles' => $car->battery_cycles,
                'battery_warranty' => $car->battery_warranty,
                'battery_degradation_rate' => $car->battery_degradation_rate,
                'battery_thermal_management' => $car->battery_thermal_management,
                'airbag_count' => $car->airbag_count,
                'crash_test_rating' => $car->crash_test_rating,
                'has_pedestrian_alert' => $car->has_pedestrian_alert,
                'has_battery_protection' => $car->has_battery_protection,
                'has_lane_departure' => $car->has_lane_departure,
                'has_blind_spot' => $car->has_blind_spot,
                'has_emergency_brake' => $car->has_emergency_brake,
                'has_fast_charging' => $car->has_fast_charging,
                'length_mm' => $car->length_mm,
                'width_mm' => $car->width_mm,
                'wheelbase_mm' => $car->wheelbase_mm,
                'ground_clearance_mm' => $car->ground_clearance_mm,
                'cargo_volume_l' => $car->cargo_volume_l,
                'curb_weight_kg' => $car->curb_weight_kg,
                'gross_weight_kg' => $car->gross_weight_kg,
                'payload_capacity_kg' => $car->payload_capacity_kg,
                'seating_capacity' => $car->seating_capacity,
                'power_consumption_kwh_100km' => $car->power_consumption_kwh_100km,
                'regenerative_levels' => $car->regenerative_levels,
                'max_regenerative_power' => $car->max_regenerative_power,
                'charging_ports' => is_array($car->charging_ports) ? implode('|', $car->charging_ports) : '',
                'description' => $car->description,
                'msrp' => $car->msrp,
                'offer_price' => $car->offer_price,
                'is_available' => $car->is_available,
                'exterior_color' => $car->exterior_color,
                'interior_color' => $car->interior_color,
                'features' => is_array($car->features) ? implode('|', $car->features) : '',
            ];
        });
    }

    // Required method to define the notification message
    public static function getCompletedNotificationBody(Export $export): string
    {
        return 'Your template has been exported and is ready to download.';
    }
}
