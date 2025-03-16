<?php

namespace App\Filament\Resources\HelpmeResource\Pages;

use App\Filament\Resources\HelpmeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHelpmes extends ListRecords
{
    protected static string $resource = HelpmeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
