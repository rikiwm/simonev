<?php

namespace App\Filament\Resources\Bidangs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BidangsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('urusan_id')
                //     ->numeric()
                //     ->sortable(),
                // TextColumn::make('kd_urusan_str')
                //     ->searchable(),
                // TextColumn::make('kode_bidang')
                //     ->searchable(),
                TextColumn::make('name_bidang')
                    ->searchable(),
                TextColumn::make('short_name')
                    ->searchable()->toggleable(isToggledHiddenByDefault: false),

                IconColumn::make('is_active')
                    ->boolean()->toggleable(isToggledHiddenByDefault: false),
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
