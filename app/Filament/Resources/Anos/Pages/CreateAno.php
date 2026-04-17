<?php

namespace App\Filament\Resources\Anos\Pages;

use App\Filament\Resources\Anos\AnoResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Mes;

class CreateAno extends CreateRecord
{
    protected static string $resource = AnoResource::class;

    protected function afterCreate(): void
    {
        $ano = $this->record;

        $meses = [
            'Janeiro', 'Fevereiro', 'Março', 'Abril',
            'Maio', 'Junho', 'Julho', 'Agosto',
            'Setembro', 'Outubro', 'Novembro', 'Dezembro'
        ];

        foreach ($meses as $index => $nome) {
            Mes::create([
                'nome' => $nome,
                'ano_id' => $ano->id,
                'total_renda' => 0,
                'total_despesa' => 0,
                'saldo' => 0,
            ]);
        }
    }
}