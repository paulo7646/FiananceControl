<?php

namespace App\Filament\Resources\Mes\Pages;

use App\Filament\Resources\Mes\MesResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMes extends ListRecords
{
    protected static string $resource = MesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
