<?php

namespace App\Filament\Resources\MisiTujuans;

use App\Filament\Resources\MisiTujuans\Pages\CreateMisiTujuan;
use App\Filament\Resources\MisiTujuans\Pages\EditMisiTujuan;
use App\Filament\Resources\MisiTujuans\Pages\ListMisiTujuans;
use App\Filament\Resources\MisiTujuans\Pages\ViewMisiTujuan;
use App\Filament\Resources\MisiTujuans\Schemas\MisiTujuanForm;
use App\Filament\Resources\MisiTujuans\Schemas\MisiTujuanInfolist;
use App\Filament\Resources\MisiTujuans\Tables\MisiTujuansTable;
use App\Models\MisiTujuan;
use UnitEnum;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MisiTujuanResource extends Resource
{
    protected static ?string $model = MisiTujuan::class;
    protected static string | UnitEnum | null $navigationGroup = 'Prioritas';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return MisiTujuanForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MisiTujuanInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MisiTujuansTable::configure($table);
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
            'index' => ListMisiTujuans::route('/'),
            'create' => CreateMisiTujuan::route('/create'),
            'view' => ViewMisiTujuan::route('/{record}'),
            'edit' => EditMisiTujuan::route('/{record}/edit'),
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
