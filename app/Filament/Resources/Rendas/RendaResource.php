<?php

namespace App\Filament\Resources\Rendas;

use App\Filament\Resources\Rendas\Pages\CreateRenda;
use App\Filament\Resources\Rendas\Pages\EditRenda;
use App\Filament\Resources\Rendas\Pages\ListRendas;
use App\Filament\Resources\Rendas\Pages\ViewRenda;
use App\Filament\Resources\Rendas\Schemas\RendaForm;
use App\Filament\Resources\Rendas\Schemas\RendaInfolist;
use App\Filament\Resources\Rendas\Tables\RendasTable;
use App\Models\Renda;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class RendaResource extends Resource
{
    protected static ?string $model = Renda::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Rendas variaveis';

    protected static string|UnitEnum|null $navigationGroup = 'Rendas';

    public static function form(Schema $schema): Schema
    {
        return RendaForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return RendaInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RendasTable::configure($table)
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
            'index' => ListRendas::route('/'),
            'create' => CreateRenda::route('/create'),
            'view' => ViewRenda::route('/{record}'),
            'edit' => EditRenda::route('/{record}/edit'),
        ];
    }
}
