<?php

namespace App\Filament\Resources\Programs\Resources\Kegiatans\Schemas;

use Filament\Actions\Action;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Icon;
use Filament\Support\Enums\Size;
use Filament\Support\Icons\Heroicon;
use Filament\Schemas\Components\Flex;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\TextSize;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Support\Enums\Alignment;

class KegiatanInfolist
{


    public static function configure(Schema $schema): Schema
    {  
//         if($schema){
//         $d = fn($schema) => $schema;
// dd($d);
//         }
        // dd($schema);
   
        return $schema
            ->components([

                // Section::make('Indikator')->compact()->collapsible()
                //     ->inlineLabel()
                //     ->schema([
                //         Flex::make([
                //             TextInput::make('satuan')->inlineLabel(false)->columns(1)->placeholder('Ex: Angka')->datalist([
                //                 'BMW',
                //                 'Ford',
                //                 'Mercedes-Benz',
                //                 'Porsche',
                //                 'Toyota',
                //                 'Volkswagen',
                //             ])->autocapitalize('words'),
                //             ToggleButtons::make('is_sum')->label('Akumulasi this?')->grouped()->boolean()->inlineLabel(false)->grow(false)
                //         ]),

                //         Textarea::make('indikator')->rows(3)->inlineLabel(false),
                //         // ])->columns(2),
                //         //     Section::make('Outcome')->compact()->headerActions([
                //         //         Action::make('Save')->size(Size::ExtraSmall)->color('secondary')
                //         //     ])
                //         //     ->inlineLabel()
                //         //     ->schema([
                //         //         ComponentsTextInput::make('satuan')->columns(2),
                //         //         ToggleButtons::make('is_sum') ->label('Akumulasi this?')->grouped()->boolean()->inline()
                //         //         ->columns(2),
                //         //         Textarea::make('indikator')->columnSpanFull()->inlineLabel(false),
                //     ]),
                Section::make('')->compact()->collapsible()
                    ->inlineLabel()
                    ->schema([
                        TextEntry::make('program.nama_program')->label('Program')->inlineLabel()->size(TextSize::ExtraSmall),
                        TextEntry::make('nama_kegiatan')->label('Kegiatan')->inlineLabel(),
                        TextEntry::make('satker.name_satker')->alignBetween()->alignLeft()->inlineLabel()->icon(Heroicon::OutlinedBuildingOffice)->iconColor('primary'),
                        TextEntry::make('pagu_kegiatan')->label('Pagu Anggaran')->numeric()->inlineLabel()
                            ->money('IDR', true)->prefix('Rp ')
                            ->suffix(',-')->color('success')
                            ->formatStateUsing(fn($state) => number_format($state, 0, ',', '.'))->weight(FontWeight::Bold),
                        // ComponentsTextInput::make('progres')->columns(6)->inlineLabel()->label('Proges'),
                        TextEntry::make('tahun_anggaran')->badge(),
                    ]),
 
                Repeater::make('indikator')->hiddenLabel()
                    ->schema([
                        Textarea::make('indikator')
                        ->label('Indikator Kegiatan')->helperText('Berdasarkan Nomenklatur (Meta Data 2026)'),
                        Flex::make([
                            TextInput::make('tahun')->label('Satuan')->grow(true)->columnSpanFull(),
                            Radio::make('is_akumulasi')->boolean()->inline()->inlineLabel(false)->label('Akumulasi ?')
                                ->grow(false)
                        ])
                    ])
                    ->extraItemActions([
                        Action::make('save')->icon('heroicon-m-document-arrow-up')
                        ->action(function ($livewire) {
                            // ->action(function (array $state, $livewire) {
                                dd($livewire);
                                           }

                                        )
                                    ])
                    ->addable()->statePath('indikator')
                    ->reorderable(false)
                    ->collapsible()
                    ->minItems(4)
                    ->defaultItems(4)
                    ->deletable()->addActionAlignment(Alignment::End)
                    ->grid(1),

            ]);
    }
}
