<?php

namespace App\Filament\Resources\RendaFixas\Pages;

use App\Filament\Resources\RendaFixas\RendaFixaResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditRendaFixa extends EditRecord
{
    protected static string $resource = RendaFixaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
