<?php

namespace App\Filament\Resources\Apbds\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Models\Apbd;
use App\Models\Skpd;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\TextSize;
class ApbdsTable
{
    public static function configure(Table $table): Table
    {
        return $table
          ->query(Skpd::query()
          ->when(!auth()->user()->hasRole('super_admin'), function ($query) {$namaSatker = auth()->user()->skpd->name_satker;$query->where('name_satker', 'LIKE', '%' . $namaSatker . '%');}
            )
        ->where('apbds.event_date', '=', Carbon::now()->subDays(21)->format('Y-m-d') ?? Carbon::now()->subDays(21)->format('Y-m-d'))
                    ->join(
                        'apbds',
                        'apbds.SKPD',
                        '=',
                        'skpds.name_satker'
                    )->select(
                        'skpds.name_satker',
                        'skpds.kd_satker_str',
                        'skpds.kd_satker',
                        'skpds.id',
                        DB::raw('SUM(apbds.ANGGARAN) as Pagu'),
                        DB::raw('SUM(apbds.REALISASI) as Realisasi'),
                        'apbds.tahun_anggaran',
                        'apbds.event_date',
                    )->groupBy('apbds.SKPD', 'apbds.tahun_anggaran', 'apbds.event_date', 'skpds.name_satker', 'skpds.id')

                )->paginated(10)->deferLoading()
            ->columns([
                TextColumn::make('name_satker')->weight(FontWeight::Medium)->label('Satker')->description(fn ($record) => $record->kd_satker_str)
                    ->sortable()->size(TextSize::Medium)->wrap()
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(),
                TextColumn::make('Pagu')->label('Pagu')
                  ->money('IDR', true)->prefix('Rp ')
                    ->suffix(',-')
                    ->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.'))
                    ->weight(FontWeight::Medium)
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('Realisasi')->label('Realisasi')
                         ->money('IDR', true)->prefix('Rp. ')
                    ->suffix(',-')
                    ->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.'))
                    ->weight(FontWeight::Medium)
                    ->searchable(),

                    TextColumn::make('Kinerja')->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),
                    TextColumn::make('Kerja')->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),
                        TextColumn::make('tahun_anggaran')->sortable()->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('event_date')->wrap()
                    ->date()
                    ->sortable()->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()->wrap()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()->wrap()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make()->label(false)->url(fn ($record) => route('filament.simetris.resources.programs.index', ['record' => Str::slug($record->kd_satker)])),
                // EditAction::make()->label(false)->url(fn ($record) => route('filament.resources.apbds.apbd.edit', ['record' => $record->id])),
            ])
            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
