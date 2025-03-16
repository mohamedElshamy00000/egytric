<?php

namespace App\Filament\Resources\CarRatingResource\Pages;

use App\Filament\Resources\CarRatingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCarRating extends EditRecord
{
    protected static string $resource = CarRatingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
