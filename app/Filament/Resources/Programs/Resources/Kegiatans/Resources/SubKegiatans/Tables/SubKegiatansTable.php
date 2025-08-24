<?php

namespace App\Filament\Resources\Programs\Resources\Kegiatans\Resources\SubKegiatans\Tables;

use App\Models\SubKegiatan;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\TextSize;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;


class SubKegiatansTable
{
    public static function configure(Table $table): Table
    {
        // dd($table);
        return $table
        ->defaultSort('kd_subkegiatan_str','asc')
        ->deferLoading()
            ->columns([
                TextColumn::make('tahun_anggaran')->label('Thn')->toggleable(isToggledHiddenByDefault: true),
                //     ->searchable(),
                // TextColumn::make('kd_satker')
                //     ->numeric()
                //     ->sortable(),
                // TextColumn::make('kd_program')
                //     ->numeric()
                //     ->sortable(),
                // TextColumn::make('kd_kegiatan')
                //     ->numeric()
                //     ->sortable(),
                TextColumn::make('nama_subkegiatan')
                 ->prefix(fn($record) =>  $record->kd_subkegiatan_str.' - ')->wrap()->size(TextSize::Small)->weight(FontWeight::Medium)
                    ->searchable()->color(fn ($record) => Str::startsWith($record->kd_subkegiatan_str, 'P') ? 'primary' : 'secondary')
                    ->sortable()  ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('indikatorsubkegiatan.kinerja')->wrap()->description(fn($record) => $record->indikatorsubkegiatan?->first()->satuan)->toggleable(isToggledHiddenByDefault: false)->label('Kinerja')->size(TextSize::Small),

                TextColumn::make('kd_subkegiatan_str')
                    ->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('pagu_subkegiatan')
                    ->money('IDR', true)->prefix('Rp ')
                    ->suffix(',-')
                    ->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.'))
                    ->weight(FontWeight::Medium)
                    ->numeric()
                    ->sortable()  ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('pagu_subkegiatan_perubahan')
                    ->numeric()
                    ->sortable()  ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('kd_subkegiatan_lokal')
                    ->searchable()  ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_deleted')
                    ->boolean()  ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('_event_date')
                    ->date()
                    ->sortable()  ->toggleable(isToggledHiddenByDefault: true),
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
                ViewAction::make()->label(false)->icon('heroicon-s-arrow-long-right')->color('primary'),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
