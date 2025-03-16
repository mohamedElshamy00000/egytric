<?php

namespace App\Filament\Imports;

use App\Models\ElectricCar;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Models\Import;

class ElectricCarsImport extends Importer
{
    protected static ?string $model = ElectricCar::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('brand_id')

                ->numeric(),
            ImportColumn::make('model')
                ,
            ImportColumn::make('year')

                ->numeric(),
            ImportColumn::make('condition')
                ,
            ImportColumn::make('body_type')
                ,
            ImportColumn::make('mileage')
                ->numeric(),
            ImportColumn::make('transmission'),
            ImportColumn::make('drivetrain'),
            ImportColumn::make('range_km')
                ->numeric(),
            ImportColumn::make('battery_capacity')
                ->numeric(),
            ImportColumn::make('horsepower')
                ->numeric(),
            ImportColumn::make('acceleration')
                ->numeric(),
            ImportColumn::make('top_speed_kmh')
                ->numeric(),
            ImportColumn::make('mpge_city')
                ->numeric(),
            ImportColumn::make('mpge_highway')
                ->numeric(),
            ImportColumn::make('charging_time_ac')
                ->numeric(),
            ImportColumn::make('charging_time_dc')
                ->numeric(),
            ImportColumn::make('home_charger_type'),
            ImportColumn::make('home_charging_power')
                ->numeric(),
            ImportColumn::make('home_charging_time_hours')
                ->numeric(),
            ImportColumn::make('includes_home_charger')
                ->boolean(),
            ImportColumn::make('battery_type'),
            ImportColumn::make('battery_modules'),
            ImportColumn::make('battery_cells'),
            ImportColumn::make('battery_voltage')
                ->numeric(),
            ImportColumn::make('battery_cycles')
                ->numeric(),
            ImportColumn::make('battery_warranty'),
            ImportColumn::make('battery_degradation_rate'),
            ImportColumn::make('battery_thermal_management'),
            ImportColumn::make('airbag_count')
                ->numeric(),
            ImportColumn::make('crash_test_rating'),
            ImportColumn::make('has_pedestrian_alert')
                ->boolean(),
            ImportColumn::make('has_battery_protection')
                ->boolean(),
            ImportColumn::make('has_lane_departure')
                ->boolean(),
            ImportColumn::make('has_blind_spot')
                ->boolean(),
            ImportColumn::make('has_emergency_brake')
                ->boolean(),
            ImportColumn::make('has_fast_charging')
                ->boolean(),
            ImportColumn::make('length_mm')
                ->numeric(),
            ImportColumn::make('width_mm')
                ->numeric(),
            ImportColumn::make('wheelbase_mm')
                ->numeric(),
            ImportColumn::make('ground_clearance_mm')
                ->numeric(),
            ImportColumn::make('cargo_volume_l')
                ->numeric(),
            ImportColumn::make('curb_weight_kg')
                ->numeric(),
            ImportColumn::make('gross_weight_kg')
                ->numeric(),
            ImportColumn::make('payload_capacity_kg')
                ->numeric(),
            ImportColumn::make('seating_capacity')
                ->numeric(),
            ImportColumn::make('power_consumption_kwh_100km')
                ->numeric(),
            ImportColumn::make('regenerative_levels'),
            ImportColumn::make('max_regenerative_power')
                ->numeric(),
            ImportColumn::make('charging_ports'),
            ImportColumn::make('description'),
            ImportColumn::make('msrp')
                ->numeric(),
            ImportColumn::make('offer_price')
                ->numeric(),
            ImportColumn::make('is_available')
                ->boolean(),
            ImportColumn::make('exterior_color'),
            ImportColumn::make('interior_color'),
            ImportColumn::make('features')
                ->array(),
        ];
    }

    public function resolveRecord(): ?ElectricCar
    {
        // If update_existing is true, try to find an existing record
        if ($this->options['update_existing'] ?? false) {
            $query = ElectricCar::query();

            foreach ($this->options['identify_by'] as $column) {
                $query->where($column, $this->data[$column] ?? null);
            }

            return $query->first() ?? new ElectricCar();
        }

        // Otherwise create a new record
        return new ElectricCar();
    }

    // Required notification methods
    public static function getCompletedNotificationBody(Import $import): string
    {
        $count = $import->successful_rows;

        return "Successfully imported {$count} " . str('electric car')->plural($count) . '.';
    }

    public static function getCompletedNotificationTitle(Import $import): string
    {
        return 'Import completed';
    }

    public static function getFailedNotificationBody(Import $import): string
    {
        $count = $import->failed_rows;

        return "Failed to import {$count} " . str('row')->plural($count) . '. Please check the error log.';
    }

    public static function getFailedNotificationTitle(Import $import): string
    {
        return 'Import failed';
    }

    public function getRows(): \Illuminate\Support\Collection
    {
        return collect([]);
    }

}