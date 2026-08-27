<?php

namespace App\Filament\Resources\Journeys;

use App\Filament\Resources\Journeys\Pages\CreateJourney;
use App\Filament\Resources\Journeys\Pages\EditJourney;
use App\Filament\Resources\Journeys\Pages\ListJourneys;
use App\Filament\Resources\Journeys\Pages\ViewJourney;
use App\Filament\Resources\Journeys\Schemas\JourneyForm;
use App\Filament\Resources\Journeys\Schemas\JourneyInfolist;
use App\Filament\Resources\Journeys\Tables\JourneysTable;
use App\Models\Journey;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class JourneyResource extends Resource
{
    protected static ?string $model = Journey::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMap;

    protected static string|UnitEnum|null $navigationGroup = 'Profil';

    protected static ?string $navigationLabel = 'Perjalanan';

    protected static ?string $modelLabel = 'Perjalanan';

    protected static ?string $pluralModelLabel = 'Perjalanan';

    public static function form(Schema $schema): Schema
    {
        return JourneyForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return JourneyInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JourneysTable::configure($table);
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
            'index' => ListJourneys::route('/'),
            'create' => CreateJourney::route('/create'),
            'view' => ViewJourney::route('/{record}'),
            'edit' => EditJourney::route('/{record}/edit'),
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
