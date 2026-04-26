<?php

namespace App\Filament\Resources\CategoriaDespesas\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class CategoriaDespesaInfolist
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
