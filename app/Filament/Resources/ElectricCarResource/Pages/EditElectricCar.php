<?php

namespace App\Filament\Resources\ElectricCarResource\Pages;

use App\Filament\Resources\ElectricCarResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditElectricCar extends EditRecord
{
    protected static string $resource = ElectricCarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
