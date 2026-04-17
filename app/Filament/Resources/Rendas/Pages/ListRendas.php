<?php

namespace App\Filament\Resources\Rendas\Pages;

use App\Filament\Resources\Rendas\RendaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRendas extends ListRecords
{
    protected static string $resource = RendaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
