<?php

namespace App\Filament\Resources\Rendas\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;


class RendaInfolist
{
    public static function configure(Schema $schema): Schema
    {
         return $schema
            ->components([
                Tabs::make('Despesa Fixa')
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('Geral')
                            ->columns(2)
                            ->schema([
                                TextEntry::make('nome')
                                    ->label('Nome'),

                                TextEntry::make('valor')
                                    ->label('Valor')
                                    ->money('BRL')
                                    ->color('success'),

                                TextEntry::make('user.name')
                                    ->label('Usuário')
                                    ->placeholder('-'),
                                
                                TextEntry::make('mes.nome')
                                    ->label('Mês')
                                    ->placeholder('-'),
                                
                                TextEntry::make('ano.nome')
                                    ->label('Ano')
                                    ->placeholder('-'),

                                TextEntry::make('categoria.nome')
                                    ->label('Categoria')
                                    ->placeholder('-'),
                            ]),

                        Tab::make('Informações')
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
