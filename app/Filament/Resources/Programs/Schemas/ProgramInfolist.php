<?php

namespace App\Filament\Resources\Programs\Schemas;

use App\Models\IndikatorProgram;
use App\Models\RealisasiKinerja;
use Filament\Actions\Action;
use Filament\Forms\Components\Hidden;
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
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Flex;
use Filament\Support\Enums\Alignment;

class ProgramInfolist
{
    protected $listeners = ['refresh' => '$refresh'];

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
                            ->label('Simpan')
                            ->size(Size::ExtraSmall)
                            ->color('gray')->outlined()
                            ->icon(Heroicon::OutlinedArchiveBox)
                            ->requiresConfirmation()
                            ->action(function ($record, $livewire) {
                                // dd($livewire);
                                // $stateIp = $livewire->indikatorprogram->first(); 
                                foreach ($livewire->indikatorprogram as $item) {
                                    $ip = IndikatorProgram::updateOrCreate(
                                        [
                                            'indikator' => $item['indikator'],
                                            'kd_program_str' =>  $record->kd_program_str,
                                        ],
                                        [
                                            'kd_bidang' =>   $record->kd_bidang_str,
                                            'kd_program' =>  $record->kd_program,
                                            'kd_program_str' =>  $record->kd_program_str,
                                            'nama_program' => $record->nama_program,
                                            'satuan' => $item['satuan'],
                                            'indikator' => $item['indikator'],
                                            'definisi' => null,
                                            'indikator_outcome_canges' =>  null,
                                            'indikator_outcome_before' =>  null,
                                            'kd_satker' =>  auth()->user()->skpd->kd_satker,
                                            'satker' =>  auth()->user()->skpd->name_satker,
                                            'tags' =>  null,
                                            '
                                             sumber_data' => 'Mnaual',
                                            'is_active' => 1,
                                            'is_canges' => 0

                                        ]
                                    );
                                }
                                // $record->update([
                                //     'satuan'   => $data['satuan'],
                                //     'is_sum'   => $data['is_sum'],
                                //     'indikator'=> $data['indikator'],
                                // ]);

                                \Filament\Notifications\Notification::make()
                                    ->title('Outcome berhasil disimpan!')
                                    ->body('Outcome berhasil disimpan!')
                                    ->success()
                                    ->send();
                            }),
                    ])

                    ->schema([
                        Repeater::make('indikatorprogram')->label('Indikator Kinerja')->hiddenLabel()
                            ->schema([
                                Textarea::make('indikator')->label('Indikator Kinerja')->helperText('Berdasarkan RPJMD (Meta Data 2026)'),
                                Flex::make([
                                    TextInput::make('id')->hidden(),
                                    TextInput::make('kd_program')->hidden(),
                                    TextInput::make('kd_program_str')->hidden(),
                                    TextInput::make('satuan')->label('Satuan')->grow(true)->columnSpanFull(),
                                    Radio::make('is_akumulasi')->boolean()->inline()->inlineLabel(false)->label('Akumulasi ?')
                                        ->helperText('Default :Yes!')
                                        ->grow(false)
                                ])
                            ])
                            ->addable()
                            ->reorderable(false)
                            ->collapsible()
                            ->deleteAction(
                                fn(Action $action) => $action->requiresConfirmation()->icon('heroicon-m-document-arrow-down')
                                    ->action(function (array $arguments, Get $get, $livewire) {
                                        $index = $arguments['item'] ?? null;
                                        $id = $get("indikatorprogram.{$index}.id");

                                        if (!$id) {
                                            Notification::make()
                                                ->title('Data tidak ditemukan')
                                                ->danger()
                                                ->send();
                                            return;
                                        }

                                        $indikator = IndikatorProgram::find($id);

                                        if ($indikator) {
                                            $indikator->delete();

                                            Notification::make()
                                                ->title('Indikator berhasil dihapus')
                                                ->body('Indikator ' . $id . ' berhasil dihapus')
                                                ->success()
                                                ->send();
                                        } else {
                                            Notification::make()
                                                ->title('Data sudah tidak ada')
                                                ->danger()
                                                ->send();
                                        }
                                        $livewire->dispatch('refresh');
                                    })
                            )
                            //  ->minItems(4)
                            //  ->minItems(4)
                            //  ->defaultItems(4)
                            // ->deletable(false)
                            ->extraItemActions([
                                Action::make('save')->icon('heroicon-m-document-arrow-up')->color('success')
                                    ->label(false)
                                    // ->requiresConfirmation()
                                    ->form(function (array $arguments, Get $get, $livewire,$record) {
                                        //   ->action(function (array $arguments, Get $get, $livewire) {
                                        $index = $arguments['item'] ?? null;
                                        $id = $get("indikatorprogram.{$index}.id");
                                        // dd($id);
                                        // Cari data existing realisasi
                                        $existing = RealisasiKinerja::query()
                                        ->where('indikator_sub_kegiatan_id', $id)
                                            ->where('kode_type', $record->kd_program)
                                            ->where('kodeindikator', $id)
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
                                    ->action(function (array $arguments, Get $get, $livewire, $record) {
                                        $index = $arguments['item'] ?? null;
                                        $id = $get("indikatorprogram.{$index}.id");
                                        $fill = $livewire->mountedActions[0]['data'] ?? [];
                                            $ip = RealisasiKinerja::updateOrCreate(
                                            [
                                                'tahun_realisasi' => $record->tahun_aggaran,
                                                'kode_type'       => $record->kd_program,
                                                'indikator_sub_kegiatan_id'   => $id,
                                            ],
                                            [
                                                'kodeindikator' => $id,
                                                'skpds_id'                   => $record->kd_satker,
                                                'jenis'                   => 'output',
                                                'type_name'                   => 'Program',
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
                            // ->extraItemActions([
                            //     Action::make('save')
                            //         ->label(false)
                            //       ->action(function (array $arguments, Get $get) {
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
