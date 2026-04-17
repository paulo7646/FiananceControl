<?php

namespace App\Filament\Resources\Rendas\Pages;

use App\Filament\Resources\Rendas\RendaResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewRenda extends ViewRecord
{
    protected static string $resource = RendaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
