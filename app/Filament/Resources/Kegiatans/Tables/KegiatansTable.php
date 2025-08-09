<?php

namespace App\Filament\Resources\Kegiatans\Tables;

use App\Models\Kegiatan;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Grouping\Group;
use Filament\Support\Enums\TextSize;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Enums\RecordActionsPosition;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;


class KegiatansTable
{
    public static function configure(Table $table): Table
    {

        try {
            $records = [
                    'program' =>  Str::chopStart(url(\request('program')),'http://127.0.0.1:8000/'),
                    'tahun' => Str::chopStart(url(\request('tahun')),'http://127.0.0.1:8000/'),
                    'skpd' => Str::chopStart(url(\request('skpd')),'http://127.0.0.1:8000/')
            ];
           $records = Cache::remember($records['program'].'-'.$records['skpd'], 3600, function() use($records){
         return $records;
        });
        } catch (\Throwable $th) {
            $records = [];
        }
        return $table
        ->query(Kegiatan::query()
        ->when($records, function($q) use($records){
            $q->whereIn('kd_program',[$records['program'] ?? Str::chopStart(url(\request('program')),'http://127.0.0.1:8000/')]);
        })
        ->with([
            'program'=> function ($query){
            $query->orderBy('kd_program_str', 'asc');
        }
            ])->when(!auth()->user()->hasRole('super_admin'), function ($query) {$namaSatker = auth()->user()->satkers_id;$query->where('kd_satker',$namaSatker );})
            ->orderBy('kd_kegiatan_str','asc')
        // ->when(auth()->user()->hasRole('super_admin'), function ($query) use($records) {$query->where('kd_satker',$records );})
        )
        ->groups([
            Group::make('program.nama_program')->getTitleFromRecordUsing(fn ($record): string => $record->program?->kd_program_str.' - '.ucfirst($record->program?->nama_program))->collapsible()->titlePrefixedWithLabel(false)
        ])->defaultGroup('program.nama_program')
            ->columns([
                TextColumn::make('tahun_anggaran')->label('Thn')
                ->size(TextSize::ExtraSmall)->weight(FontWeight::Light)->badge()
                 ->sortable()->toggleable(isToggledHiddenByDefault: true)
                ->wrap(),
                TextColumn::make('nama_kegiatan')
                ->prefix(fn($record) => $record->kd_kegiatan_str.' - ')->wrap()->size(TextSize::Small)->weight(FontWeight::Medium)
                    ->searchable()->color(fn ($record) => Str::startsWith($record->kd_kegiatan_str, 'P') ? 'primary' : 'secondary')
                ->sortable()->toggleable(isToggledHiddenByDefault: false),
                // TextColumn::make('kd_satker')
                //     ->numeric()
                //     ->sortable(),
                TextColumn::make('kd_program')
                    ->numeric()
                    ->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('kd_kegiatan')
                    ->numeric()
                    ->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('kd_kegiatan_str')
                    ->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('pagu_kegiatan')->label('Pagu')
                  ->money('IDR', true)->prefix('Rp ')
                    ->suffix(',-')
                    ->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.'))
                    ->weight(FontWeight::Medium)
                    ->numeric()
                    ->sortable()->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('pagu_kegiatan_perubahan')
                    ->numeric()
                    ->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('kd_kegiatan_lokal')
                    ->searchable()->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_deleted')
                    ->boolean()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('_event_date')
                    ->date()
                    ->sortable()->toggleable(isToggledHiddenByDefault: true),
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
              ], position: RecordActionsPosition::AfterCells)
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
