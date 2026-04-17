<?php

namespace App\Filament\Resources\Despesas\Pages;

use App\Filament\Resources\Despesas\DespesaResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Mes; // ajuste para seu model

class CreateDespesa extends CreateRecord
{
    protected static string $resource = DespesaResource::class;
}