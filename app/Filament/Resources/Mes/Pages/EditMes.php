<?php

namespace App\Filament\Resources\Mes\Pages;

use App\Filament\Resources\Mes\MesResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditMes extends EditRecord
{
    protected static string $resource = MesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
