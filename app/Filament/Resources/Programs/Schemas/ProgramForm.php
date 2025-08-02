<?php

namespace App\Filament\Resources\Programs\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProgramForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('tahun_anggaran'),
                TextInput::make('kd_klpd'),
                TextInput::make('kd_satker')
                    ->numeric(),
                TextInput::make('kd_program')
                    ->numeric(),
                TextInput::make('kd_program_str'),
                Textarea::make('nama_program')
                    ->columnSpanFull(),
                TextInput::make('pagu_program')
                    ->numeric(),
                TextInput::make('pagu_program_perubahan')
                    ->numeric(),
                TextInput::make('kd_program_lokal'),
                Toggle::make('is_deleted'),
                DatePicker::make('_event_date'),
            ]);
    }
}
