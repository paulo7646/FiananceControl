<?php

namespace App\Observers;

use App\Models\Despesa;
use App\Models\Mes;

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
        $mes = Mes::find($mesId);

        if ($mes) {
            $mes->despesa = Despesa::where('mes_id', $mesId)->sum('valor');
            $mes->total = $mes->renda- $mes->despesa;
            $mes->save();
        }
    }
}