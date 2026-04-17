<?php

namespace App\Filament\Resources\Anos\Pages;

use App\Filament\Resources\Anos\AnoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAnos extends ListRecords
{
    protected static string $resource = AnoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
