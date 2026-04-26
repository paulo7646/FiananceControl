<?php

namespace App\Filament\Resources\Despesas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DespesasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('nome')
                    ->label('Descrição')
                    ->searchable()
                    ->weight('bold'),

                TextColumn::make('valor')
                    ->label('Valor')
                    ->money('BRL')
                    ->sortable()
                    ->color('danger'),

                TextColumn::make('pago')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state ? 'Pago' : 'Pendente')
                    ->color(fn ($state) => $state ? 'success' : 'danger'),

                TextColumn::make('user.name')
                    ->label('Usuário')
                    ->searchable(),

                TextColumn::make('categoria.nome')
                    ->label('Categoria')
                    ->badge()
                    ->searchable(),

                TextColumn::make('mes.nome')
                    ->label('Mês')
                    ->searchable(),
                
                TextColumn::make('ano.nome')
                    ->label('Ano')
                    ->searchable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->filters([
                //
            ])

            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}