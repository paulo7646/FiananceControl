<?php

namespace App\Filament\Widgets;

use App\Models\Ano;
use App\Models\Mes;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class FinanceStatsOverview extends StatsOverviewWidget
{
    protected int | string | array $columnSpan = 'full';

    // 🔥 atualização automática
    protected ?string $pollingInterval = '2s';

    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        // 🔥 pega filtros da session
        $filters = session('finance_filters', []);

        $anoId = $filters['ano_id'] ?? null;
        $mesId = $filters['mes_id'] ?? null;
        $userId = $filters['user_id'] ?? auth()->id();

        $ano = Ano::find($anoId);
        $user = User::find($userId);

        if (!$ano || !$user) {
            return [];
        }

        // 🔹 meses do ano
        $mesQuery = Mes::where('ano_id', $ano->id);

        if (!empty($mesId)) {
            $mesQuery->where('id', $mesId);
        }

        $meses = $mesQuery->get();

        // 🔥 totais
        $totalRenda = 0;
        $totalDespesa = 0;

        foreach ($meses as $mes) {
            $totalRenda += $mes->rendas()
                ->where('user_id', $user->id)
                ->sum('valor');

            $totalDespesa += $mes->despesas()
                ->where('user_id', $user->id)
                ->sum('valor');
        }

        $saldo = $totalRenda - $totalDespesa;

        // 🔹 fixos
        $rendaFixa = $user->rendaFixas()->sum('valor');
        $despesaFixa = $user->despesaFixas()->sum('valor');

        $saldoProjetado = $saldo + $rendaFixa - $despesaFixa;

        return [

            Stat::make('Receita', 'R$ ' . number_format($totalRenda, 2, ',', '.'))
                ->description('Entradas no período')
                ->color('success')
                ->icon('heroicon-o-arrow-trending-up'),

            Stat::make('Despesas', 'R$ ' . number_format($totalDespesa, 2, ',', '.'))
                ->description('Saídas no período')
                ->color('danger')
                ->icon('heroicon-o-arrow-trending-down'),

            Stat::make('Saldo', 'R$ ' . number_format($saldo, 2, ',', '.'))
                ->description('Resultado líquido')
                ->color($saldo >= 0 ? 'success' : 'danger')
                ->icon('heroicon-o-scale'),

            Stat::make('Renda Fixa', 'R$ ' . number_format($rendaFixa, 2, ',', '.'))
                ->description('Receitas recorrentes')
                ->color('success'),

            Stat::make('Despesa Fixa', 'R$ ' . number_format($despesaFixa, 2, ',', '.'))
                ->description('Custos fixos')
                ->color('warning'),
        ];
    }

    protected function getColumns(): int
    {
        return 3;
    }
}