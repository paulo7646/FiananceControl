<?php

namespace App\Filament\Resources\RendaFixas\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class RendaFixaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Renda Fixa')
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('Geral')
                            ->icon('heroicon-o-currency-dollar')
                            ->columns(2)
                            ->schema([
                                TextEntry::make('nome')
                                    ->label('Nome'),

                                TextEntry::make('valor')
                                    ->label('Valor')
                                    ->money('BRL')
                                    ->color('success')
                                    ->weight('bold'),

                                TextEntry::make('user.name')
                                    ->label('Usuário')
                                    ->placeholder('-'),

                                TextEntry::make('categoria.nome')
                                    ->label('Categoria')
                                    ->placeholder('-'),
                            ]),

                        Tab::make('Informações')
                            ->icon('heroicon-o-information-circle')
                            ->columns(2)
                            ->schema([
                                TextEntry::make('created_at')
                                    ->label('Criado em')
                                    ->dateTime('d/m/Y H:i')
                                    ->placeholder('-'),

                                TextEntry::make('updated_at')
                                    ->label('Atualizado em')
                                    ->dateTime('d/m/Y H:i')
                                    ->placeholder('-'),
                            ]),
                    ]),
            ]);
    }
}