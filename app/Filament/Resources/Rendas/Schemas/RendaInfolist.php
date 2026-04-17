<?php

namespace App\Filament\Resources\Rendas\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class RendaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nome'),
                TextEntry::make('valor')
                    ->numeric(),
                TextEntry::make('user.name')
                    ->label('User'),
                TextEntry::make('categoria.id')
                    ->label('Categoria'),
                TextEntry::make('mes.id')
                    ->label('Mes'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
