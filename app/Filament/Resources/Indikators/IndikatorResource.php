<?php

namespace App\Filament\Resources\Indikators;

use App\Filament\Resources\Indikators\Pages\CreateIndikator;
use App\Filament\Resources\Indikators\Pages\EditIndikator;
use App\Filament\Resources\Indikators\Pages\ListIndikators;
use App\Filament\Resources\Indikators\Pages\ViewIndikator;
use App\Filament\Resources\Indikators\Schemas\IndikatorForm;
use App\Filament\Resources\Indikators\Schemas\IndikatorInfolist;
use App\Filament\Resources\Indikators\Tables\IndikatorsTable;
use App\Models\Indikator;
use UnitEnum;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class IndikatorResource extends Resource
{
    protected static ?string $model = Indikator::class;
    protected static string | UnitEnum | null $navigationGroup = 'Master';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return IndikatorForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return IndikatorInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return IndikatorsTable::configure($table);
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
            'index' => ListIndikators::route('/'),
            'create' => CreateIndikator::route('/create'),
            'view' => ViewIndikator::route('/{record}'),
            'edit' => EditIndikator::route('/{record}/edit'),
        ];
    }
}
