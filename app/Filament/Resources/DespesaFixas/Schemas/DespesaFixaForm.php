<?php

namespace App\Filament\Resources\DespesaFixas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class DespesaFixaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([

                TextInput::make('nome')
                    ->label('Nome')
                    ->required()
                    ->maxLength(255),

                TextInput::make('valor')
                    ->label('Valor')
                    ->numeric()
                    ->prefix('R$')
                    ->required(),

                Select::make('user_id')
                    ->label('Usuário')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('categoria_id')
                    ->label('Categoria')
                    ->relationship('categoria', 'nome')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }
}