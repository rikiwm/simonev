<?php

namespace App\Filament\Resources\Programs\Resources\Kegiatans;

use App\Filament\Resources\Programs\ProgramResource;
use App\Filament\Resources\Programs\Resources\Kegiatans\Pages\CreateKegiatan;
use App\Filament\Resources\Programs\Resources\Kegiatans\Pages\EditKegiatan;
use App\Filament\Resources\Programs\Resources\Kegiatans\Pages\ViewKegiatan;
use App\Filament\Resources\Programs\Resources\Kegiatans\Schemas\KegiatanForm;
use App\Filament\Resources\Programs\Resources\Kegiatans\Schemas\KegiatanInfolist;
use App\Filament\Resources\Programs\Resources\Kegiatans\Tables\KegiatansTable;
use App\Models\Kegiatan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Contracts\Database\Eloquent\Builder;
use App\Filament\Resources\Kegiatans\RelationManagers\SubKegiatanRelationManager;


class KegiatanResource extends Resource
{
    protected static ?string $model = Kegiatan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $parentResource = ProgramResource::class;

    public static function form(Schema $schema): Schema
    {
        return KegiatanForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return KegiatanInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KegiatansTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
             SubKegiatanRelationManager::class
        ];
    }


       protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()
            ->orderBy('kd_kegiatan_str', 'asc');
    }


    public static function getPages(): array
    {
        return [
            'create' => CreateKegiatan::route('/create'),
            'view' => ViewKegiatan::route('/{record}'),
            'edit' => EditKegiatan::route('/{record}/edit'),
        ];
    }

    // private  function vd($tw)
    // {
    //     $tw =  collect(range(1, 4))->map(fn($i) => [
    //             'triwulan' => "Triwulan {$i}",
    //             'target' => null,
    //             'realisasi' => null,
    //             'keterangan' => null,
    //         ])->toArray();
    // }


}










// use App\Filament\Resources\Kegiatans\RelationManagers\SubKegiatanRelationManager;
// use App\Filament\Resources\Programs\ProgramResource;
// use App\Filament\Resources\Programs\Resources\Kegiatans\Pages\CreateKegiatan;
// use App\Filament\Resources\Programs\Resources\Kegiatans\Pages\EditKegiatan;
// use App\Filament\Resources\Programs\Resources\Kegiatans\Resources\SubKegiatans\SubKegiatanResource;
// use App\Filament\Resources\Programs\Resources\Kegiatans\Schemas\KegiatanForm;
// use App\Filament\Resources\Programs\Resources\Kegiatans\Tables\KegiatansTable;
// use App\Models\Kegiatan;
// use BackedEnum;
// use Filament\Resources\Resource;
// use Filament\Schemas\Schema;
// use Filament\Support\Icons\Heroicon;
// use Filament\Tables\Table;
// use Illuminate\Contracts\Database\Eloquent\Builder;

// class KegiatanResource extends Resource
// {
//     protected static ?string $model = Kegiatan::class;

//     protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

//     protected static ?string $parentResource = ProgramResource::class;

//     public static function form(Schema $schema): Schema
//     {
//         return KegiatanForm::configure($schema);
//     }

//     public static function table(Table $table): Table
//     {
//         return KegiatansTable::configure($table);
//     }
//    protected function getTableQuery(): Builder
//     {
//         return parent::getTableQuery()
//             ->orderBy('kd_kegiatan_str', 'asc');
//     }

//     public static function getRelations(): array
//     {
//         return [
//             SubKegiatanRelationManager::class
//         ];
//     }

//     public static function getPages(): array
//     {
//         return [
//             'create' => CreateKegiatan::route('/create'),
//             'edit' => EditKegiatan::route('/{record}/edit'),
//         ];
//     }
// }
