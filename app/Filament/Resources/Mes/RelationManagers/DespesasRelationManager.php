<?php

namespace App\Filament\Resources\MesResource\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Table;
use Filament\Tables\Grouping\Group;

class DespesasRelationManager extends RelationManager
{
    protected static string $relationship = 'despesas';

    protected static ?string $title = '💸 Despesas';

    protected function afterSave(): void
    {
        $this->ownerRecord->recalcularTotais();
    }

    protected function afterDelete(): void
    {
        $this->ownerRecord->recalcularTotais();
    }

    /**
     * FORM
     */
    public function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('nome')
                ->label('Descrição')
                ->required()
                ->maxLength(255)
                ->columnSpanFull(),

            TextInput::make('valor')
                ->label('Valor')
                ->required()
                ->numeric()
                ->prefix('R$'),

            Toggle::make('pago')
                ->label('Pago'),

            Select::make('categoria_id')
                ->relationship('categoria', 'nome')
                ->label('Categoria')
                ->searchable()
                ->preload()
                ->required(),

            Select::make('user_id')
                ->relationship('user', 'name')
                ->label('Usuário')
                ->searchable()
                ->preload()
                ->required(),

            Select::make('ano_id')
                ->relationship('ano', 'nome')
                ->label('Ano')
                ->searchable()
                ->preload()
                ->required(),
        ])->columns(2);
    }

    /**
     * INFOLIST
     */
    public function infolist(Schema $schema): Schema
    {
        return $schema->components([
            TextEntry::make('nome')->label('Descrição'),
            TextEntry::make('valor')->money('BRL'),
            TextEntry::make('pago')
                ->label('Pago')
                ->formatStateUsing(fn ($state) => $state ? 'Sim' : 'Não'),

            TextEntry::make('user.name')->label('Usuário'),
            TextEntry::make('categoria.nome')->label('Categoria'),
            TextEntry::make('ano.nome')->label('Ano'),

            TextEntry::make('created_at')->dateTime()->label('Criado em')->placeholder('-'),
            TextEntry::make('updated_at')->dateTime()->label('Atualizado em')->placeholder('-'),
        ]);
    }

    /**
     * TABLE
     */
    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nome')

            /**
             * 📦 GROUPS (corrigido)
             */
            ->groups([
                Group::make('user.name')->collapsible(),
                Group::make('categoria.nome')->collapsible(),
            ])
            ->defaultGroup('user.name')
            ->collapsedGroupsByDefault()

            ->columns([
                TextColumn::make('nome')
                    ->label('Descrição')
                    ->searchable()
                    ->weight('bold'),

                TextColumn::make('valor')
                    ->label('Valor')
                    ->money('BRL')
                    ->sortable()
                    ->color('danger')
                    ->weight('bold')
                    ->summarize(
                        Sum::make()
                            ->label('Total')
                            ->money('BRL')
                    ),

                TextColumn::make('pago')
                    ->label('Pago')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state ? 'Pago' : 'Pendente')
                    ->color(fn ($state) => $state ? 'success' : 'danger'),

                TextColumn::make('categoria.nome')
                    ->label('Categoria')
                    ->badge()
                    ->color('gray')
                    ->searchable(),

                TextColumn::make('user.name')
                    ->label('Usuário')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('ano.nome')
                    ->label('Ano')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Data')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->defaultSort('created_at', 'desc')

            ->headerActions([
                CreateAction::make()
                    ->label('Nova despesa')
                    ->icon('heroicon-m-plus'),
            ])

            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}