<?php

namespace App\Filament\Resources\Anos\Pages;

use App\Filament\Resources\Anos\AnoResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAno extends ViewRecord
{
    protected static string $resource = AnoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
