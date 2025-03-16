<?php

namespace App\Filament\Resources\HelpmeResource\Pages;

use App\Filament\Resources\HelpmeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHelpme extends EditRecord
{
    protected static string $resource = HelpmeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
