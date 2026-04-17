<?php

namespace App\Filament\Resources\DespesaFixas\Pages;

use App\Filament\Resources\DespesaFixas\DespesaFixaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDespesaFixas extends ListRecords
{
    protected static string $resource = DespesaFixaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
