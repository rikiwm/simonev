<?php

namespace App\Filament\Resources\ProgramUnggulans;

use App\Filament\Resources\ProgramUnggulans\Pages\CreateProgramUnggulan;
use App\Filament\Resources\ProgramUnggulans\Pages\EditProgramUnggulan;
use App\Filament\Resources\ProgramUnggulans\Pages\ListProgramUnggulans;
use App\Filament\Resources\ProgramUnggulans\Pages\ViewProgramUnggulan;
use App\Filament\Resources\ProgramUnggulans\Schemas\ProgramUnggulanForm;
use App\Filament\Resources\ProgramUnggulans\Schemas\ProgramUnggulanInfolist;
use App\Filament\Resources\ProgramUnggulans\Tables\ProgramUnggulansTable;
use App\Models\ProgramUnggulan;
use UnitEnum;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProgramUnggulanResource extends Resource
{
    protected static ?string $model = ProgramUnggulan::class;
    protected static string | UnitEnum | null $navigationGroup = 'Program Unggulan';

    // protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ProgramUnggulanForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProgramUnggulanInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProgramUnggulansTable::configure($table);
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
            'index' => ListProgramUnggulans::route('/'),
            'create' => CreateProgramUnggulan::route('/create'),
            'view' => ViewProgramUnggulan::route('/{record}'),
            'edit' => EditProgramUnggulan::route('/{record}/edit'),
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
