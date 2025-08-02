<?php

namespace App\Filament\Resources\Skpds;

use App\Filament\Resources\Skpds\Pages\CreateSkpd;
use App\Filament\Resources\Skpds\Pages\EditSkpd;
use App\Filament\Resources\Skpds\Pages\ListSkpds;
use App\Filament\Resources\Skpds\Pages\ViewSkpd;
use App\Filament\Resources\Skpds\Schemas\SkpdForm;
use App\Filament\Resources\Skpds\Schemas\SkpdInfolist;
use App\Filament\Resources\Skpds\Tables\SkpdsTable;
use App\Models\Skpd;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SkpdResource extends Resource
{
    protected static ?string $model = Skpd::class;
    protected static string | UnitEnum | null $navigationGroup = 'Companies';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return SkpdForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SkpdInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SkpdsTable::configure($table);
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
            'index' => ListSkpds::route('/'),
            'create' => CreateSkpd::route('/create'),
            // 'view' => ViewSkpd::route('/{record}'),
            'edit' => EditSkpd::route('/{record}/edit'),
        ];
    }
}
