<?php

namespace App\Filament\Resources\Apbds;

use App\Filament\Resources\Apbds\Pages\CreateApbd;
use App\Filament\Resources\Apbds\Pages\EditApbd;
use App\Filament\Resources\Apbds\Pages\ListApbds;
use App\Filament\Resources\Apbds\Pages\ViewApbd;
use App\Filament\Resources\Apbds\Schemas\ApbdForm;
use App\Filament\Resources\Apbds\Schemas\ApbdInfolist;
use App\Filament\Resources\Apbds\Tables\ApbdsTable;
use App\Models\Apbd;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use App\Filament\Resources\Apbds\Widgets\ApbdState;


class ApbdResource extends Resource
{
    protected static ?string $model = Apbd::class;
    protected static string | UnitEnum | null $navigationGroup = 'Monitoring';
// protected static ?string $modelLabel = 'Kinerja';
    // protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

   public static function getWidgets(): array
    {
        return [
            ApbdState::class,
        ];
    }
    


    public static function form(Schema $schema): Schema
    {
        return ApbdForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ApbdInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ApbdsTable::configure($table);
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
            'index' => ListApbds::route('/'),
            'create' => CreateApbd::route('/create'),
            'view' => ViewApbd::route('/{record}'),
            'edit' => EditApbd::route('/{record}/edit'),
        ];
    }
}
