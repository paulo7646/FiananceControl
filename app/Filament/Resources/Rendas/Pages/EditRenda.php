<?php

namespace App\Filament\Resources\Rendas\Pages;

use App\Filament\Resources\Rendas\RendaResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditRenda extends EditRecord
{
    protected static string $resource = RendaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
