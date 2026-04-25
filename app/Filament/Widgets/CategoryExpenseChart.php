<?php

namespace App\Filament\Widgets;

use App\Models\Despesa;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\ChartWidget;

class CategoryExpenseChart extends ChartWidget
{
    protected ?string $heading = 'Despesas por Categoria';

    protected int | string | array $columnSpan = 1;

    protected static ?int $sort = 3;

    // ✅ Cache em vez de polling constante
    protected ?string $pollingInterval = null;

    protected function getData(): array
    {
        // 🔥 filtros globais (mesmo padrão do sistema)
        $filters = session('finance_filters', []);

        $anoId = $filters['ano_id'] ?? null;
        $mesId = $filters['mes_id'] ?? null;
        $userId = $filters['user_id'] ?? auth()->id();

        $cacheKey = "chart_expense:{$anoId}:{$mesId}:{$userId}";

        return Cache::remember($cacheKey, 60, function () use ($anoId, $mesId, $userId) {
            $query = Despesa::query()
                ->select([
                    'categoria_despesas.nome as category',
                    DB::raw('SUM(despesas.valor) as total')
                ])
                ->join('categoria_despesas', 'despesas.categoria_id', '=', 'categoria_despesas.id');

            // 🔥 filtros dinâmicos
            $query->when($anoId, fn ($q) => $q->where('despesas.ano_id', $anoId));
            $query->when($mesId, fn ($q) => $q->where('despesas.mes_id', $mesId));
            $query->when($userId, fn ($q) => $q->where('despesas.user_id', $userId));

            $data = $query
                ->groupBy('categoria_despesas.id', 'categoria_despesas.nome')
                ->orderByDesc('total')
                ->get();

            return [
                'datasets' => [
                    [
                        'label' => 'Despesas',
                        'data' => $data->pluck('total')->toArray(),
                        'backgroundColor' => [
                            '#ef4444',
                            '#f87171',
                            '#fca5a5',
                            '#fecaca',
                            '#fee2e2',
                            '#dc2626',
                            '#b91c1c',
                        ],
                    ],
                ],
                'labels' => $data->pluck('category')->toArray(),
            ];
        });
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'position' => 'bottom',
                ],
            ],
        ];
    }
}