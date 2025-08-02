<?php

namespace App\Filament\Resources\Organisations;

use App\Filament\Resources\Organisations\Pages\CreateOrganisation;
use App\Filament\Resources\Organisations\Pages\EditOrganisation;
use App\Filament\Resources\Organisations\Pages\ListOrganisations;
use App\Filament\Resources\Organisations\Pages\ViewOrganisation;
use App\Filament\Resources\Organisations\Schemas\OrganisationForm;
use App\Filament\Resources\Organisations\Schemas\OrganisationInfolist;
use App\Filament\Resources\Organisations\Tables\OrganisationsTable;
use App\Models\Organisation;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class OrganisationResource extends Resource
{
    protected static ?string $model = Organisation::class;
    protected static string | UnitEnum | null $navigationGroup = 'Companies';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return OrganisationForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return OrganisationInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OrganisationsTable::configure($table);
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
            'index' => ListOrganisations::route('/'),
            'create' => CreateOrganisation::route('/create'),
            'view' => ViewOrganisation::route('/{record}'),
            'edit' => EditOrganisation::route('/{record}/edit'),
        ];
    }
}
