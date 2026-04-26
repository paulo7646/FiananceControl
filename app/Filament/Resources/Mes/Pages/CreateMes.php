<?php

namespace App\Filament\Resources\Mes\Pages;

use App\Filament\Resources\Mes\MesResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\DespesaFixa;
use App\Models\RendaFixa;
use App\Models\Despesa;
use App\Models\Renda;

class CreateMes extends CreateRecord
{
    protected static string $resource = MesResource::class;
}