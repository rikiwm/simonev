<?php

namespace App\Filament\Resources\Urusans;

use App\Filament\Resources\Urusans\Pages\CreateUrusan;
use App\Filament\Resources\Urusans\Pages\EditUrusan;
use App\Filament\Resources\Urusans\Pages\ListUrusans;
use App\Filament\Resources\Urusans\Pages\ViewUrusan;
use App\Filament\Resources\Urusans\Schemas\UrusanForm;
use App\Filament\Resources\Urusans\Schemas\UrusanInfolist;
use App\Filament\Resources\Urusans\Tables\UrusansTable;
use App\Models\Urusan;
use UnitEnum;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class UrusanResource extends Resource
{
    protected static ?string $model = Urusan::class;
    protected static string | UnitEnum | null $navigationGroup = 'Spm';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return UrusanForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return UrusanInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UrusansTable::configure($table);
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
            'index' => ListUrusans::route('/'),
            'create' => CreateUrusan::route('/create'),
            'view' => ViewUrusan::route('/{record}'),
            'edit' => EditUrusan::route('/{record}/edit'),
        ];
    }
}
