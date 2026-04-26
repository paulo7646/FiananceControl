<?php

namespace App\Filament\Resources\Anos;

use App\Filament\Resources\Anos\Pages\CreateAno;
use App\Filament\Resources\Anos\Pages\EditAno;
use App\Filament\Resources\Anos\Pages\ListAnos;
use App\Filament\Resources\Anos\Pages\ViewAno;
use App\Filament\Resources\Anos\Schemas\AnoForm;
use App\Filament\Resources\Anos\Schemas\AnoInfolist;
use App\Filament\Resources\Anos\Tables\AnosTable;
use App\Models\Ano;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class AnoResource extends Resource
{
    protected static ?string $model = Ano::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendar;

    protected static ?string $recordTitleAttribute = 'Anos';

    protected static string|UnitEnum|null $navigationGroup = 'Calendário';

    public static function form(Schema $schema): Schema
    {
        return AnoForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AnoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AnosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
         
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAnos::route('/'),
            'create' => CreateAno::route('/create'),
            'view' => ViewAno::route('/{record}'),
            'edit' => EditAno::route('/{record}/edit'),
        ];
    }
}
