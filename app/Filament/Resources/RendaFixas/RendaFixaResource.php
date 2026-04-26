<?php

namespace App\Filament\Resources\RendaFixas;

use App\Filament\Resources\RendaFixas\Pages\CreateRendaFixa;
use App\Filament\Resources\RendaFixas\Pages\EditRendaFixa;
use App\Filament\Resources\RendaFixas\Pages\ListRendaFixas;
use App\Filament\Resources\RendaFixas\Pages\ViewRendaFixa;
use App\Filament\Resources\RendaFixas\Schemas\RendaFixaForm;
use App\Filament\Resources\RendaFixas\Schemas\RendaFixaInfolist;
use App\Filament\Resources\RendaFixas\Tables\RendaFixasTable;
use App\Models\RendaFixa;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class RendaFixaResource extends Resource
{
    protected static ?string $model = RendaFixa::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowTrendingUp;

    protected static ?string $recordTitleAttribute = 'Rendas Fixas';

    protected static string|UnitEnum|null $navigationGroup = 'Rendas';

    public static function form(Schema $schema): Schema
    {
        return RendaFixaForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return RendaFixaInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RendaFixasTable::configure($table);
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
            'index' => ListRendaFixas::route('/'),
            'create' => CreateRendaFixa::route('/create'),
            'view' => ViewRendaFixa::route('/{record}'),
            'edit' => EditRendaFixa::route('/{record}/edit'),
        ];
    }
}
