<?php

namespace App\Filament\Resources\Misis;

use App\Filament\Resources\Misis\Pages\CreateMisi;
use App\Filament\Resources\Misis\Pages\EditMisi;
use App\Filament\Resources\Misis\Pages\ListMisis;
use App\Filament\Resources\Misis\Pages\ViewMisi;
use App\Filament\Resources\Misis\Schemas\MisiForm;
use App\Filament\Resources\Misis\Schemas\MisiInfolist;
use App\Filament\Resources\Misis\Tables\MisisTable;
use App\Models\Misi;
use UnitEnum;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MisiResource extends Resource
{
    protected static ?string $model = Misi::class;
    protected static string | UnitEnum | null $navigationGroup = 'Prioritas';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return MisiForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MisiInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MisisTable::configure($table);
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
            'index' => ListMisis::route('/'),
            'create' => CreateMisi::route('/create'),
            'view' => ViewMisi::route('/{record}'),
            'edit' => EditMisi::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
