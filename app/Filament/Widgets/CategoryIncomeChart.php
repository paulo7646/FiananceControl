<?php

namespace App\Filament\Widgets;

use App\Models\Renda;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\ChartWidget;

class CategoryIncomeChart extends ChartWidget
{
    protected ?string $heading = 'Rendas por Categoria';

    protected int | string | array $columnSpan = 1;

    protected static ?int $sort = 4;

    // ✅ Cache em vez de polling constante
    protected ?string $pollingInterval = null;

    protected function getData(): array
    {
        // 🔥 filtros globais
        $filters = session('finance_filters', []);

        $anoId = $filters['ano_id'] ?? null;
        $mesId = $filters['mes_id'] ?? null;
        $userId = $filters['user_id'] ?? auth()->id();

        $cacheKey = "chart_income:{$anoId}:{$mesId}:{$userId}";

        return Cache::remember($cacheKey, 60, function () use ($anoId, $mesId, $userId) {
            $query = Renda::query()
                ->select([
                    'categoria_rendas.nome as category',
                    DB::raw('SUM(rendas.valor) as total')
                ])
                ->join('categoria_rendas', 'rendas.categoria_id', '=', 'categoria_rendas.id');

            // 🔥 filtros dinâmicos
            $query->when($anoId, fn ($q) => $q->where('rendas.ano_id', $anoId));
            $query->when($mesId, fn ($q) => $q->where('rendas.mes_id', $mesId));
            $query->when($userId, fn ($q) => $q->where('rendas.user_id', $userId));

            $data = $query
                ->groupBy('categoria_rendas.id', 'categoria_rendas.nome')
                ->orderByDesc('total')
                ->get();

            return [
                'datasets' => [
                    [
                        'label' => 'Rendas',
                        'data' => $data->pluck('total')->toArray(),
                        'backgroundColor' => [
                            '#22c55e',
                            '#4ade80',
                            '#86efac',
                            '#bbf7d0',
                            '#dcfce7',
                            '#16a34a',
                            '#15803d',
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