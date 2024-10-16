<?php

namespace App\Filament\Resources\CarOrderResource\Pages;

use App\Filament\Resources\CarOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCarOrders extends ListRecords
{
    protected static string $resource = CarOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
