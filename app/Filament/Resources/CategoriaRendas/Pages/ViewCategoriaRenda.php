<?php

namespace App\Filament\Resources\CategoriaRendas\Pages;

use App\Filament\Resources\CategoriaRendas\CategoriaRendaResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCategoriaRenda extends ViewRecord
{
    protected static string $resource = CategoriaRendaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
