<?php

namespace App\Filament\Resources\Mes\Schemas;

use Filament\Infolists\Components\RepeatableEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MesInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Tabs::make('MesFinanceiro')
                    ->columnSpanFull()
                    ->tabs([

                        // =========================
                        // 📊 RESUMO (KPI DASHBOARD)
                        // =========================
                        Tab::make('📊 Resumo')
                            ->schema([
                                Section::make('Visão Geral do Período')
                                    ->columns(3)
                                    ->schema([

                                        TextEntry::make('nome')
                                            ->label('Mês')
                                            ->weight('bold')
                                            ->color('primary'),

                                        TextEntry::make('ano.nome')
                                            ->label('Ano')
                                            ->badge()
                                            ->color('gray'),

                                        TextEntry::make('total')
                                            ->label('Saldo Final')
                                            ->money('BRL')
                                            ->size('lg')
                                            ->weight('bold')
                                            ->color(fn ($state) => $state >= 0 ? 'success' : 'danger'),
                                    ]),

                                Section::make('Indicadores Financeiros')
                                    ->columns(2)
                                    ->schema([

                                        TextEntry::make('renda')
                                            ->label('Total de Entradas')
                                            ->money('BRL')
                                            ->color('success')
                                            ->weight('bold'),

                                        TextEntry::make('despesa')
                                            ->label('Total de Saídas')
                                            ->money('BRL')
                                            ->color('danger')
                                            ->weight('bold'),
                                    ]),
                            ]),
                    ]),
            ]);
    }
}