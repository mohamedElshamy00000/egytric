<?php

namespace App\Filament\Resources\ChargingStationResource\Pages;

use App\Filament\Resources\ChargingStationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditChargingStation extends EditRecord
{
    protected static string $resource = ChargingStationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
