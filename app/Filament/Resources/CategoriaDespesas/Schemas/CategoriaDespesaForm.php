<?php

namespace App\Filament\Resources\CategoriaDespesas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CategoriaDespesaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nome')
                    ->required(),
            ]);
    }
}
