<?php

namespace App\Filament\Resources\Programs\Schemas;

use Filament\Actions\Action;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput as ComponentsTextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Infolists\Components\TextInput;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Icon;
use Filament\Support\Enums\Size;
use Filament\Support\Icons\Heroicon;

class ProgramInfolist
{
    public static function configure(Schema $schema): Schema
    {


        return $schema
            ->components([
                Section::make('Infos')->compact()->collapsible()
                ->inlineLabel()

                ->schema([
                    
                    TextEntry::make('nama_program')->label('Program')->columnSpan(2)->inlineLabel(false),
                    TextEntry::make('bidang.name_bidang')->label('Bidang')->columns(2)->inlineLabel(false),
                    TextEntry::make('satker.name_satker')->alignBetween()->alignLeft()->columns(2)->inlineLabel(false),
                    TextEntry::make('pagu_program')->label('Pagu Anggaran')->columns(2)
                    ->numeric()->inlineLabel(),
                    TextEntry::make('pagu_program')->label('Pa. Perubahan')->columns(2)
                    ->numeric()->inlineLabel(),
          
                ])->columns(2),
                Section::make('Outcome')->compact()->headerActions([
                    Action::make('Save')->size(Size::ExtraSmall)->color('secondary'),
                    Action::make('Reset')->size(Size::ExtraSmall)->color('gray'),
                ])
                ->inlineLabel()
                ->schema([
                    ComponentsTextInput::make('satuan')->columns(2),
                    ToggleButtons::make('is_sum') ->label('Akumulasi this?')->grouped()->boolean()->inline()
                    ->columns(2),
                    Textarea::make('indikator')->columnSpanFull()->rows(3)->inlineLabel(false),
              ])->columns(2),
                 Section::make('Info')->compact()->collapsible()
                ->inlineLabel()
                ->schema([
                    ComponentsTextInput::make('progres')->columns(6)->inlineLabel()->label('Proges'),
                    TextEntry::make('tahun_anggaran')->columns(6),
                    TextEntry::make('updated_at')->columns(2)
                    ->dateTime(),
                ])->columnSpanFull()
            ]);
    }
}
