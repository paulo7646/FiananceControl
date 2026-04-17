<?php

namespace App\Filament\Resources\Anos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AnosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nome')
                    ->label('Ano')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->icon('heroicon-o-calendar'),

                TextColumn::make('renda')
                    ->label('Renda')
                    ->money('BRL')
                    ->color('success')
                    ->sortable(),

                TextColumn::make('despesa')
                    ->label('Despesa')
                    ->money('BRL')
                    ->color('danger')
                    ->sortable(),

                TextColumn::make('total')
                    ->label('Saldo')
                    ->money('BRL')
                    ->sortable()
                    ->color(fn ($state) => $state >= 0 ? 'success' : 'danger')
                    ->badge(),

                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->defaultSort('nome', 'desc')

            ->striped() // linhas alternadas
            ->paginated([10, 25, 50])

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