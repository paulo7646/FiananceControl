<?php

namespace App\Filament\Resources\CategoriaDespesas;

use App\Filament\Resources\CategoriaDespesas\Pages\CreateCategoriaDespesa;
use App\Filament\Resources\CategoriaDespesas\Pages\EditCategoriaDespesa;
use App\Filament\Resources\CategoriaDespesas\Pages\ListCategoriaDespesas;
use App\Filament\Resources\CategoriaDespesas\Pages\ViewCategoriaDespesa;
use App\Filament\Resources\CategoriaDespesas\Schemas\CategoriaDespesaForm;
use App\Filament\Resources\CategoriaDespesas\Schemas\CategoriaDespesaInfolist;
use App\Filament\Resources\CategoriaDespesas\Tables\CategoriaDespesasTable;
use App\Models\CategoriaDespesa;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class CategoriaDespesaResource extends Resource
{
    protected static ?string $model = CategoriaDespesa::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;

    protected static ?string $recordTitleAttribute = 'Catégoria de despesas';

    protected static string|UnitEnum|null $navigationGroup = 'Despesas';

    public static function form(Schema $schema): Schema
    {
        return CategoriaDespesaForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CategoriaDespesaInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CategoriaDespesasTable::configure($table);
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
            'index' => ListCategoriaDespesas::route('/'),
            'create' => CreateCategoriaDespesa::route('/create'),
            'view' => ViewCategoriaDespesa::route('/{record}'),
            'edit' => EditCategoriaDespesa::route('/{record}/edit'),
        ];
    }
}
