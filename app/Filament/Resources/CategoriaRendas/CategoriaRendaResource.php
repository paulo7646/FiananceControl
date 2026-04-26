<?php

namespace App\Filament\Resources\CategoriaRendas;

use App\Filament\Resources\CategoriaRendas\Pages\CreateCategoriaRenda;
use App\Filament\Resources\CategoriaRendas\Pages\EditCategoriaRenda;
use App\Filament\Resources\CategoriaRendas\Pages\ListCategoriaRendas;
use App\Filament\Resources\CategoriaRendas\Pages\ViewCategoriaRenda;
use App\Filament\Resources\CategoriaRendas\Schemas\CategoriaRendaForm;
use App\Filament\Resources\CategoriaRendas\Schemas\CategoriaRendaInfolist;
use App\Filament\Resources\CategoriaRendas\Tables\CategoriaRendasTable;
use App\Models\CategoriaRenda;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class CategoriaRendaResource extends Resource
{
    protected static ?string $model = CategoriaRenda::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;

    protected static ?string $recordTitleAttribute = 'Catégorias de renda';

    protected static string|UnitEnum|null $navigationGroup = 'Rendas';

    public static function form(Schema $schema): Schema
    {
        return CategoriaRendaForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CategoriaRendaInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CategoriaRendasTable::configure($table);
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
            'index' => ListCategoriaRendas::route('/'),
            'create' => CreateCategoriaRenda::route('/create'),
            'view' => ViewCategoriaRenda::route('/{record}'),
            'edit' => EditCategoriaRenda::route('/{record}/edit'),
        ];
    }
}
