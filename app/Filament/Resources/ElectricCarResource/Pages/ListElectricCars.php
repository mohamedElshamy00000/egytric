<?php

namespace App\Filament\Resources\ElectricCarResource\Pages;

use App\Filament\Resources\ElectricCarResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListElectricCars extends ListRecords
{
    protected static string $resource = ElectricCarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->color('dark')->icon('heroicon-m-plus'),
        ];
    }
}
