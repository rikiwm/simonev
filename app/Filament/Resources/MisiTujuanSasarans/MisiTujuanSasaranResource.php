<?php

namespace App\Filament\Resources\MisiTujuanSasarans;

use App\Filament\Resources\MisiTujuanSasarans\Pages\CreateMisiTujuanSasaran;
use App\Filament\Resources\MisiTujuanSasarans\Pages\EditMisiTujuanSasaran;
use App\Filament\Resources\MisiTujuanSasarans\Pages\ListMisiTujuanSasarans;
use App\Filament\Resources\MisiTujuanSasarans\Pages\ViewMisiTujuanSasaran;
use App\Filament\Resources\MisiTujuanSasarans\Schemas\MisiTujuanSasaranForm;
use App\Filament\Resources\MisiTujuanSasarans\Schemas\MisiTujuanSasaranInfolist;
use App\Filament\Resources\MisiTujuanSasarans\Tables\MisiTujuanSasaransTable;
use App\Models\MisiTujuanSasaran;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MisiTujuanSasaranResource extends Resource
{
    protected static ?string $model = MisiTujuanSasaran::class;
    protected static string | UnitEnum | null $navigationGroup = 'Prioritas';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return MisiTujuanSasaranForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MisiTujuanSasaranInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MisiTujuanSasaransTable::configure($table);
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
            'index' => ListMisiTujuanSasarans::route('/'),
            'create' => CreateMisiTujuanSasaran::route('/create'),
            'view' => ViewMisiTujuanSasaran::route('/{record}'),
            'edit' => EditMisiTujuanSasaran::route('/{record}/edit'),
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
