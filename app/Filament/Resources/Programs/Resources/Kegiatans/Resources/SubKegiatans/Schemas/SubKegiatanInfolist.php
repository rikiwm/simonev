<?php

namespace App\Filament\Resources\Programs\Resources\Kegiatans\Resources\SubKegiatans\Schemas;

use App\Models\RealisasiKinerja;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Actions\Action;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Icon;
use Filament\Support\Enums\Size;
use Filament\Support\Icons\Heroicon;
use Filament\Schemas\Components\Flex;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\TextSize;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Text;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Support\Enums\Alignment;

class SubKegiatanInfolist
{
    public static function configure(Schema $schema): Schema
    {
        // dd($schema);
        return $schema
            ->components([
                Tabs::make('Tabs')
                    ->tabs([
                        Tab::make('Detail Informasi')->icon(Heroicon::Bell)
                            ->schema([
                                Section::make('')->compact()
                                    ->inlineLabel()->columnSpanFull()
                                    ->schema([
                                        TextEntry::make('kegiatan.program.bidang.kode_bidang')->hiddenLabel()->inlineLabel(false)->weight(FontWeight::ExtraLight)->belowContent(fn($record) => $record->kegiatan->program->bidang->name_bidang),
                                        TextEntry::make('kegiatan.program.kd_program_str')->hiddenLabel()->inlineLabel(false)->weight(FontWeight::ExtraLight)->belowContent(fn($record) => $record->kegiatan->program->nama_program),
                                        TextEntry::make('kegiatan.kd_kegiatan_str')->hiddenLabel()->inlineLabel(false)->weight(FontWeight::ExtraLight)->belowContent(fn($record) => $record->kegiatan->nama_kegiatan),
                                        TextEntry::make('kd_subkegiatan_str')->hiddenLabel()->inlineLabel(false)->weight(FontWeight::ExtraLight)->belowContent(fn($record) => $record->nama_subkegiatan),
                                        TextEntry::make('pagu_subkegiatan')->label('Pagu Anggaran')->numeric()->inlineLabel()
                                            ->money('IDR', true)->prefix('Rp ')
                                            ->suffix(',-')->color('success')
                                            ->formatStateUsing(fn($state) => number_format($state, 0, ',', '.'))->weight(FontWeight::Bold),
                                        // ComponentsTextInput::make('progres')->columns(6)->inlineLabel()->label('Proges'),
                                        TextEntry::make('tahun_anggaran')->badge(),

                                    ])->columns(2)


                            ]),
                        Tab::make('Indikator')->icon(Heroicon::OutlinedClipboardDocument)
                            ->schema([
                                // ...
                                Section::make('')->compact()
                                    ->inlineLabel()
                                    ->schema([
                                        TextEntry::make('indikatorsubkegiatan.indikator')->hiddenLabel()
                                            ->inlineLabel(false)->size(TextSize::Small)->weight(FontWeight::Bold)->aboveContent([
                                                Icon::make(Heroicon::InformationCircle),
                                                Text::make(fn($record) => $record->indikatorsubkegiatan->pelaksana ?? null)->weight(FontWeight::SemiBold),
                                            ]),
                                        // TextEntry::make('indikatorsubkegiatan.pelaksana')->label('Pelaksana Kegiatan')->inlineLabel(false)->size(TextSize::Medium)->hiddenLabel()->extraAttributes(['class' => 'bg-gray-200']),
                                        // TextEntry::make('indikatorsubkegiatan.definisi_operasional')->label('Definisi Operasional Sub Kegiatan')->inlineLabel(false)->size(TextSize::ExtraSmall),
                                        // TextEntry::make('indikatorsubkegiatan.definisi_operasional')->label('Definisi Operasional')->inlineLabel()->size(TextSize::ExtraSmall),
                                        TextEntry::make('indikatorsubkegiatan.kinerja')
                                            ->inlineLabel()->weight(FontWeight::SemiBold)->color('gray')->icon(Heroicon::ArrowTrendingUp),

                                        TextEntry::make('indikatorsubkegiatan.definisi_operasional')->label('Definisi Operasional')->inlineLabel()->size(TextSize::ExtraSmall),
                                        TextEntry::make('pagu_subkegiatan')->label('Pagu Anggaran')->numeric()->inlineLabel()
                                            ->money('IDR', true)->prefix('Rp ')
                                            ->suffix(',-')->color('success')
                                            ->formatStateUsing(fn($state) => number_format($state, 0, ',', '.'))->weight(FontWeight::Bold),
                                        // ComponentsTextInput::make('progres')->columns(6)->inlineLabel()->label('Proges'),
                                        TextEntry::make('tahun_anggaran')->badge(),
                                    ]),
                                Section::make('')
                                    ->schema([
                                        Repeater::make('indikatorsubke')->label('Indikator Kinerja')->hiddenLabel()
                                            ->schema([
                                                Textarea::make('indikator')
                                                    ->label('Indikator Kinerja')->helperText('Berdasarkan Nomenklatur (Meta Data 2026)'),
                                                Flex::make([
                                                    TextInput::make('satuan')->label('Satuan')->grow(true)->columnSpanFull(),
                                                    Radio::make('is_akumulasi')->boolean()->inline()->inlineLabel(false)->label('Akumulasi ?')
                                                        ->helperText('Default :Yes!')
                                                        ->grow(false)
                                                ])
                                            ])
                                            ->extraItemActions([
                                                Action::make('save')->icon('heroicon-m-document-arrow-up')->color('success')
                                                    ->label(false)
                                                    // ->requiresConfirmation()
                                                    ->form(function ($record) {
                                                        // Cari data existing realisasi
                                                        $existing = RealisasiKinerja::where('indikator_sub_kegiatan_id', $record->indikatorsubkegiatan?->id)
                                                            // ->where('kode_type', $record->kd_subkegiatan)
                                                            ->where('kodeindikator', $record->indikatorsubkegiatan?->id)
                                                            ->where('tahun_realisasi', $record->tahun_anggaran)
                                                            ->first();
                                                        // dd($existing);
                                                        return [
                                                            TextInput::make('target')
                                                                ->required()->default($existing?->target),
                                                            TextInput::make('tw1')
                                                                ->label('Triwulan 1')
                                                                ->numeric()
                                                                // ->required()
                                                                ->default($existing?->real_p_t1)
                                                                ->columnSpan(2),
                                                            TextInput::make('tw2')
                                                                ->label('Triwulan 2')
                                                                ->numeric()
                                                                // ->required()
                                                                ->default($existing?->real_p_t2)
                                                                ->columnSpan(2),
                                                            TextInput::make('tw3')
                                                                ->label('Triwulan 3')
                                                                ->numeric()
                                                                // ->required()
                                                                ->default($existing?->real_p_t3)
                                                                ->columnSpan(2),
                                                            TextInput::make('tw4')
                                                                ->label('Triwulan 4')
                                                                ->numeric()
                                                                // ->required()
                                                                ->default($existing?->real_p_t4)
                                                                ->columnSpan(2),


                                                        ];
                                                    })
                                                    ->action(function ($livewire, $record) {
                                                        $fill = $livewire->mountedActions[0]['data'] ?? [];
                                                        $ip = RealisasiKinerja::updateOrCreate(
                                                            [
                                                                'tahun_realisasi' => $record->tahun_aggaran,
                                                                'kode_type'       => $record->kd_subkegiatan,
                                                                'indikator_sub_kegiatan_id'   => $record->indikatorsubkegiatan->id,
                                                            ],
                                                            [
                                                                'kodeindikator' => $record->indikatorsubkegiatan->id,
                                                                'skpds_id'                   => $record->kd_satker,
                                                                'jenis'                   => 'output',
                                                                'type_name'                   => 'Sub Kegiatan',
                                                                'target'                  => $fill['target'] ?? null,
                                                                'real_p_t1'                  => $fill['tw1'] ?? null,
                                                                'real_p_t2'                  => $fill['tw2'] ?? null,
                                                                'real_p_t3'                  => $fill['tw3'] ?? null,
                                                                'real_p_t4'                  => $fill['tw4'] ?? null,
                                                                'tahun_realisasi'            => $record->tahun_aggaran ?? now()->format('Y'),
                                                                'is_active'                  => true,
                                                            ]
                                                        );
                                                        Notification::make()
                                                            ->title('Indikator Program berhasil ditambah')
                                                            ->body('Indikator Program berhasil ditambah')
                                                            ->success()
                                                            ->send();
                                                    }),


                                            ])
                                            ->deleteAction(
                                                fn(Action $action) => $action->requiresConfirmation()->icon('heroicon-m-document-arrow-down'),
                                            )
                                            ->addable()->addActionAlignment(Alignment::End)
                                            ->statePath('data')->addActionLabel('+ Indikator')
                                            ->reorderable(false)
                                            ->collapsible()
                                            ->maxItems(4)
                                            ->deletable()->statePath('indikatorsubke')
                                            ->grid(1),

                                    ]),
                            ]),

                    ])->columnSpanFull()
                    ->contained(false)
                    ->vertical(
                        ! request()->header('User-Agent') || ! preg_match('/Mobile|Android|iP(ad|hone)/i', request()->header('User-Agent'))
                    ),


            ]);
    }
}
