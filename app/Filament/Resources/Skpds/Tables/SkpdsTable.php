<?php

namespace App\Filament\Resources\Skpds\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Support\Enums\TextSize;
use Filament\Support\Enums\FontWeight;
class SkpdsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kd_satker')
                    ->numeric()
                    ->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('name_satker')->wrap()->size(TextSize::Small)->description(fn($record) => $record->kd_satker_str.' - '.$record->short_name_satker)->weight(FontWeight::Medium)
                // ->description(fn($record) => $record->short_name_satker)
                    ->searchable(),

                TextColumn::make('asisten')
                    ->searchable() ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('nama_asisten')
                    ->searchable() ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('telepon')
                    ->searchable() ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('kodepos')
                    ->numeric()
                    ->sortable() ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status_satker')
                    ->searchable() ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('jenis_satker')
                    ->searchable() ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('kd_klpd')
                    ->searchable() ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('nama_klpd')
                    ->searchable() ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('jenis_klpd')
                    ->searchable() ->toggleable(isToggledHiddenByDefault: true),

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
                ViewAction::make()->label(false)->modal(true),
                EditAction::make()->label(false),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
