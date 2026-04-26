<?php

use Filament\Forms\Components\Select;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use App\Models\User;
use App\Models\Ano;
use App\Models\Mes;

class Dashboard extends BaseDashboard
{
    use HasFiltersForm;

    public function filtersForm(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columnSpanFull()
                    ->schema([
                        Select::make('user_id')
                            ->label('User')
                            ->options(User::pluck('name', 'id'))
                            ->searchable(),

                        Select::make('ano_id')
                            ->label('Ano')
                            ->options(Ano::pluck('nome', 'id'))
                            ->searchable()
                            ->live(),

                        Select::make('mes_id')
                            ->label('Mês')
                            ->searchable()
                            ->options(function (callable $get) {
                                $anoId = $get('ano_id');

                                if (! $anoId) {
                                    return [];
                                }

                                return Mes::where('ano_id', $anoId)
                                    ->orderBy('id')
                                    ->pluck('nome', 'id');
                            })
                            ->disabled(fn (callable $get) => ! $get('ano_id')),
                    ])
                    ->columns(3),
            ]);
    }
}