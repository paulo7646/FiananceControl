<?php

namespace App\Observers;

use App\Models\Mes;
use App\Models\DespesaFixa;
use App\Models\RendaFixa;
use App\Models\Despesa;
use App\Models\Renda;
use App\Models\Ano;

class MesObserver
{
    public function created(Mes $mes): void
    {
        // evita duplicação
        if ($mes->despesas()->exists() || $mes->rendas()->exists()) {
            return;
        }

        // 🔴 DESPESAS FIXAS → DESPESAS DO MÊS
        $despesasFixas = DespesaFixa::all();

        if ($despesasFixas->isNotEmpty()) {
            $despesas = $despesasFixas->map(fn ($fixa) => [
                'nome' => $fixa->nome,
                'valor' => $fixa->valor,
                'mes_id' => $mes->id,
                'ano_id' => $mes->ano_id,
                'user_id' => $fixa->user_id,
                'categoria_id' => $fixa->categoria_id,
                'created_at' => now(),
                'updated_at' => now(),
            ])->toArray();

            Despesa::insert($despesas);
        }

        // 🟢 RENDAS FIXAS → RENDAS DO MÊS
        $rendasFixas = RendaFixa::all();

        if ($rendasFixas->isNotEmpty()) {
            $rendas = $rendasFixas->map(fn ($fixa) => [
                'nome' => $fixa->nome,
                'valor' => $fixa->valor,
                'mes_id' => $mes->id,
                'ano_id' => $mes->ano_id,
                'user_id' => $fixa->user_id,
                'categoria_id' => $fixa->categoria_id,
                'created_at' => now(),
                'updated_at' => now(),
            ])->toArray();

            Renda::insert($rendas);
        }

        // 🔄 recalcula mês
        $this->recalcularMes($mes);

        // 🔄 recalcula ano
        $this->recalcularAno($mes->ano_id);
    }

    public function updated(Mes $mes): void
    {
        $this->recalcularAno($mes->ano_id);
    }

    public function deleted(Mes $mes): void
    {
        $this->recalcularAno($mes->ano_id);
    }

    // 🔹 recalcula valores do mês
    private function recalcularMes(Mes $mes): void
    {
        $totalDespesa = Despesa::where('mes_id', $mes->id)->sum('valor');
        $totalRenda = Renda::where('mes_id', $mes->id)->sum('valor');

        $mes->despesa = $totalDespesa;
        $mes->renda = $totalRenda;
        $mes->total = $totalRenda - $totalDespesa;

        $mes->save();
    }

    // 🔹 recalcula valores do ano
    private function recalcularAno($anoId): void
    {
        $totalDespesa = Mes::where('ano_id', $anoId)->sum('despesa');
        $totalRenda = Mes::where('ano_id', $anoId)->sum('renda');

        $ano = Ano::find($anoId);

        if ($ano) {
            $ano->despesa = $totalDespesa;
            $ano->renda = $totalRenda;
            $ano->total = $totalRenda - $totalDespesa;
            $ano->save();
        }
    }
}