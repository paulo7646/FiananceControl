<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Usuário')
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('Geral')
                            ->columns(2)
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Nome'),
                                
                                TextEntry::make('email')
                                    ->label('Email'),
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
