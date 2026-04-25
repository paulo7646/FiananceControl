<?php

namespace App\Filament\Widgets;

use App\Models\Ano;
use App\Models\Mes;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Cache;

class FinanceStatsOverview extends StatsOverviewWidget
{
    protected int | string | array $columnSpan = 'full';

    // ✅ Desativado polling para reduzir queries no banco
    protected ?string $pollingInterval = null;

    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        // 🔥 pega filtros da session
        $filters = session('finance_filters', []);

        $anoId = $filters['ano_id'] ?? null;
        $mesId = $filters['mes_id'] ?? null;
        $userId = $filters['user_id'] ?? auth()->id();

        if (!$anoId || !$userId) {
            return [];
        }

        $cacheKey = "finance_stats:{$anoId}:{$mesId}:{$userId}";

        return Cache::remember($cacheKey, 30, function () use ($anoId, $mesId, $userId) {
            $ano = Ano::find($anoId);
            $user = User::find($userId);

            if (!$ano || !$user) {
                return [];
            }

            // 🔹 Otimização: agregação direta em vez de loop por mês
            $mesIds = Mes::where('ano_id', $ano->id)
                ->when($mesId, fn ($q) => $q->where('id', $mesId))
                ->pluck('id');

            $totalRenda = \App\Models\Renda::whereIn('mes_id', $mesIds)
                ->where('user_id', $user->id)
                ->sum('valor');

            $totalDespesa = \App\Models\Despesa::whereIn('mes_id', $mesIds)
                ->where('user_id', $user->id)
                ->sum('valor');

            $saldo = $totalRenda - $totalDespesa;

            // 🔹 fixos
            $rendaFixa = $user->rendaFixas()->sum('valor');
            $despesaFixa = $user->despesaFixas()->sum('valor');

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
        });
    }

    protected function getColumns(): int
    {
        return 3;
    }
}