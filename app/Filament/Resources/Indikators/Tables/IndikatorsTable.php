<?php

namespace App\Filament\Resources\Indikators\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Grouping\Group;
class IndikatorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
        ->groups([
            Group::make('parent_id')
                ->label('parent'),
        ])
            ->columns([
                TextColumn::make('nama_indikator')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('satuan')
                    ->searchable(),
                TextColumn::make('sumber_data')
                    ->searchable()->toggleable(isToggledHiddenByDefault: false),
                IconColumn::make('is_active')
                    ->boolean()->toggleable(isToggledHiddenByDefault: false),
                IconColumn::make('is_canges')
                    ->boolean()->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
