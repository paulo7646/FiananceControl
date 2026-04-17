<?php

namespace App\Filament\Resources\DespesaFixas;

use App\Filament\Resources\DespesaFixas\Pages\CreateDespesaFixa;
use App\Filament\Resources\DespesaFixas\Pages\EditDespesaFixa;
use App\Filament\Resources\DespesaFixas\Pages\ListDespesaFixas;
use App\Filament\Resources\DespesaFixas\Pages\ViewDespesaFixa;
use App\Filament\Resources\DespesaFixas\Schemas\DespesaFixaForm;
use App\Filament\Resources\DespesaFixas\Schemas\DespesaFixaInfolist;
use App\Filament\Resources\DespesaFixas\Tables\DespesaFixasTable;
use App\Models\DespesaFixa;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;


class DespesaFixaResource extends Resource
{
    protected static ?string $model = DespesaFixa::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Despesas Fixas';

    protected static string|UnitEnum|null $navigationGroup = 'Despesas';

    public static function form(Schema $schema): Schema
    {
        return DespesaFixaForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DespesaFixaInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DespesaFixasTable::configure($table);
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
            'index' => ListDespesaFixas::route('/'),
            'create' => CreateDespesaFixa::route('/create'),
            'view' => ViewDespesaFixa::route('/{record}'),
            'edit' => EditDespesaFixa::route('/{record}/edit'),
        ];
    }
}
