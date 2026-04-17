<?php

namespace App\Filament\Resources\Anos\Pages;

use App\Filament\Resources\Anos\AnoResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditAno extends EditRecord
{
    protected static string $resource = AnoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
