<?php

namespace App\Filament\Resources\Mes;

use App\Filament\Resources\Mes\Pages\CreateMes;
use App\Filament\Resources\Mes\Pages\EditMes;
use App\Filament\Resources\Mes\Pages\ListMes;
use App\Filament\Resources\Mes\Pages\ViewMes;
use App\Filament\Resources\Mes\Schemas\MesForm;
use App\Filament\Resources\Mes\Schemas\MesInfolist;
use App\Filament\Resources\Mes\Tables\MesTable;
use App\Models\Mes;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

use App\Filament\Resources\Mes\RelationManagers\DespesasRelationManager;
use App\Filament\Resources\Mes\RelationManagers\RendasRelationManager;

class MesResource extends Resource
{
    protected static ?string $model = Mes::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;

    protected static ?string $recordTitleAttribute = 'Meses';

    protected static string|UnitEnum|null $navigationGroup = 'Calendário';

    public static function form(Schema $schema): Schema
    {
        return MesForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MesInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MesTable::configure($table)
            ->modifyQueryUsing(fn ($query) => $query->with(['ano']));
    }

    public static function getRelations(): array
    {
        return [
            DespesasRelationManager::make(),
            RendasRelationManager::make(),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMes::route('/'),
            'create' => CreateMes::route('/create'),
            'view' => ViewMes::route('/{record}'),
            'edit' => EditMes::route('/{record}/edit'),
        ];
    }
}
