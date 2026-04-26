<?php

namespace App\Filament\Widgets;

use App\Models\Despesa;
use App\Models\Renda;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class FinanceWidget extends StatsOverviewWidget
{
    use InteractsWithPageFilters;

    private function brl($value): string
    {
        return 'R$ ' . number_format($value, 2, ',', '.');
    }

    public function getStats(): array
    {
        $ano = $this->pageFilters['ano_id'] ?? null;
        $mes = $this->pageFilters['mes_id'] ?? null;
        $usuario = $this->pageFilters['user_id'] ?? null;

        $renda = Renda::query()
            ->when($usuario, fn ($q) => $q->where('user_id', $usuario))
            ->when($ano, fn ($q) => $q->where('ano_id', $ano))
            ->when($mes, fn ($q) => $q->where('mes_id', $mes))
            ->sum('valor');

        $despesa = Despesa::query()
            ->when($usuario, fn ($q) => $q->where('user_id', $usuario))
            ->when($ano, fn ($q) => $q->where('ano_id', $ano))
            ->when($mes, fn ($q) => $q->where('mes_id', $mes))
            ->sum('valor');

        $saldo = $renda - $despesa;

        return [
            StatsOverviewWidget\Stat::make(
                'Total de Renda',
                $this->brl($renda)
            )
                ->description('Renda do período')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),

            StatsOverviewWidget\Stat::make(
                'Total de Despesas',
                $this->brl($despesa)
            )
                ->description('Despesa do período')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('danger'),

            StatsOverviewWidget\Stat::make(
                'Total de Saldo',
                $this->brl($saldo)
            )
                ->description('Saldo do período')
                ->descriptionIcon(
                    $saldo >= 0
                        ? 'heroicon-m-arrow-trending-up'
                        : 'heroicon-m-arrow-trending-down'
                )
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color($saldo >= 0 ? 'success' : 'danger'),
        ];
    }
}