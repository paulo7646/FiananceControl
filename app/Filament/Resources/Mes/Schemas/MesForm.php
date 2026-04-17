<?php

namespace App\Filament\Resources\Mes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;

class MesForm
{
    protected $listeners = [
        'mes-updated' => '$refresh',
    ];

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Mes')
                    ->columnSpanFull()
                    ->tabs([

                        // =========================
                        // 📊 DADOS
                        // =========================
                        Tab::make('📊 Dados')
                            ->schema([

                                TextInput::make('nome')
                                    ->label('Nome do Mês')
                                    ->required()
                                    ->maxLength(50),

                                Select::make('ano_id')
                                    ->relationship('ano', 'nome')
                                    ->label('Ano')
                                    ->searchable()
                                    ->preload()
                                    ->required(),

                                TextInput::make('despesa')
                                    ->disabled()
                                    ->visible(false)
                                    ->dehydrated(false),

                                TextInput::make('renda')
                                    ->disabled()
                                    ->visible(false)
                                    ->dehydrated(false),

                                TextInput::make('total')
                                    ->disabled()
                                    ->visible(false)
                                    ->dehydrated(false),
                            ])
                            ->columns(2),

                    ]),
            ]);
    }
}