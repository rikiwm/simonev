<?php

namespace App\Filament\Resources\Programs\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProgramForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Toggle::make('is_deleted'),
                Section::make('Data')->compact()->collapsible()->schema([
                    //  TextInput::make('kd_program_str')->inlineLabel(),
                Textarea::make('nama_program')->label('Program')
                    ->columnSpanFull(),
                // TextInput::make('kd_program_lokal'),
                ])->columnSpanFull(),
                Section::make('Data')->compact()->schema([
                TextInput::make('tahun_anggaran'),
                TextInput::make('kd_program')
                    ->numeric(),
               
                // DatePicker::make('_event_date'),
                ]),
                Section::make('Data')->compact()->schema([
                TextInput::make('pagu_program')
                    ->numeric(),
                TextInput::make('pagu_program_perubahan')
                    ->numeric(),
                ]),


            ]);
    }
}
