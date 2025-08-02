<?php

namespace App\Filament\Resources\Programs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Filament\Support\Enums\TextSize;
use App\Models\Program;
use Filament\Tables\Enums\PaginationMode;
class ProgramsTable
{
    public static function configure(Table $table): Table
    {
        return $table->query(Program::query()->with('satker'))
        ->heading('Program')
        ->description('Manage your Program here.')->extremePaginationLinks()
        ->groups([
            Group::make('satker.name_satker')->getTitleFromRecordUsing(fn ($record): string => $record->satker?->kd_satker_str.' - '.ucfirst($record->satker->name_satker))->collapsible()->titlePrefixedWithLabel(false)
        ])
            ->columns([
                TextColumn::make('tahun_anggaran')->sortable()->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('nama_program')->prefix(fn($record) => $record->kd_program_str.' - ')->wrap()->size(TextSize::Small)
                    ->searchable(),
                TextColumn::make('pagu_program')
                    ->numeric()
                    ->sortable()->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('pagu_program_perubahan')
                    ->numeric()
                    ->sortable()->toggleable(isToggledHiddenByDefault: true),
                // TextColumn::make('kd_program_lokal')
                //     ->searchable(),
                // IconColumn::make('is_deleted')
                //     ->boolean(),
                // TextColumn::make('_event_date')
                //     ->date()
                //     ->sortable(),
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
                ViewAction::make()->label(false),
                // EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->hidden(),
                ]),
            ]);
    }
}
