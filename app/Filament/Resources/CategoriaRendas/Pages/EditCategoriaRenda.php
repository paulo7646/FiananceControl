<?php

namespace App\Filament\Resources\CategoriaRendas\Pages;

use App\Filament\Resources\CategoriaRendas\CategoriaRendaResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCategoriaRenda extends EditRecord
{
    protected static string $resource = CategoriaRendaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
