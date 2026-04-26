<?php

namespace App\Filament\Widgets;

use App\Models\Renda;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class RendasPorCategoriaChart extends ChartWidget
{
   use InteractsWithPageFilters;

    protected ?string $heading = 'Rendas por Categoria';

    protected ?string $description = 'Distribuição das rendas no período selecionado';

    public function isVisible(): bool
    {
        $ano = $this->pageFilters['ano_id'] ?? null;
        $mes = $this->pageFilters['mes_id'] ?? null;
        $usuario = $this->pageFilters['user_id'] ?? null;

        return Renda::query()
            ->when($usuario, fn ($q) => $q->where('user_id', $usuario))
            ->when($ano, fn ($q) => $q->where('ano_id', $ano))
            ->when($mes, fn ($q) => $q->where('mes_id', $mes))
            ->exists();
    }

    protected function getData(): array
    {
        $ano = $this->pageFilters['ano_id'] ?? null;
        $mes = $this->pageFilters['mes_id'] ?? null;
        $usuario = $this->pageFilters['user_id'] ?? null;

        $data = Renda::query()
            ->when($usuario, fn ($q) => $q->where('user_id', $usuario))
            ->when($ano, fn ($q) => $q->where('ano_id', $ano))
            ->when($mes, fn ($q) => $q->where('mes_id', $mes))
            ->selectRaw('categoria_id, SUM(valor) as total')
            ->groupBy('categoria_id')
            ->with('categoria')
            ->orderByDesc('total')
            ->get()
            ->values();

        // 🔥 proteção contra dataset vazio
        if ($data->isEmpty()) {
            return [
                'datasets' => [
                    [
                        'label' => 'Despesas',
                        'data' => [],
                        'backgroundColor' => [],
                    ],
                ],
                'labels' => [],
            ];
        }

        return [
            'datasets' => [
                [
                    'label' => 'Despesas',
                    'data' => $data->pluck('total')->toArray(),
                    'backgroundColor' => $this->generateColors($data->count()),
                    'borderColor' => '#ffffff',
                    'borderWidth' => 2,
                    'hoverOffset' => 10,
                ],
            ],
            'labels' => $data->map(fn ($item) =>
                $item->categoria->nome ?? 'Sem categoria'
            )->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }

    private function generateColors(int $count): array
    {
        if ($count <= 0) {
            return [];
        }

        $baseColors = [
            '#6366f1', // indigo
            '#22c55e', // green
            '#f97316', // orange
            '#ef4444', // red
            '#06b6d4', // cyan
            '#a855f7', // purple
            '#eab308', // yellow
            '#14b8a6', // teal
            '#f43f5e', // rose
            '#3b82f6', // blue
        ];

        return collect(range(0, $count - 1))
            ->map(fn ($i) => $baseColors[$i % count($baseColors)])
            ->toArray();
    }
}
