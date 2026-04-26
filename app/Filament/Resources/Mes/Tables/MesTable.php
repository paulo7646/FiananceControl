<?php

namespace App\Filament\Resources\Mes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Grouping\Group;
use Filament\Actions\DeleteAction;

class MesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn ($query) => $query->with(['ano']))
            ->columns([
                TextColumn::make('nome')
                    ->label('Mês')
                    ->searchable(),

                TextColumn::make('despesa')
                    ->label('Despesas')
                    ->color('danger')
                    ->money('BRL')
                    ->sortable(),

                TextColumn::make('renda')
                    ->label('Rendas')
                    ->color('success')
                    ->money('BRL')
                    ->sortable(),

                TextColumn::make('total')
                    ->label('Saldo')
                    ->money('BRL')
                    ->color(fn ($state) => $state < 0 ? 'danger' : 'success')
                    ->sortable(),

                TextColumn::make('ano.nome') // melhor que ano.id
                    ->label('Ano')
                    ->sortable()
                    ->searchable(),

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
            ->groups([
            Group::make('ano.nome')
                ->collapsible(),
        ])
        ->collapsedGroupsByDefault()
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