<?php

namespace App\Filament\Resources\Programs\Resources\Kegiatans\Resources\SubKegiatans\Schemas;

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
use Filament\Schemas\Components\Text;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Support\Enums\Alignment;

class SubKegiatanInfolist
{
    public static function configure(Schema $schema): Schema
    {
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
                                            ->belowContent(',-')->color('success')
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
                                                Text::make(fn($record) => $record->indikatorsubkegiatan?->pelaksana)->weight(FontWeight::SemiBold),
                                            ]),
                                        // TextEntry::make('indikatorsubkegiatan.pelaksana')->label('Pelaksana Kegiatan')->inlineLabel(false)->size(TextSize::Medium)->hiddenLabel()->extraAttributes(['class' => 'bg-gray-200']),
                                        // TextEntry::make('indikatorsubkegiatan.definisi_operasional')->label('Definisi Operasional Sub Kegiatan')->inlineLabel(false)->size(TextSize::ExtraSmall),
                                        // TextEntry::make('indikatorsubkegiatan.definisi_operasional')->label('Definisi Operasional')->inlineLabel()->size(TextSize::ExtraSmall),
                                        TextEntry::make('indikatorsubkegiatan.kinerja')->inlineLabel()->weight(FontWeight::SemiBold)->color('gray')->icon(Heroicon::ArrowTrendingUp),

                                        TextEntry::make('indikatorsubkegiatan.definisi_operasional')->label('Definisi Operasional')->inlineLabel()->size(TextSize::ExtraSmall),
                                        TextEntry::make('pagu_subkegiatan')->label('Pagu Anggaran')->numeric()->inlineLabel()
                                            ->money('IDR', true)->prefix('Rp ')
                                            ->belowContent(',-')->color('success')
                                            ->formatStateUsing(fn($state) => number_format($state, 0, ',', '.'))->weight(FontWeight::Bold),
                                        // ComponentsTextInput::make('progres')->columns(6)->inlineLabel()->label('Proges'),
                                        TextEntry::make('tahun_anggaran')->badge(),
                                    ]),
                            ]),
                        // Tab::make('Realisasi')
                        //     ->schema([


                        //     ]),
                    ])->columnSpanFull()
                    ->contained(false)
                    ->vertical(
                        ! request()->header('User-Agent') || ! preg_match('/Mobile|Android|iP(ad|hone)/i', request()->header('User-Agent'))
                    ),

                Section::make('')->compact()
                    ->schema([
                        Repeater::make('Kinerja')->label('Indikator Kinerja')
                            ->schema([
                                Textarea::make('triwulan')
                                    ->label('Indikator Kinerja')->helperText('Berdasarkan Nomenklatur (Meta Data 2026)'),
                                Flex::make([
                                    TextInput::make('tahun')->label('Satuan')->grow(true)->columnSpanFull(),
                                    Radio::make('is_akumulasi')->boolean()->inline()->inlineLabel(false)->label('Akumulasi ?')
                                        ->helperText('Default :Yes!')
                                        ->grow(false)
                                ])
                            ])
                            ->extraItemActions([
                                Action::make('save')->icon('heroicon-m-document-arrow-up')
                                    ->action(
                                        // function ($livewire) {
                                        function ($livewire) {
                                            dd($livewire);
                                        }
                                    )
                            ])
                            ->addable()->addActionAlignment(Alignment::End)
                            ->statePath('data')->addActionLabel('+ Indikator')
                            ->reorderable(false)
                            ->collapsible()
                            // ->defaultItems(4)
                            ->deletable()
                            ->grid(4),
                    ])->columnSpanFull(),

            ]);
    }
}
