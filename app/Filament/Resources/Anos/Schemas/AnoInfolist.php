<?php

namespace App\Filament\Resources\Anos\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;

class AnoInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Ano')
                    ->columnSpanFull()
                    ->tabs([

                        // 🔹 TAB PRINCIPAL: DADOS
                        Tab::make('📊 Dados')
                            ->columns(2)
                            ->schema([
                                TextEntry::make('nome')
                                    ->label('Ano')
                                    ->weight('bold'),

                                TextEntry::make('despesa')
                                    ->label('Despesas')
                                    ->money('BRL'),

                                TextEntry::make('renda')
                                    ->label('Rendas')
                                    ->money('BRL'),

                                TextEntry::make('total')
                                    ->label('Saldo')
                                    ->money('BRL')
                                    ->color(fn ($state) => $state >= 0 ? 'success' : 'danger'),
                            ]),

                        // 🔹 TAB PRINCIPAL: MESES
                        Tab::make('📅 Meses')
                            ->schema([
                                Tabs::make('MesesInterno')
                                    ->tabs(function ($record) {

                                        if (!$record || !$record->meses) {
                                            return [];
                                        }

                                        return $record->meses
                                            ->sortBy('numero') // ✔ ordena meses
                                            ->map(function ($mes) {

                                                return Tab::make($mes->nome)
                                                    ->icon('heroicon-o-calendar')
                                                    ->columns(2)
                                                    ->schema([

                                                        TextEntry::make('mes_nome')
                                                            ->label('Mês')
                                                            ->state($mes->nome),

                                                        TextEntry::make('total_despesa')
                                                            ->label('Despesas')
                                                            ->color('danger')
                                                            ->money('BRL')
                                                            ->state($mes->despesa),

                                                        TextEntry::make('total_renda')
                                                            ->label('Rendas')
                                                            ->money('BRL')
                                                            ->color('success')
                                                            ->state($mes->renda),

                                                        TextEntry::make('saldo')
                                                            ->label('Saldo')
                                                            ->money('BRL')
                                                            ->color(fn ($state) => $state >= 0 ? 'success' : 'danger')
                                                            ->state($mes->total),
                                                    ]);

                                            })->toArray();
                                    }),
                            ]),
                    ]),
            ]);
    }
}