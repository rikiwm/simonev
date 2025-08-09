<?php

namespace App\Filament\Resources\Programs\Resources\Kegiatans\Resources\SubKegiatans\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SubKegiatanForm
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
                TextInput::make('kd_kegiatan')
                    ->numeric(),
                TextInput::make('kd_subkegiatan')
                    ->numeric(),
                TextInput::make('kd_subkegiatan_str'),
                Textarea::make('nama_subkegiatan')
                    ->columnSpanFull(),
                TextInput::make('pagu_subkegiatan')
                    ->numeric(),
                TextInput::make('pagu_subkegiatan_perubahan')
                    ->numeric(),
                TextInput::make('kd_subkegiatan_lokal'),
                Toggle::make('is_deleted'),
                DatePicker::make('_event_date'),
            ]);
    }
}
