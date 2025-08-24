<?php

namespace App\Filament\Resources\Programs\Tables;

use App\Filament\Resources\Programs\Pages\ShowProgram;
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
use Filament\Support\Enums\IconPosition;
use Filament\Support\Enums\Size;

class ProgramsTable
{
//    public $record = null;
//     public function mount(string $record)
//     {
//         $this->record = $record;
//         dd($record);

//     }
    public static function configure(Table $table): Table
    {
          try {
               $record = Str::after(url(request('record')), 'http://127.0.0.1:8000/');
                $records = trim($record); // keep it raw or sanitize as needed
            } catch (\Throwable $th) {
                $records = '';
            }
        return $table->query(Program::query()->with(['satker','bidang'])
        ->when(!auth()->user()->hasRole('super_admin'), function ($query) {
                $namaSatker = auth()->user()->satkers_id;
                $query->where('kd_satker', $namaSatker);
            })
            ->when(auth()->user()->hasRole('super_admin') && !empty($records), function ($query) use ($records) {
                $query->where('kd_satker', $records);
            })
        ->orderBy('kd_bidang_str', 'asc')
        ->orderBy('kd_program_str', 'asc')
        )
        ->groups([
            Group::make('bidang.name_bidang')->getTitleFromRecordUsing(fn ($record): string => $record->bidang?->kode_bidang.' - '.ucfirst($record->bidang->name_bidang))->collapsible()->titlePrefixedWithLabel(false)
        ])->defaultGroup('bidang.name_bidang')
        ->deferLoading()
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
                ->money('IDR', true)->prefix('Rp ')
                    ->suffix(',-')
                    ->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.'))
                    ->weight(FontWeight::Medium)
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
                EditAction::make()->label(false)->button()->outlined()->size(Size::ExtraSmall)->color('secondary'),

                ViewAction::make()->label('Lihat')->icon('heroicon-s-arrow-right')->iconPosition(IconPosition::After)->color('warning')->button()->outlined(false)->size(Size::ExtraSmall),
                // ViewAction::make()->label(false)->url(fn ($record) => route('filament.simetris.resources.kegiatans.index', 
                // [
                //     'program' => Str::slug($record->kd_program),
                //     'tahun' => Str::slug($record->tahun_anggaran),
                //     'skpd' => Str::slug($record->satker->name_satker)
                // ]
                // )),

                // ->url(fn ($record) => route('filament.simetris.resources.kegiatan.index', ['record' => Str::slug($record->kd_program)])),
                // ShowProgram::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->hidden(),
                ]),
            ]);
    }
}
