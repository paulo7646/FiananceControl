<?php

namespace App\Filament\Resources\CategoriaDespesas\Pages;

use App\Filament\Resources\CategoriaDespesas\CategoriaDespesaResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCategoriaDespesa extends ViewRecord
{
    protected static string $resource = CategoriaDespesaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
