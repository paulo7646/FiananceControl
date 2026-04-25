<?php

namespace App\Observers;

use App\Models\Despesa;
use App\Models\Mes;
use Illuminate\Support\Facades\DB;

class DespesaObserver
{
    public function created(Despesa $despesa): void
    {
        $this->recalcularMes($despesa->mes_id);
    }

    public function updated(Despesa $despesa): void
    {
        // recalcula mês atual
        $this->recalcularMes($despesa->mes_id);

        if ($despesa->wasChanged('mes_id')) {
            $this->recalcularMes($despesa->getOriginal('mes_id'));
        }
    }

    public function deleted(Despesa $despesa): void
    {
        $this->recalcularMes($despesa->mes_id);
    }

    private function recalcularMes($mesId): void
    {
        if (!$mesId) {
            return;
        }

        $totalDespesa = Despesa::where('mes_id', $mesId)->sum('valor');

        // ✅ Otimização: update direto sem carregar o model
        Mes::where('id', $mesId)->update([
            'despesa' => $totalDespesa,
            'total' => DB::raw("renda - {$totalDespesa}"),
        ]);
    }
}
