<?php

namespace App\Filament\Resources\Tools;

use App\Filament\Resources\Tools\Pages\CreateTools;
use App\Filament\Resources\Tools\Pages\EditTools;
use App\Filament\Resources\Tools\Pages\ListTools;
use App\Filament\Resources\Tools\Pages\ViewTools;
use App\Filament\Resources\Tools\Schemas\ToolsForm;
use App\Filament\Resources\Tools\Schemas\ToolsInfolist;
use App\Filament\Resources\Tools\Tables\ToolsTable;
use App\Models\Tools;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class ToolsResource extends Resource
{
    protected static ?string $model = Tools::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedWrenchScrewdriver;

    protected static string|UnitEnum|null $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Tools';

    protected static ?string $modelLabel = 'Tools';

    protected static ?string $pluralModelLabel = 'Tools';

    public static function form(Schema $schema): Schema
    {
        return ToolsForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ToolsInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ToolsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTools::route('/'),
            'create' => CreateTools::route('/create'),
            'view' => ViewTools::route('/{record}'),
            'edit' => EditTools::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
