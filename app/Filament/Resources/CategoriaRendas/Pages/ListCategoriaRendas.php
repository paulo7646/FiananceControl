<?php

namespace App\Filament\Resources\CategoriaRendas\Pages;

use App\Filament\Resources\CategoriaRendas\CategoriaRendaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCategoriaRendas extends ListRecords
{
    protected static string $resource = CategoriaRendaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
