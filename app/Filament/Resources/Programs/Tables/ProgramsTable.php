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
use Illuminate\Support\Str;
use Filament\Support\Enums\FontWeight;
class ProgramsTable
{
    public static function configure(Table $table): Table
    {
        // $bidang = Bidang::all();
        return $table->query(Program::query()->with(['satker','bidang'])
        ->when(!auth()->user()->hasRole('super_admin'), function ($query) {$namaSatker = auth()->user()->satkers_id;$query->where('kd_satker',$namaSatker );})
        )
        ->heading('Program')
        ->description('Manage your Program here.')->extremePaginationLinks()
        ->groups([
            Group::make('bidang.name_bidang')->getTitleFromRecordUsing(fn ($record): string => $record->bidang?->kode_bidang.' - '.ucfirst($record->bidang->name_bidang))->collapsible()->titlePrefixedWithLabel(false)
        ])->defaultGroup('bidang.name_bidang')
            ->columns([
                TextColumn::make('row_number') ->rowIndex()->wrap()->sortable()
                    ->size(TextSize::ExtraSmall)->weight(FontWeight::Light)->badge()
                    ->label('No')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('tahun_anggaran')->sortable()->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('nama_program')->prefix(fn($record) => $record->kd_program_str.' - ')->wrap()->size(TextSize::Small)->weight(FontWeight::Medium)
                    ->searchable()->color(fn ($record) => Str::startsWith($record->kd_program_str, 'P') ? 'primary' : 'secondary')
                    ->sortable()->toggleable(isToggledHiddenByDefault: false),
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
                ViewAction::make()->label(false)
                ->url(fn ($record) => route('filament.simetris.resources.programs.show-program', ['record' => Str::slug($record->kd_program)])),
                // EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->hidden(),
                ]),
            ]);
    }
}
