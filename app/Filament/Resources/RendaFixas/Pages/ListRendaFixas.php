<?php

namespace App\Filament\Resources\RendaFixas\Pages;

use App\Filament\Resources\RendaFixas\RendaFixaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRendaFixas extends ListRecords
{
    protected static string $resource = RendaFixaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
