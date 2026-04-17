<?php

namespace App\Filament\Resources\Mes\Pages;

use App\Filament\Resources\Mes\MesResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMes extends ViewRecord
{
    protected static string $resource = MesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
