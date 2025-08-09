<?php

namespace App\Filament\Resources\Programs\Resources\Kegiatans\Resources\SubKegiatans;

use App\Filament\Resources\Programs\Resources\Kegiatans\KegiatanResource;
use App\Filament\Resources\Programs\Resources\Kegiatans\Resources\SubKegiatans\Pages\CreateSubKegiatan;
use App\Filament\Resources\Programs\Resources\Kegiatans\Resources\SubKegiatans\Pages\EditSubKegiatan;
use App\Filament\Resources\Programs\Resources\Kegiatans\Resources\SubKegiatans\Pages\ViewSubKegiatan;
use App\Filament\Resources\Programs\Resources\Kegiatans\Resources\SubKegiatans\Schemas\SubKegiatanForm;
use App\Filament\Resources\Programs\Resources\Kegiatans\Resources\SubKegiatans\Schemas\SubKegiatanInfolist;
use App\Filament\Resources\Programs\Resources\Kegiatans\Resources\SubKegiatans\Tables\SubKegiatansTable;
use App\Models\SubKegiatan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SubKegiatanResource extends Resource
{
    protected static ?string $model = SubKegiatan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $parentResource = KegiatanResource::class;

    public static function form(Schema $schema): Schema
    {
        return SubKegiatanForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SubKegiatanInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SubKegiatansTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            // KegiatanResource::class
            // SubKegiatanResource::class

        ];
    }

    public static function getPages(): array
    {
        return [
            'create' => CreateSubKegiatan::route('/create'),
            'view' => ViewSubKegiatan::route('/{record}'),
            'edit' => EditSubKegiatan::route('/{record}/edit'),
        ];
    }
}
