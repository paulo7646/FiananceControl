<?php

namespace App\Filament\Widgets;

use App\Models\Renda;
use App\Models\Mes;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class RendaPorMesChart extends ChartWidget
{
   use InteractsWithPageFilters;

    protected ?string $heading = 'Renda por Mês';

    protected function getData(): array
    {
        $ano = $this->pageFilters['ano_id'] ?? null;
        $usuario = $this->pageFilters['user_id'] ?? null;

        // 🔥 busca nomes dos meses no banco
        $meses = Mes::orderBy('id')->pluck('nome', 'id');

        $despesas = Renda::query()
            ->when($usuario, fn ($q) => $q->where('user_id', $usuario))
            ->when($ano, fn ($q) => $q->where('ano_id', $ano))
            ->selectRaw('mes_id, SUM(valor) as total')
            ->groupBy('mes_id')
            ->pluck('total', 'mes_id');

        // garante ordem 1–12 baseada no banco
        $labels = [];
        $values = [];

        foreach ($meses as $id => $nome) {
            $labels[] = $nome;
            $values[] = $despesas[$id] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Rendas',
                    'data' => $values,
                    'categoryPercentage' => 0.95,
                    'barPercentage' => 1,
                    'barThickness' => 28,
                    'backgroundColor' => '#065fe6',
                    'borderRadius' => 6,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
