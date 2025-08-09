<?php

namespace App\Filament\Resources\Kegiatans\RelationManagers;

use App\Filament\Resources\Programs\Resources\Kegiatans\Resources\SubKegiatans\SubKegiatanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class SubKegiatanRelationManager extends RelationManager
{
    protected static string $relationship = 'subkegiatan';

    protected static ?string $relatedResource = SubKegiatanResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
