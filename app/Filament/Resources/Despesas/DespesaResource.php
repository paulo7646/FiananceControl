<?php

namespace App\Filament\Resources\Despesas;

use App\Filament\Resources\Despesas\Pages\CreateDespesa;
use App\Filament\Resources\Despesas\Pages\EditDespesa;
use App\Filament\Resources\Despesas\Pages\ListDespesas;
use App\Filament\Resources\Despesas\Pages\ViewDespesa;
use App\Filament\Resources\Despesas\Schemas\DespesaForm;
use App\Filament\Resources\Despesas\Schemas\DespesaInfolist;
use App\Filament\Resources\Despesas\Tables\DespesasTable;
use App\Models\Despesa;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class DespesaResource extends Resource
{
    protected static ?string $model = Despesa::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Despesas Variaveis';

    protected static string|UnitEnum|null $navigationGroup = 'Despesas';

    public static function form(Schema $schema): Schema
    {
        return DespesaForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DespesaInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DespesasTable::configure($table)
            ->modifyQueryUsing(fn ($query) => $query->with(['user', 'categoria', 'mes', 'ano']));
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDespesas::route('/'),
            'create' => CreateDespesa::route('/create'),
            'view' => ViewDespesa::route('/{record}'),
            'edit' => EditDespesa::route('/{record}/edit'),
        ];
    }
}
