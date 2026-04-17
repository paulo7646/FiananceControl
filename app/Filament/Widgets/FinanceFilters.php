<?php

namespace App\Filament\Widgets;

use App\Models\Ano;
use App\Models\Mes;
use App\Models\User;
use Filament\Widgets\Widget;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Select;

class FinanceFilters extends Widget implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.widgets.finance-filters';

    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'full';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'ano_id' => Ano::orderBy('nome', 'desc')->value('id'),
            'user_id' => auth()->id(),
        ]);
    }

    public function updatedData(): void
    {
        session([
            'finance_filters' => $this->data,
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Grid::make(3)->schema([

                    Select::make('ano_id')
                        ->label('Ano')
                        ->options(Ano::orderBy('nome', 'desc')->pluck('nome', 'id'))
                        ->searchable()
                        ->live()
                        ->afterStateUpdated(fn ($state, callable $set) => $set('mes_id', null)),

                    Select::make('mes_id')
                        ->label('Mês')
                        ->options(fn (callable $get) =>
                            $get('ano_id')
                                ? Mes::where('ano_id', $get('ano_id'))->pluck('nome', 'id')
                                : []
                        )
                        ->placeholder('Todos os meses')
                        ->searchable()
                        ->live(),

                    Select::make('user_id')
                        ->label('Usuário')
                        ->options(User::orderBy('name')->pluck('name', 'id'))
                        ->searchable()
                        ->live(),

                ]),
            ])
            ->statePath('data');
    }
}