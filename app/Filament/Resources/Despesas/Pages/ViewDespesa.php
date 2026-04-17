<?php

namespace App\Filament\Resources\Despesas\Pages;

use App\Filament\Resources\Despesas\DespesaResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewDespesa extends ViewRecord
{
    protected static string $resource = DespesaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
