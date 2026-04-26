<?php

namespace App\Filament\Resources\Rendas\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RendaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nome')
                    ->required(),
                TextInput::make('valor')
                    ->numeric(),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('categoria_id')
                    ->relationship('categoria', 'nome')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('mes_id')
                    ->relationship('mes', 'nome')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('ano_id')
                    ->relationship('ano', 'nome')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }
}
