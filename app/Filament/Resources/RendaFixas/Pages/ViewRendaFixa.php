<?php

namespace App\Filament\Resources\RendaFixas\Pages;

use App\Filament\Resources\RendaFixas\RendaFixaResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewRendaFixa extends ViewRecord
{
    protected static string $resource = RendaFixaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
