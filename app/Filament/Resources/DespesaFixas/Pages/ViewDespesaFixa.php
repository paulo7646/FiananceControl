<?php

namespace App\Filament\Resources\DespesaFixas\Pages;

use App\Filament\Resources\DespesaFixas\DespesaFixaResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewDespesaFixa extends ViewRecord
{
    protected static string $resource = DespesaFixaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
