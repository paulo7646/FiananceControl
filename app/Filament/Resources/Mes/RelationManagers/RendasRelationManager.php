<?php

namespace App\Filament\Resources\Mes\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Table;
use Filament\Tables\Grouping\Group;

class RendasRelationManager extends RelationManager
{
    protected static string $relationship = 'rendas';

    protected static ?string $title = '💰 Rendas';

    protected function afterSave(): void
    {
        $this->ownerRecord->recalcularTotais();

        $this->dispatch('mes-updated');
    }

    protected function afterDelete(): void
    {
        $this->ownerRecord->recalcularTotais();

        $this->dispatch('mes-updated');
    }



    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([

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
            ])
            ->columns(2);
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextEntry::make('nome')
                    ->label('Descrição'),

                TextEntry::make('valor')
                    ->money('BRL'),

                TextEntry::make('user.name')
                    ->label('Usuário'),

                TextEntry::make('categoria.nome')
                    ->label('Categoria'),

                TextEntry::make('ano.nome')
                    ->label('Ano'),

                TextEntry::make('created_at')
                    ->label('Criado em')
                    ->dateTime()
                    ->placeholder('-'),

                TextEntry::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nome')
            ->modifyQueryUsing(fn ($query) => $query->with(['categoria', 'user', 'ano']))
            ->groups([Group::make('user.name')->collapsible(),
                      Group::make('categoria.nome')->collapsible(),  
        ])
            ->collapsedGroupsByDefault()
            ->defaultGroup('user.name')
            ->columns([

                TextColumn::make('nome')
                    ->label('Descrição')
                    ->searchable()
                    ->weight('bold'),

                TextColumn::make('valor')
                    ->label('Valor')
                    ->money('BRL')
                    ->sortable()
                    ->color('success')
                    ->weight('bold')
                    ->summarize(
                        Sum::make()
                            ->label('Total')
                            ->money('BRL')
                    ),

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
                    ->label('Nova renda')
                    ->icon('heroicon-m-plus'),
            ])

            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}