<?php

namespace App\Filament\Resources\ChargingStationResource\Pages;

use App\Filament\Resources\ChargingStationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListChargingStations extends ListRecords
{
    protected static string $resource = ChargingStationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
