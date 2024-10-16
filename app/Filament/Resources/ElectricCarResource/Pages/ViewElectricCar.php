<?php

namespace App\Filament\Resources\ElectricCarResource\Pages;

use App\Filament\Resources\ElectricCarResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewElectricCar extends ViewRecord
{
    protected static string $resource = ElectricCarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()->color('dark')->icon('heroicon-m-pencil-square'),
        ];
    }
}
