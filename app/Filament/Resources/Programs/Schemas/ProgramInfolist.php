<?php

namespace App\Filament\Resources\Programs\Schemas;

use Filament\Actions\Action;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Icon;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\Size;
use Filament\Support\Icons\Heroicon;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Flex;
use Filament\Support\Enums\Alignment;

class ProgramInfolist
{

    public static function configure(Schema $schema): Schema
    {
        // $data = [];
        // dd($schema);
        return $schema
            ->components([
                Section::make('Infos')->compact()->collapsible()
                    ->inlineLabel()
                    ->schema([
                        TextEntry::make('nama_program')->label('Program')->columnSpan(2)->inlineLabel(false),
                        TextEntry::make('bidang.name_bidang')->label('Bidang')->columns(2)->inlineLabel(false),
                        TextEntry::make('satker.name_satker')->alignBetween()->alignLeft()->columns(2)->inlineLabel(false),
                        TextEntry::make('pagu_program')->label('Pagu')->columns(2)
                            ->money('IDR', true)->prefix('Rp ')
                            ->suffix(',-')->color('success')
                            ->formatStateUsing(fn($state) => number_format($state, 0, ',', '.'))->weight(FontWeight::Bold),
                        TextEntry::make('pagu_program')->label('Perubahan')->columns(2)
                            ->numeric()->inlineLabel()->money('IDR', true)->prefix('Rp ')
                            ->suffix(',-')->color('warning')
                            ->formatStateUsing(fn($state) => number_format($state, 0, ',', '.'))->weight(FontWeight::Bold),

                    ])->columns(2),
                Section::make('')->id('outcome')
                    ->compact()
                    ->footerActions([
                        Action::make('saveOutcome')
                            ->label('Edit')
                            ->size(Size::ExtraSmall)
                            ->color('gray')->outlined()
                            ->icon(Heroicon::OutlinedArchiveBox)
                            ->requiresConfirmation()
                            // ->action(function (array $state) {
                                ->action(function (array $state, $livewire) {
                                dd($livewire);
                                // $record->update([
                                //     'satuan'   => $data['satuan'],
                                //     'is_sum'   => $data['is_sum'],
                                //     'indikator'=> $data['indikator'],
                                // ]);

                                \Filament\Notifications\Notification::make()
                                    ->title('Outcome berhasil disimpan!')
                                    ->body($state['indikator'] ?? '' . '' . $state['satuan'] ?? '' . 'Outcome berhasil disimpan!')
                                    ->success()
                                    ->send();
                            }),
                    ])

                    ->schema([
                Repeater::make('indikatorprogram')->label('Indikator Kinerja') ->hiddenLabel()
                ->schema([
                    Textarea::make('indikator')->label('Indikator Kinerja')->helperText('Berdasarkan Nomenklatur (Meta Data 2026)'),
                                Flex::make([
                                    TextInput::make('satuan')->label('Satuan')->grow(true)->columnSpanFull(),
                                    Radio::make('is_akumulasi')->boolean()->inline()->inlineLabel(false)->label('Akumulasi ?')
                                        ->helperText('Default :Yes!')
                                        ->grow(false)
                                        ])
                                ])
                                ->addable()
                                ->reorderable(false)
                                ->collapsible()
                                 ->minItems(4)
                                 ->defaultItems(4)
                                ->deletable()
                                    ->extraItemActions([
                                    Action::make('save')->icon('heroicon-m-document-arrow-up')
                                        ->label(false)
                                    ])
                                // ->extraItemActions([
                                //     Action::make('save')
                                //         ->label(false)
                                //     ->action(function (array $arguments, Get $get) {
                                //             $index = $arguments['item'] ?? null;

                                //             if ($index !== null) {
                                //                 $nama = $get("data.{$index}.nama_subkegiatan");
                                //                 $volume = $get("data.{$index}.satuan");
                                //                 Notification::make('success')
                                //                     ->title('Item Disimpan')
                                //                 ->body("Kegiatan '{$nama}' dengan volume {$volume} berhasil disimpan.")
                                //                     ->success()
                                //                     ->send();
                                //             }
                                //         })
                                //         ->icon('heroicon-m-check-circle')->color('success')
                                //     ])
                                // ->collapsed()
                                ->itemLabel('index')->addActionAlignment(Alignment::End)
                                // ->itemLabel(fn(array $state): ?string => $state['kd_subkegiatan'] )
                                // ->itemLabel(fn(array $state): ?string => $state['kd_subkegiatan'] . ' - Pagu : Rp.' . number_format($state['pagu_subkegiatan'], 0, ',', '.') ?? null)
                             
                ->statePath('indikatorprogram')
                ->columnSpanFull(),
                      

                    ]),
                //  Section::make('Realisasi')->compact()->collapsible()->id('realisasi')->inlineLabel()
                //     ->headerActions([
                //         Action::make('saveRealisasi')
                //             ->label('Save')
                //             ->size(Size::ExtraSmall)
                //             ->color('gray')->outlined()
                //             ->icon(Heroicon::OutlinedArchiveBox)
                //             // ->requiresConfirmation()
                //             // ->action(function (array $state) {
                //             ->action(function (array $state) {
                //                 dd($state);
                //                 // $record->update([
                //                 //     'satuan'   => $data['satuan'],
                //                 //     'is_sum'   => $data['is_sum'],
                //                 //     'indikator'=> $data['indikator'],
                //                 // ]);
                //                 \Filament\Notifications\Notification::make()
                //                     ->title('Outcome berhasil disimpan!')
                //                     // ->body($state['indikator'] ?? ''. ''.$state['satuan'] ?? ''.'Outcome berhasil disimpan!')
                //                     ->success()
                //                     ->send();
                //             }),
                //     ])
                // ->schema([
                //     ComponentsTextInput::make('realisasi')->columns(6)->inlineLabel()->label('Prosadases'),
                //     TextEntry::make('tahun_anggaran')->columns(6),
                //     TextEntry::make('updated_at')->columns(2)->dateTime()
                // ])
                // Repeater::make('data')->label('Indikator Kinerja') ->hiddenLabel()
                // ->schema([
                //     Textarea::make('indikator')->label('Indikator Kinerja')->helperText('Berdasarkan Nomenklatur (Meta Data 2026)'),
                //                 Flex::make([
                //                     TextInput::make('tahun')->label('Satuan')->grow(true)->columnSpanFull(),
                //                     Radio::make('is_akumulasi')->boolean()->inline()->inlineLabel(false)->label('Akumulasi ?')
                //                         ->helperText('Default :Yes!')
                //                         ->grow(false)
                //                         ])
                //                 ])
                //                 ->addable()
                //                 ->reorderable(false)
                //                 ->collapsible()
                //                  ->minItems(4)
                //                  ->defaultItems(4)
                //                 ->deletable()
                //                     ->extraItemActions([
                //                     Action::make('save')->icon('heroicon-m-document-arrow-up')
                //                         ->label(false)
                //                     ])
                //                 // ->extraItemActions([
                //                 //     Action::make('save')
                //                 //         ->label(false)
                //                 //     ->action(function (array $arguments, Get $get) {
                //                 //             $index = $arguments['item'] ?? null;

                //                 //             if ($index !== null) {
                //                 //                 $nama = $get("data.{$index}.nama_subkegiatan");
                //                 //                 $volume = $get("data.{$index}.satuan");
                //                 //                 Notification::make('success')
                //                 //                     ->title('Item Disimpan')
                //                 //                 ->body("Kegiatan '{$nama}' dengan volume {$volume} berhasil disimpan.")
                //                 //                     ->success()
                //                 //                     ->send();
                //                 //             }
                //                 //         })
                //                 //         ->icon('heroicon-m-check-circle')->color('success')
                //                 //     ])
                //                 // ->collapsed()
                //                 ->itemLabel('index')->addActionAlignment(Alignment::End)
                //                 // ->itemLabel(fn(array $state): ?string => $state['kd_subkegiatan'] )
                //                 // ->itemLabel(fn(array $state): ?string => $state['kd_subkegiatan'] . ' - Pagu : Rp.' . number_format($state['pagu_subkegiatan'], 0, ',', '.') ?? null)
                //                 ->grid(1)
                // ->statePath('data')
                // ->columnSpanFull(),
            ]);
    }
}
