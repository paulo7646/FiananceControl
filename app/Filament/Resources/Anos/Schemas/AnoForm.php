<?php

namespace App\Filament\Resources\Anos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;

class AnoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('Ano')
                ->columnSpanFull()
                ->tabs([
                    Tab::make('📊 Dados')
                        ->columns(2)
                        ->schema([
                            TextInput::make('nome')
                                ->label('Ano')
                                ->required()
                                ->numeric()
                                ->maxLength(4)
                                ->autofocus()
                                ->columnSpanFull(),

                            TextInput::make('total_despesa')
                                ->label('Despesas')
                                ->numeric()
                                ->default(0)
                                ->readOnly()
                                ->prefix('R$'),

                            TextInput::make('total_renda')
                                ->label('Rendas')
                                ->numeric()
                                ->default(0)
                                ->readOnly()
                                ->prefix('R$'),

                            TextInput::make('saldo')
                                ->label('Saldo')
                                ->numeric()
                                ->default(0)
                                ->readOnly()
                                ->prefix('R$'),
                        ]),

                ]),
        ]);
    }
}