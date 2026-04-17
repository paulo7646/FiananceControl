<?php

namespace App\Observers;

use App\Models\Renda;
use App\Models\Mes;

class RendaObserver
{
    public function created(Renda $renda): void
    {
        $this->recalcularMes($renda->mes_id);
    }

    public function updated(Renda $renda): void
    {
        // recalcula mês atual
        $this->recalcularMes($renda->mes_id);

        // se mudou de mês, recalcula o antigo também
        if ($renda->wasChanged('mes_id')) {
            $this->recalcularMes($renda->getOriginal('mes_id'));
        }
    }

    public function deleted(Renda $renda): void
    {
        $this->recalcularMes($renda->mes_id);
    }

    public function restored(Renda $renda): void
    {
        $this->recalcularMes($renda->mes_id);
    }

    private function recalcularMes($mesId): void
    {
        $mes = Mes::find($mesId);

        if ($mes) {
            $mes->renda = Renda::where('mes_id', $mesId)->sum('valor');
            $mes->total = $mes->renda - $mes->despesa;
            $mes->save();
        }
    }
}