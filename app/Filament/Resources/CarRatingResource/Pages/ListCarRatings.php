<?php

namespace App\Filament\Resources\CarRatingResource\Pages;

use App\Filament\Resources\CarRatingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCarRatings extends ListRecords
{
    protected static string $resource = CarRatingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
