<?php

namespace App\Filament\Resources\Despesas\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class DespesaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            TextInput::make('nome')
                ->label('Nome')
                ->required()
                ->maxLength(255),

            TextInput::make('valor')
                ->label('Valor')
                ->required()
                ->numeric()
                ->prefix('R$'),

            Select::make('user_id')
                ->relationship('user', 'name')
                ->label('Usuário')
                ->searchable()
                ->preload()
                ->required(),

            Select::make('categoria_id')
                ->relationship('categoria', 'nome')
                ->label('Categoria')
                ->searchable()
                ->preload()
                ->required(),

            Select::make('mes_id')
                ->relationship('mes', 'nome')
                ->label('Mês')
                ->searchable()
                ->preload()
                ->required(),
            
            Select::make('ano_id')
                ->relationship('ano', 'nome')
                ->label('Ano')
                ->searchable()
                ->preload()
                ->required(),
            
            Toggle::make('pago')
                ->label('Pago'),
        ]);
    }
}