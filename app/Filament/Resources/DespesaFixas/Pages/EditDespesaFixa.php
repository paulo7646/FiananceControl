<?php

namespace App\Filament\Resources\DespesaFixas\Pages;

use App\Filament\Resources\DespesaFixas\DespesaFixaResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditDespesaFixa extends EditRecord
{
    protected static string $resource = DespesaFixaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
