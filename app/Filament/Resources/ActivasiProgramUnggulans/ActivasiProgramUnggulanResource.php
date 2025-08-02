<?php

namespace App\Filament\Resources\ActivasiProgramUnggulans;

use App\Filament\Resources\ActivasiProgramUnggulans\Pages\CreateActivasiProgramUnggulan;
use App\Filament\Resources\ActivasiProgramUnggulans\Pages\EditActivasiProgramUnggulan;
use App\Filament\Resources\ActivasiProgramUnggulans\Pages\ListActivasiProgramUnggulans;
use App\Filament\Resources\ActivasiProgramUnggulans\Pages\ViewActivasiProgramUnggulan;
use App\Filament\Resources\ActivasiProgramUnggulans\Schemas\ActivasiProgramUnggulanForm;
use App\Filament\Resources\ActivasiProgramUnggulans\Schemas\ActivasiProgramUnggulanInfolist;
use App\Filament\Resources\ActivasiProgramUnggulans\Tables\ActivasiProgramUnggulansTable;
use App\Models\ActivasiProgramUnggulan;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ActivasiProgramUnggulanResource extends Resource
{
    protected static ?string $model = ActivasiProgramUnggulan::class;
    protected static string | UnitEnum | null $navigationGroup = 'Program Unggulan';
    // protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ActivasiProgramUnggulanForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ActivasiProgramUnggulanInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ActivasiProgramUnggulansTable::configure($table);
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
            'index' => ListActivasiProgramUnggulans::route('/'),
            'create' => CreateActivasiProgramUnggulan::route('/create'),
            'view' => ViewActivasiProgramUnggulan::route('/{record}'),
            'edit' => EditActivasiProgramUnggulan::route('/{record}/edit'),
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
