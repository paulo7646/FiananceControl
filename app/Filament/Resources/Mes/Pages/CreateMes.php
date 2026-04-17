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

    protected function afterCreate(): void
    {
        $mes = $this->record;

        // 🔴 Despesas Fixas → virar Despesas do mês
        $despesasFixas = DespesaFixa::all();

        foreach ($despesasFixas as $fixa) {
            Despesa::create([
                'nome' => $fixa->nome,
                'valor' => $fixa->valor,
                'mes_id' => $mes->id,
                'user_id' => $fixa->user_id,
                'categoria_id' => $fixa->categoria_id,
            ]);
        }

        // 🟢 Rendas Fixas → virar Rendas do mês
        $rendasFixas = RendaFixa::all();

        foreach ($rendasFixas as $fixa) {
            Renda::create([
                'nome' => $fixa->nome,
                'valor' => $fixa->valor,
                'mes_id' => $mes->id,
                'user_id' => $fixa->user_id,
                'categoria_id' => $fixa->categoria_id,
            ]);
        }
    }
}